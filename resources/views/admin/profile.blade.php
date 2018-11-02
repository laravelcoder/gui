@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('title', "Pro")


@section('content')
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
 
         <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Profile</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
       
            	{!! Form::open(['method' => 'POST', 'route' => ['admin.avatar.store'], 'files' => true, 'enctype' => 'multipart/form-data']) !!} 
            	@csrf
              <div class="box-body">
               {{--  <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div> --}}
{{--                 <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div> --}}
                <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="file" name="avatar" id="exampleInputFile">

                  <p class="help-block">Example block-level help text here.</p>
                </div>
          
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                {{-- <button type="submit" value="Upload" class="btn btn-primary">Submit</button> --}}
                {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
              </div>
               
    		{!! Form::close() !!}
          </div>
          <!-- /.box -->

<!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  {{-- <iframe class="embed-responsive-item" src=""></iframe> --}}
</div>

<img src="..." alt="..." class="img-rounded">
<img src="..." alt="..." class="img-circle">
<img src="..." alt="..." class="img-thumbnail">


          <div class="col-md-6">
          	<!-- general form elements -->
          	<div class="box box-primary">
          		<div class="box-header with-border">
          			<h3 class="box-title">Avatar</h3>
          		</div>
          		<div class="box-body">
          			{{-- @each('admin.profile', $avatars, 'avatar') --}}
          			{{-- @foreach($avatars as $avatar) --}}
          	{{-- {{  $avatar  }} --}}
          			{{-- @endforeach --}}
          		</div>
          		<!-- /.box -->
          	</div>
          </div>
@stop

@section('javascript') 

@endsection