<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;

class BrandController extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
        Brand::create($request->all());
        return [
            'title' => 'Success!',
            'message' => 'Brand saved.'
        ];
    }

    public function getAll($searchPerm = "")
    {
        return trim($searchPerm) == '---nothing---' ?
            Brand::orderByDesc('id')->paginate(20) :
            Brand::orderByDesc('id')->search($searchPerm)->paginate(20);
    }

    public function find(Brand $brand)
    {
        return $brand;
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return [
            'title' => 'Success!',
            'message' => 'Brand deleted.',
            'type' => 'danger'
        ];
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());
        return [
            'title' => 'Success!',
            'message' => 'Brand updated.'
        ];
    }
}
