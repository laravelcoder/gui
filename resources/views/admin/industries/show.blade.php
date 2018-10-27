@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.industry.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.industry.fields.name')</th>
                            <td field-key='name'>{{ $industry->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.industry.fields.slug')</th>
                            <td field-key='slug'>{{ $industry->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#brands" aria-controls="brands" role="tab" data-toggle="tab">Brands</a></li>
<li role="presentation" class=""><a href="#clips" aria-controls="clips" role="tab" data-toggle="tab">Clips</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="brands">
<table class="table table-bordered table-striped {{ count($brands) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.brands.fields.name')</th>
                        <th>@lang('global.brands.fields.brand-url')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($brands) > 0)
            @foreach ($brands as $brand)
                <tr data-entry-id="{{ $brand->id }}">
                    <td field-key='name'>{{ $brand->name }}</td>
                                <td field-key='brand_url'>{{ $brand->brand_url }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.brands.restore', $brand->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.brands.perma_del', $brand->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('brand_view')
                                    <a href="{{ route('admin.brands.show',[$brand->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('brand_edit')
                                    <a href="{{ route('admin.brands.edit',[$brand->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('brand_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.brands.destroy', $brand->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="clips">
<table class="table table-bordered table-striped {{ count($clips) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.clips.fields.industry')</th>
                        <th>@lang('global.clips.fields.advertiser')</th>
                        <th>@lang('global.clips.fields.product')</th>
                        <th>@lang('global.clips.fields.title')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($clips) > 0)
            @foreach ($clips as $clip)
                <tr data-entry-id="{{ $clip->id }}">
                    <td field-key='industry'>{{ $clip->industry->name ?? '' }}</td>
                                <td field-key='advertiser'>{{ $clip->advertiser }}</td>
                                <td field-key='product'>{{ $clip->product }}</td>
                                <td field-key='title'>{{ $clip->title }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clips.restore', $clip->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clips.perma_del', $clip->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('clip_view')
                                    <a href="{{ route('admin.clips.show',[$clip->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('clip_edit')
                                    <a href="{{ route('admin.clips.edit',[$clip->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('clip_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clips.destroy', $clip->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="34">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.industries.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


