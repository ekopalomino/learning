<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Facilitator;
use iteos\Models\Quesioner;
use iteos\Models\QuesionerDetail;
use iteos\Models\Training;
use iteos\Models\TrainingLevel;
use iteos\Models\TrainingCategory;
use iteos\Models\TrainingType;
use iteos\Models\TrainingPeople;
use iteos\Models\TrainingHour;
use iteos\Models\TrainingAccumulation;
use iteos\Models\Employee;
use iteos\Models\EmployeeOrganization;
use iteos\Imports\TrainingPeopleImport;
use iteos\Imports\TrainingScore;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Carbon\Carbon;

class TrainingManagementController extends Controller
{
    public function facilitatorIndex()
    {
        $data = Facilitator::where('status','7')->orderBy('facilitator_name','asc')->get();
        
        return view('apps.pages.facilitator',compact('data'));
    }

    public function facilitatorStore(Request $request)
    {
        if($request->hasFile('facilitator_picture')) {

            $this->validate($request, [
                'facilitator_name' => 'required|unique:facilitators,facilitator_name',
                'descriptions' => 'required',
                'facilitator_picture' => 'image|mimes:jpg,jpeg,JPG,JPEG,png,PNG'
            ]);

            $file = $request->file('facilitator_picture');
            $file_name = $file->getClientOriginalName();
            $size = $file->getSize();
            $ext = $file->getClientOriginalExtension();
            $destinationPath = 'files/avatar';
            $extension = $file->getClientOriginalExtension();
            $filename=$file_name.'_event.'.$extension;
            $uploadSuccess = $request->file('facilitator_picture')
            ->move($destinationPath, $filename);

            $input = [
                'facilitator_name' => $request->input('facilitator_name'),
                'descriptions' => $request->input('descriptions'),
                'status' => '7',
                'facilitator_pictire' => $filename,
                'created_by' => auth()->user()->id,
            ];
            $data = Facilitator::create($input);
            $log = 'Trainer '.($data->training_name).' Berhasil Disimpan';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Trainer '.($data->training_name).' Berhasil Disimpan',
                'alert-type' => 'success'
            );
    
            return redirect()->route('facilitator.index')->with($notification);
        } else {

            $this->validate($request, [
                'facilitator_name' => 'required|unique:facilitators,facilitator_name',
                'descriptions' => 'required',
            ]);

            $input = [
                'facilitator_name' => $request->input('facilitator_name'),
                'descriptions' => $request->input('descriptions'),
                'status' => '7',
                'created_by' => auth()->user()->id,
            ];
            $data = Facilitator::create($input);
            $log = 'Trainer '.($data->training_name).' Berhasil Disimpan';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Trainer '.($data->training_name).' Berhasil Disimpan',
                'alert-type' => 'success'
            );
    
            return redirect()->route('facilitator.index')->with($notification);
        }
    }

    public function facilitatorEdit($id)
    {
        $data = Facilitator::find($id);

        return view('apps.edit.facilitator',compact('data'))->renderSections()['content'];
    }

    public function facilitatorUpdate(Request $request,$id)
    {
        $data = Facilitator::find($id);
        if($request->hasFile('facilitator_picture')) {

            $this->validate($request, [
                'facilitator_name' => 'required|unique:facilitators,facilitator_name',
                'descriptions' => 'required',
                'facilitator_picture' => 'image|mimes:jpg,jpeg,JPG,JPEG,png,PNG'
            ]);

            $file = $request->file('facilitator_picture');
            $file_name = $file->getClientOriginalName();
            $size = $file->getSize();
            $ext = $file->getClientOriginalExtension();
            $destinationPath = 'files/avatar';
            $extension = $file->getClientOriginalExtension();
            $filename=$file_name.'_event.'.$extension;
            $uploadSuccess = $request->file('facilitator_picture')
            ->move($destinationPath, $filename);

            $input = [
                'facilitator_name' => $request->input('facilitator_name'),
                'descriptions' => $request->input('descriptions'),
                'status' => '7',
                'facilitator_picture' => $filename,
                'updated_by' => auth()->user()->id,
            ];
            $update = Facilitator::find($id)->update($input);
            $log = 'Trainer '.($data->facilitator_name).' Berhasil Diubah';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Trainer '.($data->facilitator_name).' Berhasil Diubah',
                'alert-type' => 'success'
            );
    
            return redirect()->route('facilitator.index')->with($notification);
        } else {

            $this->validate($request, [
                'facilitator_name' => 'required|unique:facilitators,facilitator_name',
                'descriptions' => 'required',
            ]);

            $input = [
                'facilitator_name' => $request->input('facilitator_name'),
                'descriptions' => $request->input('descriptions'),
                'status' => '7',
                'updated_by' => auth()->user()->id,
            ];
            $update = Facilitator::find($id)->update($input);
            $log = 'Trainer '.($data->facilitator_name).' Berhasil Diubah';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Trainer '.($data->facilitator_name).' Berhasil Diubah',
                'alert-type' => 'success'
            );
    
            return redirect()->route('facilitator.index')->with($notification);
        }
    }

    public function facilitatorDestroy($id)
    {
        $data = Facilitator::find($id);
        $log = 'Trainer '.($data->facilitator_name).' Berhasil Dinonaktifkan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Trainer '.($data->facilitator_name).' Berhasil Dinonaktifkan',
            'alert-type' => 'success'
        );
        $deactive = $data->update([
            'status' => '9',
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('training.index')->with($notification);
    }

    public function questionerIndex()
    {
        $data = Quesioner::orderBy('id','asc')->get();
        
        return view('apps.pages.questioner',compact('data'));
    }

    public function questionCreate()
    {

    }

    public function trainingLevelIndex()
    {
        $data = TrainingLevel::where('status_id','7')->orderBy('level_name','asc')->get();
        
        return view('apps.pages.trainingLevel',compact('data'));
    }

    public function trainingLevelStore(Request $request)
    {
        $this->validate($request, [
            'level_name' => 'required|unique:training_levels,level_name',
        ]);

        $input = [
            'level_name' => $request->input('level_name'),
            'created_by' => auth()->user()->id,
        ];
        $data = TrainingLevel::create($input);
        $log = 'Level '.($data->level_name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Level '.($data->level_name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('level.index')->with($notification);
    }

    public function trainingLevelEdit($id)
    {
        $data = TrainingLevel::find($id);

        return view('apps.edit.trainingLevel',compact('data'))->renderSections()['content'];
    }

    public function trainingLevelUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'level_name' => 'required|unique:training_levels,level_name',
        ]);
        $data = TrainingLevel::find($id);
        $input = [
            'level_name' => $request->input('level_name'),
            'updated_by' => auth()->user()->id,
        ];
        $update = TrainingLevel::find($id)->update($input);
        $log = 'Level '.($data->level_name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Level '.($data->level_name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('level.index')->with($notification);
    } 

    public function trainingLevelDestroy($id)
    {
        $data = TrainingLevel::find($id);
        $log = 'Level '.($data->level_name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Level '.($data->level_name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $deactive = $data->update([
            'status_id' => '9',
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('level.index')->with($notification);
    }

    public function trainingCategoryIndex()
    {
        $data = TrainingCategory::where('status_id','7')->orderBy('category_name','asc')->get();
        
        return view('apps.pages.trainingCategory',compact('data'));
    }

    public function trainingCategoryStore(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:training_categories,category_name',
        ]);

        $input = [
            'category_name' => $request->input('category_name'),
            'created_by' => auth()->user()->id
        ];
        $data = TrainingCategory::create($input);
        $log = 'Kategori '.($data->category_name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori '.($data->category_name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    }

    public function trainingCategoryEdit($id)
    {
        $data = TrainingCategory::find($id);

        return view('apps.edit.trainingCategory',compact('data'))->renderSections()['content'];
    }

    public function trainingCategoryUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'category_name' => 'required|unique:training_categories,category_name',
        ]);
        $data = TrainingCategory::find($id);
        $input = [
            'category_name' => $request->input('category_name'),
            'updated_by' => auth()->user()->id
        ];
        $update = TrainingCategory::find($id)->update($input);
        $log = 'Kategori '.($data->category_name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori '.($data->category_name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($notification);
    } 

    public function trainingCategoryDestroy($id)
    {
        $data = TrainingCategory::find($id);
        $log = 'Kategori '.($data->category_name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Kategori '.($data->category_name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $deactive = $data->update([
            'status_id' => '9',
            'updated_by' => auth()->user()->id
        ]);

        return redirect()->route('category.index')->with($notification);
    }

    public function trainingIndex()
    {
        $data = Training::orderBy('training_id','asc')->get();
        $level = TrainingLevel::where('status_id','7')->pluck('level_name','id')->toArray();
        $facilitator = Facilitator::where('status','7')->pluck('facilitator_name','id')->toArray();
        $categories = TrainingCategory::where('status_id','7')->pluck('category_name','id')->toArray();

        return view('apps.pages.trainings',compact('data','level','facilitator','categories'));
    }

    public function trainingCreate()
    {
        $level = TrainingLevel::where('status_id','7')->pluck('level_name','id')->toArray();
        $facilitator = Facilitator::where('status','7')->pluck('facilitator_name','id')->toArray();
        $categories = TrainingCategory::where('status_id','7')->pluck('category_name','id')->toArray();
        $types = TrainingType::pluck('type_name','id')->toArray();

        return view('apps.input.training',compact('level','facilitator','categories','types'));
    }

    public function trainingStore(Request $request)
    {
        $this->validate($request, [
            'training_id' => 'required|unique:trainings,training_id',
            'training_name' => 'required|unique:trainings,training_name',
            'level' => 'required',
            'category' => 'required',
            'facilitator_id' => 'required',
            'minimum_score' => 'required|numeric',
            'jenis_kelas' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'participants' => 'required|file|mimes:xlsx,xls,XLSX,XLS',
            'cover_image' => 'image|mimes:jpg,jpeg,JPG,JPEG,png,PNG'
        ]);

        $desc = $request->input('deskripsi');

        if($request->hasFile('cover_image') && (!empty($desc))) {
            $dom = new\DomDocument();
            $dom->loadHtml($desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach($images as $k => $img){
                $isi = $img->getAttribute('src');
                list($type, $data) = explode(';', $isi);
                list(, $isi) = explode(',', $isi);
                $isi = base64_decode($isi);
                $image_name = "/files/training_cover/" . time().$k.'.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $isi);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
            $id_function = $dom->saveHtml();

            $file = $request->file('cover_image');
            $file_name = $file->getClientOriginalName();
            $size = $file->getSize();
            $ext = $file->getClientOriginalExtension();
            $destinationPath = 'files/training_cover';
            $extension = $file->getClientOriginalExtension();
            $filename=$file_name.'_event.'.$extension;
            $uploadSuccess = $request->file('cover_image')
            ->move($destinationPath, $filename);

            $input = [
                'training_id' => $request->input('training_id'),
                'training_name' => $request->input('training_name'),
                'training_cover' => $filename,
                'level' => $request->input('level'),
                'category' => $request->input('category'),
                'facilitator_id' => $request->input('facilitator_id'),
                'minimum_score' => $request->input('minimum_score'),
                'type_id' => $request->input('jenis_kelas'),
                'description' => $id_function,
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'period' => (Carbon::parse($request->input('end_date')))->diffInHours(Carbon::parse($request->input('start_date'))),
                'status' => '1',
                'created_by' => auth()->user()->id,
            ];
    
            $data = Training::create($input);
            $participant = Excel::toArray(new TrainingPeopleImport, $request->file('participants'))[0];
            
            foreach($participant as $index=> $value) {
                if(isset($value['id'])) {
                    $result = TrainingPeople::create([
                        'training_id' => $data->id,
                        'employee_nik' => $value['id'],
                        'employee_name' => $value['name'],
                        'status_id' => '1',
                    ]);
                }
            }
            $log = 'Training '.($data->training_name).' Berhasil Disimpan';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Training '.($data->training_name).' Berhasil Disimpan',
                'alert-type' => 'success'
            );
    
            return redirect()->route('training.index')->with($notification);
        } elseif ($request->hasFile('cover_image'))  {

            $file = $request->file('cover_image');
            $file_name = $file->getClientOriginalName();
            $size = $file->getSize();
            $ext = $file->getClientOriginalExtension();
            $destinationPath = 'files/training_cover';
            $extension = $file->getClientOriginalExtension();
            $filename=$file_name.'_event.'.$extension;
            $uploadSuccess = $request->file('cover_image')
            ->move($destinationPath, $filename);

            $input = [
                'training_id' => $request->input('training_id'),
                'training_name' => $request->input('training_name'),
                'training_cover' => $filename,
                'level' => $request->input('level'),
                'category' => $request->input('category'),
                'facilitator_id' => $request->input('facilitator_id'),
                'minimum_score' => $request->input('minimum_score'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'period' => (Carbon::parse($request->input('end_date')))->diffInHours(Carbon::parse($request->input('start_date'))),
                'status' => '1',
                'created_by' => auth()->user()->id,
            ];
    
            $data = Training::create($input);
            $participant = Excel::toArray(new TrainingPeopleImport, $request->file('participants'))[0];
           
            foreach($participant as $index=> $value) {
                if(isset($value['id'])) {
                   $result = TrainingPeople::create([
                        'training_id' => $data->id,
                        'employee_nik' => $value['id'],
                        'employee_name' => $value['name'],
                        'status_id' => '1',
                    ]);
                }
            }
            $log = 'Training '.($data->training_name).' Berhasil Disimpan';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Training '.($data->training_name).' Berhasil Disimpan',
                'alert-type' => 'success'
            );
    
            return redirect()->route('training.index')->with($notification);
        } elseif (!empty($desc)) {
            $dom = new\DomDocument();
            $dom->loadHtml($desc, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach($images as $k => $img){
                $isi = $img->getAttribute('src');
                list($type, $data) = explode(';', $isi);
                list(, $isi) = explode(',', $isi);
                $isi = base64_decode($isi);
                $image_name = "/files/training_cover/" . time().$k.'.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $isi);
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
            $id_function = $dom->saveHtml();

            $input = [
                'training_id' => $request->input('training_id'),
                'training_name' => $request->input('training_name'),
                'level' => $request->input('level'),
                'category' => $request->input('category'),
                'facilitator_id' => $request->input('facilitator_id'),
                'minimum_score' => $request->input('minimum_score'),
                'type_id' => $request->input('jenis_kelas'),
                'description' => $id_function,
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'period' => (Carbon::parse($request->input('end_date')))->diffInHours(Carbon::parse($request->input('start_date'))),
                'status' => '1',
                'created_by' => auth()->user()->id,
            ];
    
            $data = Training::create($input);
            $participant = Excel::toArray(new TrainingPeopleImport, $request->file('participants'))[0];
            
            foreach($participant as $index=> $value) {
                if(isset($value['id'])) {
                    $result = TrainingPeople::create([
                        'training_id' => $data->id,
                        'employee_nik' => $value['id'],
                        'employee_name' => $value['name'],
                        'status_id' => '1',
                    ]);
                }
            }
            $log = 'Training '.($data->training_name).' Berhasil Disimpan';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Training '.($data->training_name).' Berhasil Disimpan',
                'alert-type' => 'success'
            );
    
            return redirect()->route('training.index')->with($notification);
        } else {
            $input = [
                'training_id' => $request->input('training_id'),
                'training_name' => $request->input('training_name'),
                'level' => $request->input('level'),
                'category' => $request->input('category'),
                'facilitator_id' => $request->input('facilitator_id'),
                'minimum_score' => $request->input('minimum_score'),
                'type_id' => $request->input('jenis_kelas'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'period' => (Carbon::parse($request->input('end_date')))->diffInHours(Carbon::parse($request->input('start_date'))),
                'status' => '1',
                'created_by' => auth()->user()->id,
            ];
    
            $data = Training::create($input);
            $participant = Excel::toArray(new TrainingPeopleImport, $request->file('participants'))[0];
            
            foreach($participant as $index=> $value) {
                if(isset($value['id'])) {
                    $result = TrainingPeople::create([
                        'training_id' => $data->id,
                        'employee_nik' => $value['id'],
                        'employee_name' => $value['name'],
                        'status_id' => '1',
                    ]);
                }
            }
            $log = 'Training '.($data->training_name).' Berhasil Disimpan';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Training '.($data->training_name).' Berhasil Disimpan',
                'alert-type' => 'success'
            );
    
            return redirect()->route('training.index')->with($notification);
        }
    }

    public function trainingEdit($id)
    {
        $data = Training::find($id);
        $level = TrainingLevel::where('status_id','7')->pluck('level_name','id')->toArray();
        $facilitator = Facilitator::where('status','7')->pluck('facilitator_name','id')->toArray();
        $categories = TrainingCategory::where('status_id','7')->pluck('category_name','id')->toArray();
        
        return view('apps.edit.training',compact('data','level','facilitator','categories'))->renderSections()['content'];
    }

    public function trainingUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'training_name' => 'required',
            'level' => 'required',
            'category' => 'required',
            'facilitator_id' => 'required',
            'minimum_score' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ]);
        $data = Training::find($id);
        $input = [
            'training_id' => $request->input('training_id'),
            'training_name' => $request->input('training_name'),
            'level' => $request->input('level'),
            'category' => $request->input('category'),
            'facilitator_id' => $request->input('facilitator_id'),
            'minimum_score' => $request->input('minimum_score'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'period' => (Carbon::parse($request->input('end_date')))->diffInHours(Carbon::parse($request->input('start_date'))),
            'updated_by' => auth()->user()->id,
        ];
        $update = Training::find($id)->update($input);
        $log = 'Training '.($data->training_name).' Berhasil Diubah';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Training '.($data->training_name).' Berhasil Diubah',
            'alert-type' => 'success'
        );

        return redirect()->route('training.index')->with($notification);
    }

    public function trainingDestroy($id)
    {
        $data = Training::find($id);
        $input = [
            'status' => '9',
            'updated_by' => auth()->user()->id,
        ];
        $log = 'Training '.($data->training_name).' Berhasil Dinonaktifkan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Training '.($data->training_name).' Berhasil Dinonaktifkan',
            'alert-type' => 'success'
        );
        $update = Training::find($id)->update($input);
        $removes = TrainingPeople::where('training_id',$id)
                                ->update([
                                    'status_id' => '9'
                                ]);

        return redirect()->route('training.index')->with($notification);
    }

    public function trainingDetailShow($id)
    {
        $training = Training::find($id);
        $data = TrainingPeople::with('Parent')->where('training_id',$id)->paginate(10);
        $participants = TrainingPeople::with('Parent')->where('training_id',$id)->get()->count();
        $avgPre = TrainingPeople::with('Parent')->where('training_id',$id)->get()->avg('pre_score');
        $avgPost = TrainingPeople::with('Parent')->where('training_id',$id)->get()->avg('post_score');
        
        return view('apps.show.trainingPeople',compact('data','training','participants','avgPre','avgPost'));
    }

    public function trainingStart($id)
    {
        $data = Training::find($id);
        $input = [
            'status' => '2',
            'updated_by' => auth()->user()->id,
        ];

        $update = Training::find($id)->update($input);
        $log = 'Training '.($data->training_name).' Berhasil Dimulai';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Training '.($data->training_name).' Berhasil Dimulai',
            'alert-type' => 'success'
        );

        return redirect()->route('training.index')->with($notification);
    }

    public function trainingStop($id)
    {
        $data = Training::find($id);
        $input = [
            'status' => '3',
            'updated_by' => auth()->user()->id,
        ];

        $update = Training::find($id)->update($input);
        $log = 'Training '.($data->training_name).' Telah Berakhir';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Training '.($data->training_name).' Telah Berakhir',
            'alert-type' => 'success'
        );

        return redirect()->route('training.index')->with($notification);
    }

    public function trainingPeopleCreate($id)
    {
        $data = Training::find($id);

        return view('apps.input.trainingParticipant',compact('data'))->renderSections()['content'];
    }

    public function peopleAdd(Request $request,$id)
    {
        $this->validate($request, [
            'participants' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);
        $data = TrainingPeople::find($id);
        $participant = Excel::toArray(new TrainingPeopleImport, $request->file('participants'))[0];
       
        foreach($participant as $index=> $value) {
            if(isset($value['id'])) {
                $result = TrainingPeople::updateOrCreate([
                    'training_id' => $data->id,
                    'employee_nik' => $value['id'],
                    'employee_name' => $value['name'],
                    'status_id' => '1',
                ]);
            }
        }
        $log = 'Penambahan Peserta '.($data->training_name).' Berhasil Disimpan';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Penambahan Peserta '.($data->training_name).' Berhasil Disimpan',
            'alert-type' => 'success'
        );

        return redirect()->route('trainingPeople.show',$id)->with($notification);
    }

    public function trainingScore($id)
    {
        $data = TrainingPeople::find($id);
        
        return view('apps.input.trainingScore',compact('data'))->renderSections()['content'];
    }

    public function trainingScoreStore(Request $request,$id)
    {
        $this->validate($request, [
            'participants' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);
        $data = Training::find($id);
        $sources = TrainingPeople::join('training_accumulations','training_accumulations.employee_nik','training_people.employee_nik')->where('training_people.training_id',$id)->get();
        
        $participant = Excel::toArray(new TrainingPeopleImport, $request->file('participants'))[0];
        $up = collect($participant);
        $up = $up->keyBy('id');
        
        if(count($up) == count($sources)+1) {
            foreach($sources->keyBy('employee_nik') as $key => $item) {
                $scores = DB::table('training_people')
                            ->join('training_accumulations','training_accumulations.employee_nik','training_people.employee_nik')
                            ->where('training_people.training_id',$id)
                            ->where('training_people.employee_nik',$key)
                            ->update([
                                'pre_score' => $up[$key]['pre_test'],
                                'post_score' => $up[$key]['post_test'],
                                'status_id' => $up[$key]['status'],
                                'training_total' => ($item->training_total) + '1',
                                'hours_total' => ($item->hours_total)+($data->period),
                                'avg_pre_score' => (($item->avg_pre_score)+($up[$key]['pre_test']))/(($item->training_total)+'1'),
                                'avg_post_score' => (($item->avg_post_score)+($up[$key]['post_test']))/(($item->training_total)+'1'),
                            ]);
            }
            $log = 'Nilai Training '.($data->training_name).' Berhasil Disimpan';
             \LogActivity::addToLog($log);
            $notification = array (
                'message' => 'Nilai Training '.($data->training_name).' Berhasil Disimpan',
                'alert-type' => 'success'
            );
            return redirect()->route('trainingPeople.show',$id)->with($notification);
        } else {
            $notification = array (
                'message' => 'Data Nilai Anda Tidak Sesuai,Mohon Periksa Kembali Data Anda',
                'alert-type' => 'error'
            );
            return redirect()->route('trainingPeople.show',$id)->with($notification);
        }
        
    }

    public function trainingScoreEdit($id)
    {
        $data = TrainingPeople::find($id);

        return view('apps.edit.trainingScore',compact('data'))->renderSections()['content'];
    }

    public function trainingScoreUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'pre_score' => 'required|numeric',
            'post_score' => 'required|numeric',
        ]);
        $input = [
            'pre_score' => $request->input('pre_score'),
            'post_score' => $request->input('post_score'),
            'status_id' => $request->input('status_id'),
        ];
        $data = TrainingPeople::join('training_accumulations','training_accumulations.employee_nik','training_people.employee_nik')->where('training_people.id',$id)->first();
        $newData = TrainingPeople::find($id);
        $newEntry = $newData->replicate()->fill([
            'pre_score' => $request->input('pre_score'),
            'post_score' => $request->input('post_score'),
            'status_id' => $request->input('status_id'),
        ]);
        $newEntry->save();
        $scores = DB::table('training_people')
                    ->join('training_accumulations','training_accumulations.employee_nik','training_people.employee_nik')
                    ->where('training_people.id',$id)
                    ->update([
                        'avg_pre_score' => (($data->avg_pre_score)+($request->input('pre_score')))/($data->training_total),
                        'avg_post_score' => (($data->avg_post_score)+($request->input('post_score')))/($data->training_total),
                    ]);
        
        $log = 'Nilai Training '.($data->employee_name).' Berhasil Diupdate';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Nilai Training '.($data->employee_name).' Berhasil Diupdate',
            'alert-type' => 'success'
        );

        return redirect()->route('trainingPeople.show',$data->training_id)->with($notification);
    }

    public function employeeTrainingView()
    {
        $data = Employee::join('training_accumulations','training_accumulations.employee_id','employees.id')->where('employees.report_to',auth()->user()->employee_id)->get();

        return view('apps.pages.teamTraining',compact('data'));
    }

    public function ownTrainingView()
    {
        $data = TrainingPeople::where('employee_nik',auth()->user()->employee_id)->get();
        
        return view('apps.pages.userTraining',compact('data'));
    }

    public function employeeTrainingDetail($id)
    {
        $key = Employee::find($id);
        
        $data = DB::table('employees')
                    ->join('training_people','training_people.employee_nik','employees.employee_id')
                    ->join('trainings','trainings.id','training_people.training_id')
                    ->join('statuses','statuses.id','training_people.status_id')
                    ->where('employees.id',$id)
                    ->paginate(10);

        /* $getMember = DB::table('employees')
                        ->join('training_accumulations','training_accumulations.employee_id','employees.id')
                        ->where('employees.report_to',$key->employee_id)
                        ->get(); */
        $getMember = DB::table('employees')
                    ->join('training_people','training_people.employee_nik','employees.employee_id')
                    ->join('trainings','trainings.id','training_people.training_id')
                    ->join('statuses','statuses.id','training_people.status_id')
                    ->where('employees.report_to',$key->employee_id)
                    ->paginate(10);
        
        return view('apps.show.teamTraining',compact('key','data','getMember'));
    }
}
