@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clips.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.clips.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('global.clips.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_enabled', trans('global.clips.fields.ad-enabled').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('ad_enabled', 0) !!}
                    {!! Form::checkbox('ad_enabled', 1, old('ad_enabled', true), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_enabled'))
                        <p class="help-block">
                            {{ $errors->first('ad_enabled') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total_impressions', trans('global.clips.fields.total-impressions').'', ['class' => 'control-label']) !!}
                    {!! Form::number('total_impressions', old('total_impressions'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('total_impressions'))
                        <p class="help-block">
                            {{ $errors->first('total_impressions') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('recommended_frequency', trans('global.clips.fields.recommended-frequency').'', ['class' => 'control-label']) !!}
                    {!! Form::text('recommended_frequency', old('recommended_frequency'), ['class' => 'form-control', 'placeholder' => 'Frequency you want to target by defualt']) !!}
                    <p class="help-block">Frequency you want to target by defualt</p>
                    @if($errors->has('recommended_frequency'))
                        <p class="help-block">
                            {{ $errors->first('recommended_frequency') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_airing_date_first', trans('global.clips.fields.ad-airing-date-first').'', ['class' => 'control-label']) !!}
                    {!! Form::text('ad_airing_date_first', old('ad_airing_date_first'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_airing_date_first'))
                        <p class="help-block">
                            {{ $errors->first('ad_airing_date_first') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ad_airing_date_last', trans('global.clips.fields.ad-airing-date-last').'', ['class' => 'control-label']) !!}
                    {!! Form::text('ad_airing_date_last', old('ad_airing_date_last'), ['class' => 'form-control date', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_airing_date_last'))
                        <p class="help-block">
                            {{ $errors->first('ad_airing_date_last') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('brand_id', trans('global.clips.fields.brand').'', ['class' => 'control-label']) !!}
                    {!! Form::select('brand_id', $brands, old('brand_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('brand_id'))
                        <p class="help-block">
                            {{ $errors->first('brand_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('industry_id', trans('global.clips.fields.industry').'', ['class' => 'control-label']) !!}
                    {!! Form::select('industry_id', $industries, old('industry_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('industry_id'))
                        <p class="help-block">
                            {{ $errors->first('industry_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('advertiser', trans('global.clips.fields.advertiser').'', ['class' => 'control-label']) !!}
                    {!! Form::text('advertiser', old('advertiser'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('advertiser'))
                        <p class="help-block">
                            {{ $errors->first('advertiser') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('product', trans('global.clips.fields.product').'', ['class' => 'control-label']) !!}
                    {!! Form::text('product', old('product'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('product'))
                        <p class="help-block">
                            {{ $errors->first('product') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.clips.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('notes', trans('global.clips.fields.notes').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('notes', old('notes'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('notes'))
                        <p class="help-block">
                            {{ $errors->first('notes') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('agency', trans('global.clips.fields.agency').'', ['class' => 'control-label']) !!}
                    {!! Form::text('agency', old('agency'), ['class' => 'form-control', 'placeholder' => 'ex: dish']) !!}
                    <p class="help-block">ex: dish</p>
                    @if($errors->has('agency'))
                        <p class="help-block">
                            {{ $errors->first('agency') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sourceurl', trans('global.clips.fields.sourceurl').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sourceurl', old('sourceurl'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sourceurl'))
                        <p class="help-block">
                            {{ $errors->first('sourceurl') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('imagespath', trans('global.clips.fields.imagespath').'', ['class' => 'control-label']) !!}
                    {!! Form::text('imagespath', old('imagespath'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('imagespath'))
                        <p class="help-block">
                            {{ $errors->first('imagespath') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cai_path', trans('global.clips.fields.cai-path').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cai_path', old('cai_path'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cai_path'))
                        <p class="help-block">
                            {{ $errors->first('cai_path') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('caipyurl', trans('global.clips.fields.caipyurl').'', ['class' => 'control-label']) !!}
                    {!! Form::text('caipyurl', old('caipyurl'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('caipyurl'))
                        <p class="help-block">
                            {{ $errors->first('caipyurl') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('isci_ad_id', trans('global.clips.fields.isci-ad-id').'', ['class' => 'control-label']) !!}
                    {!! Form::text('isci_ad_id', old('isci_ad_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('isci_ad_id'))
                        <p class="help-block">
                            {{ $errors->first('isci_ad_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('copylength', trans('global.clips.fields.copylength').'', ['class' => 'control-label']) !!}
                    {!! Form::text('copylength', old('copylength'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('copylength'))
                        <p class="help-block">
                            {{ $errors->first('copylength') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('media_content', trans('global.clips.fields.media-content').'', ['class' => 'control-label']) !!}
                    {!! Form::text('media_content', old('media_content'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('media_content'))
                        <p class="help-block">
                            {{ $errors->first('media_content') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('media_filename', trans('global.clips.fields.media-filename').'', ['class' => 'control-label']) !!}
                    {!! Form::text('media_filename', old('media_filename'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('media_filename'))
                        <p class="help-block">
                            {{ $errors->first('media_filename') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('scheduledate', trans('global.clips.fields.scheduledate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('scheduledate', old('scheduledate'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('scheduledate'))
                        <p class="help-block">
                            {{ $errors->first('scheduledate') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('expirationdate', trans('global.clips.fields.expirationdate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('expirationdate', old('expirationdate'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('expirationdate'))
                        <p class="help-block">
                            {{ $errors->first('expirationdate') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('family', trans('global.clips.fields.family').'', ['class' => 'control-label']) !!}
                    {!! Form::text('family', old('family'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('family'))
                        <p class="help-block">
                            {{ $errors->first('family') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('subfamily', trans('global.clips.fields.subfamily').'', ['class' => 'control-label']) !!}
                    {!! Form::text('subfamily', old('subfamily'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('subfamily'))
                        <p class="help-block">
                            {{ $errors->first('subfamily') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('group', trans('global.clips.fields.group').'', ['class' => 'control-label']) !!}
                    {!! Form::text('group', old('group'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('group'))
                        <p class="help-block">
                            {{ $errors->first('group') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('caipy_clipids', trans('global.clips.fields.caipy-clipids').'', ['class' => 'control-label']) !!}
                    {!! Form::text('caipy_clipids', old('caipy_clipids'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('caipy_clipids'))
                        <p class="help-block">
                            {{ $errors->first('caipy_clipids') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('reviewstate', trans('global.clips.fields.reviewstate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('reviewstate', old('reviewstate'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('reviewstate'))
                        <p class="help-block">
                            {{ $errors->first('reviewstate') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ignoreimport', trans('global.clips.fields.ignoreimport').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('ignoreimport', 0) !!}
                    {!! Form::checkbox('ignoreimport', 1, old('ignoreimport', true), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ignoreimport'))
                        <p class="help-block">
                            {{ $errors->first('ignoreimport') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Videos
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.videos.fields.name')</th>
                        <th>@lang('global.videos.fields.ad-duration')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="videos">
                    @foreach(old('videos', []) as $index => $data)
                        @include('admin.clips.videos_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Images
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="images">
                    @foreach(old('images', []) as $index => $data)
                        @include('admin.clips.images_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Industry
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.industry.fields.name')</th>
                        <th>@lang('global.industry.fields.slug')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="industry">
                    @foreach(old('industries', []) as $index => $data)
                        @include('admin.clips.industries_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Brands
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.brands.fields.name')</th>
                        <th>@lang('global.brands.fields.brand-url')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="brands">
                    @foreach(old('brands', []) as $index => $data)
                        @include('admin.clips.brands_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="videos-template">
        @include('admin.clips.videos_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="images-template">
        @include('admin.clips.images_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="industry-template">
        @include('admin.clips.industries_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="brands-template">
        @include('admin.clips.brands_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
@stop