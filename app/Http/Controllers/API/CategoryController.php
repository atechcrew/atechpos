<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        Category::create($request->all());
        return [
            'title' => 'Success!',
            'message' => 'Category saved.'
        ];
    }

    public function getAll($searchPerm = "")
    {
        return trim($searchPerm) == '---nothing---' ? 
        Category::orderByDesc('id')->paginate(20) : 
        Category::orderByDesc('id')->search($searchPerm)->paginate(20);
    }

    public function find(Category $category)
    {
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return [
            'title' => 'Success!',
            'message' => 'Category deleted.',
            'type' => 'danger'
        ];
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return [
            'title' => 'Success!',
            'message' => 'Category updated.'
        ];
    }
}
