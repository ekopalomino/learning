<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Training;
use iteos\Models\TrainingPeople;
use iteos\Models\TrainingLevel;
use iteos\Models\TrainingCategory;
use iteos\Models\Facilitator;
use iteos\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class ReportManagementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Can Access Reports');
    }

    /*----Sales Reports--------------------*/
    public function trainingTable()
    {
        $getName = Training::where('status','3')->pluck('training_name','id')->toArray();
        $getCategory = TrainingCategory::where('status_id','7')->pluck('category_name','id')->toArray();

        return view('apps.pages.trainingTable',compact('getName','getCategory'));
    }

    public function showTrainingReport(Request $request)
    {
        $byId = $request->input('training_id');
        $byName = $request->input('training_name');
        $byCategory = $request->input('training_category');
        $byLevel = $request->input('training_level');

        if($byId == null && $byName == null && $byCategory == null && $byLevel == null) {
            $notification = array (
                'message' => 'Filter Belum Dipilih',
                'alert-type' => 'error'
            );
    
            return redirect()->route('reportTraining.index')->with($notification);
        } elseif ($byId == null) {
            $data = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->where('trainings.training_name',$byName)
                        ->get();
            
            return view('apps.reports.trainingById',compact('data'));
        }
    }
}
