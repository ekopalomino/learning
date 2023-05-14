@extends('apps.layouts.main')
@section('header.title')
Learning Development | Dashboard
@endsection
@section('header.plugins')
<link href="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('header.styles')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawTrainingChart);
    google.charts.setOnLoadCallback(drawCategoryChart);
    function drawTrainingChart() {
        var training = <?php echo $hrsByTitle; ?>;
        var data = google.visualization.arrayToDataTable(training);
        var options = {
          is3D: true,
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.PieChart(document.getElementById('Training_chart_div'));
        chart.draw(data, options);
    }
    function drawCategoryChart() {
        var category = <?php echo $hrsByCategory; ?>;
        var data = google.visualization.arrayToDataTable(category);
        var options = {
          is3D: true,
          legend: { position: 'bottom' }
        };
        var chart = new google.visualization.PieChart(document.getElementById('Category_chart_div'));
        chart.draw(data, options);
    }
</script>
@endsection
@section('content')
@can('Can View Dashboard')
<div class="page-content">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $totalTraining }}">{{ $totalTraining }}</span>
                    </div>
                    <div class="desc"> Total Pelatihan </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $completed }}">{{ $completed }}</span>
                    </div>
                    <div class="desc"> Pelatihan Selesai </div>
                </div>
            </a>
        </div> 
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="{{ $scheduled }}">{{ $scheduled }}</span>
                    </div>
                    <div class="desc"> Pelatihan Blm Mulai </div>
                </div>
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-lg-3 col-xs-12 col-sm-12">
        	<div class="portlet light bordered">
                <div class="portlet-title">
                    <h4 style="text-align:center">Total Jam per Status</h4>
                </div>
                <div class="portlet-body">
                    <div id="Training_chart_div" style="width: 350px; height: 300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-sm-12">
        	<div class="portlet light bordered">
            <div class="portlet-title">
                    <h4 style="text-align:center">Total Jam per Kategori</h4>
                </div>
                <div class="portlet-body">
                    <div id="Category_chart_div" style="width: 350px; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endcan
<div class="page-content">
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
@endsection