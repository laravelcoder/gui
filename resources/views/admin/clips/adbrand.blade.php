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