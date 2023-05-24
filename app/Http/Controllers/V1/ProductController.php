<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductCollection(Product::filter()->paginate());
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        return (new ProductService())->createProduct($request);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return response(['message' => "Product has been updated!", 'Product' => new ProductResource($product)]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }
}
