@extends('apps.layouts.main')
@section('header.title')
Learning Development | Tambah Training
@endsection
@section('header.plugins')
<link href="{{ asset('assets/global/plugins/bootstrap-summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="page-content">
    <div class="portlet box red ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-database"></i> Form Training Baru
            </div>
        </div>
        <div class="portlet-body form">
            @if (count($errors) > 0) 
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif 
            {!! Form::open(array('route' => 'training.store','method'=>'POST', 'class' => 'form-horizontal','files'=>'true')) !!}
            @csrf
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">ID Training</label>
                    <div class="col-md-2">
                    {!! Form::text('training_id', null, array('placeholder' => 'ID Training','class' => 'form-control','required')) !!}
                    </div>
                    <label class="col-md-1 control-label">Nama Training</label>
                    <div class="col-md-6">
                    {!! Form::text('training_name', null, array('placeholder' => 'Training Name','class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Kategori Training</label>
                    <div class="col-md-2">
                    {!! Form::select('category', [null=>'Please Select'] + $categories,[], array('class' => 'form-control','required')) !!}
                    </div>
                    <label class="col-md-1 control-label">Level Training</label>
                    <div class="col-md-2">
                    {!! Form::select('level', [null=>'Please Select'] + $level,[], array('class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Minimum Skor</label>
                    <div class="col-md-2">
                    {!! Form::number('minimum_score', null, array('placeholder' => 'Minimum Score','class' => 'form-control','required')) !!}
                    </div>
                    <label class="col-md-1 control-label">Nama Trainer</label>
                    <div class="col-md-3">
                    {!! Form::select('facilitator_id', [null=>'Please Select'] + $facilitator,[], array('class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Tanggal Mulai</label>
                    <div class="col-md-2">
                    {{ Form::input('dateTime-local', 'start_date',null, ['id' => 'start-date', 'class' => 'form-control','required']) }}
                    </div>
                    <label class="col-md-1 control-label">Tanggal Selesai</label>
                    <div class="col-md-2">
                    {{ Form::input('dateTime-local', 'end_date',null, ['id' => 'start-date', 'class' => 'form-control','required']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Jenis Kelas</label>
                    <div class="col-md-2">
                    {!! Form::select('jenis_kelas', [null=>'Please Select'] + $types,[], array('class' => 'form-control','required')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Deskripsi</label>
                    <div class="col-md-9">
                        <textarea class="textarea" name="deskripsi" id="deskripsi" placeholder="Place some text here"
							style="width: 100%; height: 1000px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
						</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Upload Cover</label>
                    <div class="col-md-2">
                        {!! Form::file('cover_image', null, array('placeholder' => 'Cover Image','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">Upload Peserta</label>
                    <div class="col-md-2">
                        {!! Form::file('participants', null, array('placeholder' => 'Participant File','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-actions right">
                    <a button type="button" class="btn default" href="{{ route('training.index') }}">Tutup</a>
                    <button type="submit" class="btn blue">
                    <i class="fa fa-check"></i> Simpan</button>
                </div>
            </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer.plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-summernote/summernote.min.js') }}" type="text/javascript"></script>
@endsection
@section('footer.scripts')
<script src="{{ asset('assets/pages/scripts/form-samples.min.js') }}" type="text/javascript"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection