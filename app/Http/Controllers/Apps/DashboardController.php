<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Training;
use iteos\Models\TrainingPeople;
use iteos\Models\Facilitator;
use iteos\Charts\DashboardChart;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTraining = Training::count();
        $userTraining = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->where('training_people.employee_nik',auth()->user()->employee_id)
                        ->count('trainings.id');
        $userCompleted = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->where('training_people.employee_nik',auth()->user()->employee_id)
                        ->where('trainings.status','3')
                        ->count('trainings.id');
        $userScheduled = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->where('training_people.employee_nik',auth()->user()->employee_id)
                        ->where('trainings.status','1')
                        ->count('trainings.id');
        
        $upcoming = Training::where('status','1')->orderBy('start_date','ASC')->take(10)->get();
        $accumUser = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->join('users','users.employee_id','training_people.employee_nik')
                        ->join('divisions','divisions.id','users.division_id')
                        ->select(DB::raw('training_people.employee_nik as nik'),DB::raw('training_people.employee_name as name'),DB::raw('divisions.name as divisi'),DB::raw('sum(timestampdiff(hour, trainings.start_date, trainings.end_date)) as total'))
                        ->where('trainings.status','3')
                        ->groupBy('training_people.employee_nik','training_people.employee_name','divisions.name')
                        ->get();

        $accumLogin = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->join('users','users.employee_id','training_people.employee_nik')
                        ->join('divisions','divisions.id','users.division_id')
                        ->select(DB::raw('training_people.employee_nik as nik'),DB::raw('training_people.employee_name as name'),DB::raw('divisions.name as divisi'),DB::raw('sum(timestampdiff(hour, trainings.start_date, trainings.end_date)) as total'))
                        ->where('trainings.status','3')
                        ->where('training_people.employee_nik',auth()->user()->employee_id)
                        ->groupBy('training_people.employee_nik','training_people.employee_name','divisions.name')
                        ->get();
        
        $completed = Training::where('status','3')->count();
        $scheduled = Training::where('status','1')->count();
        $hrsByTitle = DB::table('trainings')
                        ->join('statuses','trainings.status','statuses.id')
                        ->select(DB::raw('statuses.name as Status'), DB::raw('sum(timestampdiff(hour, trainings.start_date, trainings.end_date)) as total'))
                        ->groupBy('statuses.name')
                        ->get();
        $statusHrs[] = ['Status','total'];
        foreach($hrsByTitle as $key=>$value) {
        	$statusHrs[++$key] = [$value->Status,(int)$value->total];
        }
        $hrsByCategory = DB::table('trainings')
                        ->join('training_categories','training_categories.id','trainings.category')
                        ->select(DB::raw('training_categories.category_name as Category'), DB::raw('sum(timestampdiff(hour, trainings.start_date, trainings.end_date)) as total'))
                        ->groupBy('training_categories.category_name')
                        ->get();
        $catHrs[] = ['Category','total'];
        foreach($hrsByCategory as $key=>$value) {
        	$catHrs[++$key] = [$value->Category,(int)$value->total];
        }
        $hrsByLevel = DB::table('trainings')
                        ->join('training_levels','training_levels.id','trainings.level')
                        ->select(DB::raw('training_levels.level_name as Level'), DB::raw('sum(timestampdiff(hour, trainings.start_date, trainings.end_date)) as total'))
                        ->groupBy('training_levels.level_name')
                        ->get();
        $levHrs[] = ['Level','total'];
        foreach($hrsByLevel as $key=>$value) {
        	$levHrs[++$key] = [$value->Level,(int)$value->total];
        }
        $hrsByTrainer = DB::table('trainings')
                        ->join('facilitators','facilitators.id','trainings.facilitator_id')
                        ->select(DB::raw('facilitators.facilitator_name as Trainer'), DB::raw('sum(timestampdiff(hour, trainings.start_date, trainings.end_date)) as total'))
                        ->groupBy('facilitators.facilitator_name')
                        ->get();
        $trainHrs[] = ['Trainer','total'];
        foreach($hrsByTrainer as $key=>$value) {
        	$trainHrs[++$key] = [$value->Trainer,(int)$value->total];
        }

        return view('apps.pages.dashboard',compact('totalTraining','userTraining','userCompleted','userScheduled','completed','scheduled','upcoming','accumUser','accumLogin'))
                    ->with('hrsByTitle',json_encode($statusHrs))
                    ->with('hrsByCategory',json_encode($catHrs))
                    ->with('hrsByLevel',json_encode($levHrs))
                    ->with('hrsByTrainer',json_encode($trainHrs));
    }
}
