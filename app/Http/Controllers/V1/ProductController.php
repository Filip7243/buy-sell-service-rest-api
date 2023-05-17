<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\Services\V1\CategoryQuery;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = new CategoryQuery();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new ProductCollection(Product::paginate());
        } else {
            return new ProductCollection(Product::where($queryItems)->paginate());
        }

    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        return new ProductResource(Product::create($request->all()));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return response(['message' => "Product has been updated!", 'Product' => new ProductResource($product)]);
    }

    public function destroy($id)
    {
        if ($product = Product::find($id)) {
            $product->delete();

            return response([
                'message' => 'Product: ' . $product->name . ' deleted'
            ], Response::HTTP_NO_CONTENT);
        }

        return response(['message' => 'Product: ' . $id . ' not found!'],
            Response::HTTP_NOT_FOUND);
    }
}
