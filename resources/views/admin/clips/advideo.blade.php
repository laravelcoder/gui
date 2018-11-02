    <div class="panel panel-default">
        <div class="panel-heading">
            Videos
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.videos.fields.name')</th>
                        <th>@lang('global.videos.fields.extention')</th>
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