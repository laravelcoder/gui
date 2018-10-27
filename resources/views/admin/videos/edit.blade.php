@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.videos.title')</h3>
    
    {!! Form::model($video, ['method' => 'PUT', 'route' => ['admin.videos.update', $video->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('clip_id', trans('global.videos.fields.clip').'', ['class' => 'control-label']) !!}
                    {!! Form::select('clip_id', $clips, old('clip_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('clip_id'))
                        <p class="help-block">
                            {{ $errors->first('clip_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.videos.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('video', trans('global.videos.fields.video').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('video', old('video')) !!}
                    @if ($video->video)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $video->video) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('video', ['class' => 'form-control']) !!}
                    {!! Form::hidden('video_max_size', 200) !!}
                    <p class="help-block"></p>
                    @if($errors->has('video'))
                        <p class="help-block">
                            {{ $errors->first('video') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('extention', trans('global.videos.fields.extention').'', ['class' => 'control-label']) !!}
                    {!! Form::text('extention', old('extention'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('extention'))
                        <p class="help-block">
                            {{ $errors->first('extention') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_duration', trans('global.videos.fields.ad-duration').'', ['class' => 'control-label']) !!}
                    {!! Form::text('ad_duration', old('ad_duration'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_duration'))
                        <p class="help-block">
                            {{ $errors->first('ad_duration') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

