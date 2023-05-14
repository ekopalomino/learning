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
        $completed = Training::where('status','3')->count();
        $scheduled = Training::where('status','1')->count();
        $hrsByTitle = DB::table('trainings')
                        ->join('statuses','trainings.status','statuses.id')
                        ->select(DB::raw('statuses.name as Status'), DB::raw('sum(timestampdiff(hour, start_date, end_date)) as total'))
                        ->groupBy('statuses.name')
                        ->get();
        $statusHrs[] = ['status','total'];
        foreach($hrsByTitle as $key=>$value) {
        	$statusHrs[++$key] = [$value->Status,(int)$value->total];
        }
        $hrsByCategory = DB::table('trainings')
                        ->join('training_categories','training_categories.id','trainings.category')
                        ->select(DB::raw('training_categories.category_name as Category'), DB::raw('sum(timestampdiff(hour, trainings.start_date, trainings.end_date)) as total'))
                        ->groupBy('training_categories.category_name')
                        ->get();
        $catHrs[] = ['status','total'];
        foreach($hrsByCategory as $key=>$value) {
        	$catHrs[++$key] = [$value->Category,(int)$value->total];
        }

        return view('apps.pages.dashboard',compact('totalTraining','completed','scheduled'))->with('hrsByTitle',json_encode($statusHrs))->with('hrsByCategory',json_encode($catHrs));
    }
}
