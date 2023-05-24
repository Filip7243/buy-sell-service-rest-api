<?php

namespace App\Services;

use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class ProductService {

    public function createProduct(StoreProductRequest $request) {
        try {
            $imgName = Str::random(32).'.'.$request->image->getClientOriginalExtension();

            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imgName,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'condition' => $request->condition,
                'type' => $request->type,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
            ]);
            Storage::disk('public')->put($imgName, file_get_contents($request->image));

            return response()->json(['message' => 'Successfully added new product!'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong!'], Response::HTTP_CONFLICT);
        }
    }
}
