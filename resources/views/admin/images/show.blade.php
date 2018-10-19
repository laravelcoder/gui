@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.images.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.images.fields.image')</th>
                            <td field-key='image'>@if($image->image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $image->image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $image->image) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.images.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


