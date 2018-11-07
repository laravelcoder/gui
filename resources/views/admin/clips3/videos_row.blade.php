<tr data-index="{{ $index }}">
   
    <td>{!! Form::text('videos['.$index.'][name]', old('videos['.$index.'][name]', isset($field) ? $field->name: ''), ['id' => 'name', 'class' => 'form-control']) !!}</td>
    {{-- <td>{!! Form::text('videos['.$index.'][extention]', old('videos['.$index.'][extention]', isset($field) ? $field->extention: ''), ['class' => 'form-control']) !!}</td> --}}
    {{-- <td>{!! Form::text('videos['.$index.'][ad_duration]', old('videos['.$index.'][ad_duration]', isset($field) ? $field->ad_duration: ''), ['class' => 'form-control']) !!}</td> --}}
 <td>
        {!! Form::hidden('videos['.$index.'][video]', old('videos['.$index.'][video]')) !!}
        {!! Form::file('videos['.$index.'][video]', ['id'=>'fileupload','class' => 'form-control file-upload']) !!}
        {{-- <input type="file" id="fileupload" name="'videos['.$index.'][video]'" value="{{ old('videos['.$index.'][video]') }}" class="form-control file-upload"> --}}
        <br>
            <div id="progress" class="progress"> <div class="progress-bar progress-bar-success"></div> </div>
    </td>
    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('global.app_delete')</a>
    </td>
</tr>
