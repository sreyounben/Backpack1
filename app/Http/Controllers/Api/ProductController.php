<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Http\Resources\ProductResource;


class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(10);
        return ProductResource::collection($products);
    }

    public function store(ProductRequest $request)
    {

        return Product::create($request->all());

    }

    public function show($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }

    public function update(Request $request, $id)
    {
        Product::find($id)->update( $request->all());
        return (['success','data update success']);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return ['message' => "Record deleted."];

    }
  }
