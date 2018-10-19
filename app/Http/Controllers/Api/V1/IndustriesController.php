<?php

namespace App\Http\Controllers\Api\V1;

use App\Industry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIndustriesRequest;
use App\Http\Requests\Admin\UpdateIndustriesRequest;
use Yajra\DataTables\DataTables;

class IndustriesController extends Controller
{
    public function index()
    {
        return Industry::all();
    }

    public function show($id)
    {
        return Industry::findOrFail($id);
    }

    public function update(UpdateIndustriesRequest $request, $id)
    {
        $industry = Industry::findOrFail($id);
        $industry->update($request->all());
        
        $brands           = $industry->brands;
        $currentBrandData = [];
        foreach ($request->input('brands', []) as $index => $data) {
            if (is_integer($index)) {
                $industry->brands()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentBrandData[$id] = $data;
            }
        }
        foreach ($brands as $item) {
            if (isset($currentBrandData[$item->id])) {
                $item->update($currentBrandData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $industry;
    }

    public function store(StoreIndustriesRequest $request)
    {
        $industry = Industry::create($request->all());
        
        foreach ($request->input('brands', []) as $data) {
            $industry->brands()->create($data);
        }

        return $industry;
    }

    public function destroy($id)
    {
        $industry = Industry::findOrFail($id);
        $industry->delete();
        return '';
    }
}
