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
                        ->where('training_people.employee_nik',auth()->user()->employee_nik)
                        ->count('trainings.id');
        $userCompleted = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->where('training_people.employee_nik',auth()->user()->employee_nik)
                        ->where('trainings.status','3')
                        ->count('trainings.id');
        $userScheduled = DB::table('trainings')
                        ->join('training_people','training_people.training_id','trainings.id')
                        ->where('training_people.employee_nik',auth()->user()->employee_nik)
                        ->where('trainings.status','1')
                        ->count('trainings.id');
       
        $completed = Training::where('status','3')->count();
        $scheduled = Training::where('status','1')->count();
        $hrsByTitle = DB::table('trainings')
                        ->join('statuses','trainings.status','statuses.id')
                        ->select(DB::raw('statuses.name as Status'), DB::raw('sum(timestampdiff(hour, start_date, end_date)) as total'))
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

        return view('apps.pages.dashboard',compact('totalTraining','userTraining','userCompleted','userScheduled','completed','scheduled'))->with('hrsByTitle',json_encode($statusHrs))
                    ->with('hrsByCategory',json_encode($catHrs))
                    ->with('hrsByLevel',json_encode($levHrs));
    }
}
