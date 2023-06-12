<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use http\Env\Request;
use Illuminate\Http\JsonResponse;
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
        echo $request->img;
        $product->update($request->all());

        return response(
            ['message' => "Product has been updated!", 'img' => $request->image],
            Response::HTTP_OK);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function getPromotedProducts(): ProductCollection
    {
        return (new ProductService())->getPromotedProducts();
    }

    public function promoteProduct(Product $product): JsonResponse
    {
        return (new ProductService())->promoteProduct($product);
    }

    public function uploadImage(Product $product, UpdateProductRequest $request)
    {
        return (new ProductService())->uploadImage($product, $request);
    }
}
