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