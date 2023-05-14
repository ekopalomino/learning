<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\Sale;
use iteos\Models\SaleItem;
use iteos\Models\Purchase;
use iteos\Models\Delivery;
use iteos\Models\Contact;
use iteos\Charts\DashboardChart;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('apps.pages.dashboard');
    }
}
