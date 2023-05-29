<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\User;
use iteos\Models\Warehouse;
use iteos\Models\Division;
use iteos\Models\Department;
use iteos\Models\Status;
use iteos\Models\EmployeeOrganization;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use iteos\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use DB;
use Auth;

class UserManagementController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Can Access Users');
         $this->middleware('permission:Can Create User', ['only' => ['create','store']]);
         $this->middleware('permission:Can Edit User', ['only' => ['edit','update']]);
         $this->middleware('permission:Can Delete User', ['only' => ['destroy']]);
    }

    public function userIndex()
    {
        $users = User::orderBy('name','asc')
                        ->get();
        $ukers = Division::pluck('name','id')->toArray();
        $departs = Department::pluck('department_name','id')->toArray();
        $roles = Role::pluck('name','name')->all();
        
        return view('apps.pages.users',compact('users','ukers','roles','departs'));
    }

    public function userProfile()
    {
        $user = Auth::user();
        $locations = Auth::user()->warehouses;
        return view('apps.pages.profile',compact('user','locations'));
    }

    public function userStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'employee_id' => 'required|unique:users,employee_id',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'division_id' => 'required',
            'department_id' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        $log = 'User '.($user->name).' Berhasil disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Berhasil disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function userUpload(Request $request)
    {
        $this->validate($request, [
            'users' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);

        $users = Excel::toArray(new UserImport, $request->file('users'))[0];
        foreach($users as $index=> $value) {
            if(isset($value['nama'])) {
                $result = User::create([
                    'name' => $value['nama'],
                    'email' => $value['email'],
                    'password' => Hash::make('123456'),
                    'employee_id' => $value['nik'],
                    'division_id' => $value['divisi'],
                    'department_id' => $value['departemen'],
                ]);
                $result->assignRole($value['roles']);

                $organization = EmployeeOrganization::create([
                    'employee_id' => $result->id,
                    'nik' => $result->nik,
                    'supervise' => $value['reporting']
                ]);
            }
        }
        
        $log = 'Upload User Berhasil';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Upload User Berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function userShow($id)
    {
        $user = User::find($id);
        $locations = User::find($id)->warehouses;
        return view('apps.show.users',compact('user','locations'))->renderSections()['content'];
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $ukers = Division::pluck('name','id')->toArray();
        $departments = Department::pluck('department_name','id')->toArray();
        
        return view('apps.edit.users',compact('user','roles','userRole','ukers','departments'))->renderSections()['content'];
    }

    public function userUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
            'division_id' => 'required',
        ]);

        $input = $request->all(); 
        
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();        
        $user->assignRole($request->input('roles'));
        
        $log = 'User '.($user->name).' Berhasil diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Berhasil diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function updateAvatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,JPG,gif,svg|dimensions:width=150,length=150',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('public/',$avatarName);

        $user->avatar = $avatarName;
        $user->save(); 

        $log = 'User Picture '.($user->name).' Berhasil disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User Picture '.($user->name).' Berhasil disimpan',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = Auth::user();
        $user->update($input);

        $log = 'Password User '.($user->name).' Berhasil diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Password User '.($user->name).' Berhasil diubah',
            'alert-type' => 'success'
        );
        return back()
            ->with($notification);
    }

    public function userSuspend($id)
    {
        $input = ['status_id' => '82e9ec8c-5a82-4009-ba2f-ab620eeaa71a'];
        $user = User::find($id);
        $user->update($input);
        
        $log = 'User '.($user->name).' Suspended';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Suspended',
            'alert-type' => 'success'
        );
        return redirect()->route('user.index')
                        ->with($notification);
    }

    public function userDestroy($id)
    {
        $user = User::find($id);
        
        $log = 'User '.($user->name).' Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Dihapus',
            'alert-type' => 'success'
        );
        $user->delete();
        return redirect()->route('user.index')
                        ->with($notification);
    }

    public function roleIndex(Request $request)
    {
        $permission = Permission::get();
        $roles = Role::orderBy('id','ASC')->get();
        return view('apps.pages.roles',compact('roles','permission'));
    } 

    public function roleCreate()
    {
        return view('apps.input.roles');
    }

    public function roleStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        $log = 'Hak Akses '.($role->name).' berhasil disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Hak Akses '.($role->name).' berhasil disimpan',
            'alert-type' => 'success'
        ); 

        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function roleShow($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('apps.show.roles',compact('role','rolePermissions'))->renderSections()['content'];
    }

    public function roleEdit($id)
    {
        $data = Role::find($id);
        $permission = Permission::get();
        $roles = Role::join('role_has_permissions','role_has_permissions.role_id','=','roles.id')
                       ->where('roles.id',$id)
                       ->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            /*->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')*/
            ->get();
        
        return view('apps.edit.roles',compact('data','rolePermissions','roles'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));
        $log = 'Hak Akses '.($role->name).' berhasil diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Hak Akses '.($role->name).' berhasil diubah',
            'alert-type' => 'success'
        ); 

        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function roleDestroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        $log = 'Hak Akses '.($role->name).' berhasil disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Hak Akses '.($role->name).' berhasil disimpan',
            'alert-type' => 'success'
        ); 
        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function ukerIndex()
    {
        $units = Division::orderBy('name','ASC')->get();
        return view('apps.pages.units',compact('units'));
    }

    public function ukerStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:divisions,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'created_by' => auth()->user()->id,
        ];

        $data = Division::create($input);
        $log = 'Unit Kerja '.($data->name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Unit Kerja '.($data->name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('uker.index')->with($notification);  
    }

    public function ukerEdit($id)
    {
        $data = Division::find($id);
        return view('apps.edit.units',compact('data'))->renderSections()['content'];
    }
    public function ukerUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:divisions,name',
        ]);

        $input = [
            'name' => $request->input('name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = Division::find($id);
        $log = 'Unit Kerja '.($data->name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Unit Kerja '.($data->name).' Berhasil Diubah',
            'alert-type' => 'success'
        );
        $data->update($input);

        return redirect()->route('uker.index')->with($notification);
    }

    public function ukerDestroy($id)
    {
        $data = Division::find($id);
        $log = 'Unit Kerja '.($data->name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Unit Kerja '.($data->name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();
        return redirect()->route('uker.index')->with($notification);
    }

    public function departIndex()
    {
        $units = Department::orderBy('id','ASC')->get();
        $divisions = Division::pluck('name','id')->toArray();

        return view('apps.pages.departments',compact('units','divisions'));
    }

    public function departStore(Request $request)
    {
        $this->validate($request, [
            'division_id' => 'required',
            'department_name' => 'required|unique:departments,department_name',
        ]);

        $input = [
            'division_id' => $request->input('division_id'),
            'department_name' => $request->input('department_name'),
            'created_by' => auth()->user()->id,
        ];

        $data = Department::create($input);
        $log = 'Departemen '.($data->department_name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Departemen '.($data->department_name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('depart.index')->with($notification);  
    }

    public function departEdit($id)
    {
        $data = Department::find($id);
        $divisions = Division::pluck('name','id')->toArray();

        return view('apps.edit.departments',compact('data','divisions'))->renderSections()['content'];
    }

    public function departUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'division_id' => 'required',
            'department_name' => 'required|unique:departments,department_name',
        ]);

        $input = [
            'division_id' => $request->input('division_id'),
            'department_name' => $request->input('department_name'),
            'updated_by' => auth()->user()->id,
        ];
        $data = Dpartment::find($id);
        $log = 'Departemen '.($data->department_name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Departemen '.($data->department_name).' Berhasil Diubah',
            'alert-type' => 'success'
        );
        $data->update($input);

        return redirect()->route('depart.index')->with($notification);
    }

    public function departDestroy($id)
    {
        $data = Department::find($id);
        $log = 'Departemen '.($data->department_name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Departemen '.($data->department_name).' Berhasil Diubah',
            'alert-type' => 'success'
        );
        $deactive = $data->update([
            'status_id' => '9'
        ]);
        return redirect()->route('depart.index')->with($notification);
    }
}
