<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Contact;
use iteos\Models\Facilitator;
use iteos\Models\Quesioner;
use iteos\Models\QuesionerDetail;
use iteos\Models\Training;
use iteos\Models\TrainingLevel;
use iteos\Models\TrainingCategory;
use iteos\Models\TrainingPeople;
use iteos\Models\TrainingHour;
use iteos\Models\TrainingScoreTemp;
use iteos\Imports\TrainingPeopleImport;
use iteos\Imports\TrainingScore;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class TrainingManagementController extends Controller
{
    public function facilitatorIndex()
    {
        $data = Facilitator::orderBy('facilitator_name','asc')->get();
        
        return view('apps.pages.facilitator',compact('data'));
    }

    public function facilitatorStore(Request $request)
    {
        if($request->hasFile('facilitator_picture')) {

            $this->validate($request, [
                'facilitator_name' => 'required|unique:facilitators,facilitator_name',
                'descriptions' => 'required',
                'facilitator_picture' => 'image'
            ]);

            $file = $request->file('facilitator_picture');
            $file_name = $file->getClientOriginalName();
            $size = $file->getSize();
            $ext = $file->getClientOriginalExtension();
            $destinationPath = 'public/trainers';
            $extension = $file->getClientOriginalExtension();
            $filename=$file_name.'_event.'.$extension;
            $uploadSuccess = $request->file('facilitator_picture')
            ->move($destinationPath, $filename);

            $input = [
                'facilitator_name' => $request->input('facilitator_name'),
                'descriptions' => $request->input('descriptions'),
                'status' => '2b643e21-a94c-4713-93f1-f1cbde6ad633',
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
                'status' => '2b643e21-a94c-4713-93f1-f1cbde6ad633',
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
        
        return view('apps.edit.facilitator',compact('data'));
    }

    public function facilitatorUpdate()
    {

    }

    public function facilitatorDestroy()
    {

    }

    public function questionerIndex()
    {
        $data = Quesioner::orderBy('id','asc')->get();
        
        return view('apps.pages.questioner',compact('data'));
    }

    public function questionCreate()
    {

    }

    public function trainingIndex()
    {
        $data = Training::orderBy('training_id','asc')->get();
        $level = TrainingLevel::pluck('level_name','id')->toArray();
        $facilitator = Facilitator::pluck('facilitator_name','id')->toArray();
        $categories = TrainingCategory::pluck('category_name','id')->toArray();

        return view('apps.pages.trainings',compact('data','level','facilitator','categories'));
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
            'start_date' => 'required',
            'end_date' => 'required',
            'participants' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);

        $input = [
            'training_id' => $request->input('training_id'),
            'training_name' => $request->input('training_name'),
            'level' => $request->input('level'),
            'category' => $request->input('category'),
            'facilitator_id' => $request->input('facilitator_id'),
            'minimum_score' => $request->input('minimum_score'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
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

    public function trainingEdit($id)
    {
        $data = Training::find($id);
        $level = TrainingLevel::pluck('level_name','id')->toArray();
        $facilitator = Facilitator::pluck('facilitator_name','id')->toArray();
        $categories = TrainingCategory::pluck('category_name','id')->toArray();
        
        return view('apps.edit.training',compact('data','level','facilitator','categories'))->renderSections()['content'];
    }

    public function trainingStart($id)
    {
        $data = Training::find($id);
        $input = [
            'status' => '2',
            'updated_by' => auth()->user()->id,
        ];

        $update = Training::find($id)->update($input);
        $log = 'Training '.($data->training_name).' Telah Dimulai';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Training '.($data->training_name).' Telah Dimulai',
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

    public function trainingUpdate(Request $request,$id)
    {
        $this->validate($request, [
            'training_name' => 'required',
            'level' => 'required',
            'category' => 'required',
            'facilitator_id' => 'required',
            'minimum_score' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $input = [
            'training_id' => $request->input('training_id'),
            'training_name' => $request->input('training_name'),
            'level' => $request->input('level'),
            'category' => $request->input('category'),
            'facilitator_id' => $request->input('facilitator_id'),
            'minimum_score' => $request->input('minimum_score'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
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

    public function trainingScoreCreate($id)
    {
        $data = Training::find($id);

        return view('apps.input.trainingScore',compact('data'))->renderSections()['content'];
    }
    
    public function trainingScoreStore(Request $request,$id)
    {
        $this->validate($request, [
            'participants' => 'required|file|mimes:xlsx,xls,XLSX,XLS'
        ]);
        $sources = TrainingPeople::where('training_id',$id)->get();
       
        $participant = Excel::toArray(new TrainingPeopleImport, $request->file('participants'))[0];
        $up = collect($participant);
        $up = $up->keyBy('id');
        foreach($sources->keyBy('employee_nik') as $key => $item) {
            $scores = TrainingPeople::where('training_id',$id)->where('employee_nik',$key)->update([
                'pre_score' => $up[$key]['pre_test'],
                'post_score' => $up[$key]['post_test'],
                'status_id' => $up[$key]['status'],
            ]);
            
        }
    }

    public function trainingDestroy($id)
    {
        $data = Training::find($id);
        $log = 'Training '.($data->training_name).' Berhasil Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Training '.($data->training_name).' Berhasil Dihapus',
            'alert-type' => 'success'
        );
        $data->delete();

        return redirect()->route('training.index')->with($notification);
    }

    public function trainingLevelIndex()
    {
        $data = TrainingLevel::orderBy('level_name','asc')->get();
        
        return view('apps.pages.trainingLevel',compact('data'));
    }

    public function trainingLevelStore(Request $request)
    {
        $this->validate($request, [
            'level_name' => 'required|unique:training_levels,level_name',
        ]);

        $input = [
            'level_name' => $request->input('level_name'),
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

        $input = [
            'level_name' => $request->input('level_name'),
        ];
        $data = TrainingLevel::find($id)->update($input);
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
        $data->delete();

        return redirect()->route('level.index')->with($notification);
    }

    public function trainingHourIndex()
    {
        $data = TrainingHour::orderBy('id','asc')->get();
        
        return view('apps.pages.trainingHours',compact('data'));
    }

    

    public function trainingPeopleShow($id)
    {
        $training = Training::find($id);
        $data = TrainingPeople::with('Trainings')->where('training_id',$id)->get();
        $participants = TrainingPeople::with('Trainings')->where('training_id',$id)->get()->count();
        
        return view('apps.show.trainingPeople',compact('data','training','participants'));
    }

    public function trainingCategoryIndex()
    {
        $data = TrainingCategory::orderBy('category_name','asc')->get();
        
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
        $data->delete();

        return redirect()->route('category.index')->with($notification);
    }
}
