@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.images.title')</h3>
    
    {!! Form::model($image, ['method' => 'PUT', 'route' => ['admin.images.update', $image->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    @if ($image->image)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$image->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$image->image) }}"></a>
                    @endif
                    {!! Form::label('image', trans('global.images.fields.image').'', ['class' => 'control-label']) !!}
                    {!! Form::file('image', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('image_max_size', 20) !!}
                    {!! Form::hidden('image_max_width', 24000) !!}
                    {!! Form::hidden('image_max_height', 24000) !!}
                    <p class="help-block"></p>
                    @if($errors->has('image'))
                        <p class="help-block">
                            {{ $errors->first('image') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

