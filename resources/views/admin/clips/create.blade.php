@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clips.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.clips.store'], 'files' => true]) !!} 

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
  {{-- @include('admin.clips.createfields') --}}
            
        </div>
    </div>


@include('admin.clips.advideo') 
{{-- @include('admin.clips.adimage')  --}}
{{-- @include('admin.clips.adbrand')  --}}
{{-- @include('admin.clips.adindusty')  --}}







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


<script src="{{ asset('fileUpload/js/vendor/jquery.ui.widget.js') }}"></script>

{{-- <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script> --}}
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>

<script src="{{ asset('fileUpload/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('fileUpload/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('fileUpload/js/jquery.fileupload-process.js') }}"></script>
<script src="{{ asset('fileUpload/js/jquery.fileupload-image.js') }}"></script>
<script src="{{ asset('fileUpload/js/jquery.fileupload-audio.js') }}"></script>
<script src="{{ asset('fileUpload/js/jquery.fileupload-video.js') }}"></script>
<script src="{{ asset('fileUpload/js/jquery.fileupload-validate.js') }}"></script>
{{-- <script src="{{ asset('fileUpload/js/jquery.fileupload-angular.js') }}"></script>
<script src="{{ asset('fileUpload/js/app.js') }}"></script> --}}

 
 
    <script>
        

        $(function(){
            // if ($('#file-upload').get(0).files.length === 0) {
            //     console.log("No files selected.");
            // }
            // var vidFileLength = $("#file-upload")[0].file.length;
            // if(vidFileLength === 0){
            //     console.log("No file selected.");
            // }
            // if (jQuery('input#fileupload').val() == '') {
            //    console.log("No file selected.");
            // } 


            $("input#title").blur(function () {
                var filename = $('input#fileupload').val();
                    if (filename.substring(3,11) == 'fakepath') {
                        filename = filename.substring(12);
                        filename = filename.substr(0, filename.lastIndexOf('.'));
                    }
                $('input#title').val(filename);
            });
        });
    </script>


<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === '{{ url("/admin/clips/create") }}' ?
                '//jquery-file-upload.appspot.com/' : '{{ route("admin.media.upload") }}',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>

 

@stop