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