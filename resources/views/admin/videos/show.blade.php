@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.videos.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.videos.fields.name')</th>
                            <td field-key='name'>{{ $video->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.videos.fields.video')</th>
                            <td field-key='video'>@if($video->video)<a href="{{ asset(env('UPLOAD_PATH').'/' . $video->video) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.videos.fields.extention')</th>
                            <td field-key='extention'>{{ $video->extention }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.videos.fields.ad-duration')</th>
                            <td field-key='ad_duration'>{{ $video->ad_duration }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.videos.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


