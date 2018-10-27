<tr data-index="{{ $index }}">
    <td>{!! Form::text('videos['.$index.'][name]', old('videos['.$index.'][name]', isset($field) ? $field->name: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('videos['.$index.'][extention]', old('videos['.$index.'][extention]', isset($field) ? $field->extention: ''), ['class' => 'form-control']) !!}</td>
<td>{!! Form::text('videos['.$index.'][ad_duration]', old('videos['.$index.'][ad_duration]', isset($field) ? $field->ad_duration: ''), ['class' => 'form-control']) !!}</td>

    <td>
        <a href="#" class="remove btn btn-xs btn-danger">@lang('quickadmin.qa_delete')</a>
    </td>
</tr>