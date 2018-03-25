<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Product;
use Storage;

class ProductController extends Controller
{
    //Store data
    public function store(Request $request)
    {
        //Validate data
        $validator = Validator::make($request->all(), $this->rules());
        
        //Return errors if any
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        
        $product = Product::forceCreate($request->except('image'));

        //Store data if validation passed
        if($request->has('image')){
            $image = $request->file('image');
            //dd($request->all());
            $filename = 'products/' . strtotime(date('Y:m:d h:i:s')) . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($filename, file_get_contents($image));
            $product->image = 'storage/'.$filename;
            $product->update();
        }
        
        return [
            'title' => 'Success!',
            'message' => 'Product created'
        ];
    }

    //Get data
    public function get()
    {
        return Product::paginate(10);
    }

    //Find Product
    public function find(Product $product)
    {
        return $product;
    }

    //Rules for form validation
    public function rules()
    {
        return [
            'name' => 'required',
            'sale_price' => 'numeric|required',
            'purchase_price' => 'numeric|required',
            'current_stock' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png,gif,tiff',
        ];
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->except('image'));

        if ($request->has('image')) {
            Storage::disk('public')->delete(str_replace("storage/", "", $product->image));
            $image = $request->file('image');
            //dd($request->all());
            $filename = 'products/' . strtotime(date('Y:m:d h:i:s')) . "." . $image->getClientOriginalExtension();
            Storage::disk('public')->put($filename, file_get_contents($image));
            $product->image = 'storage/' . $filename;
            $product->update();
        }

        return [
            'title' => 'Success!',
            'message' => 'Product updated'
        ];
    }
}
