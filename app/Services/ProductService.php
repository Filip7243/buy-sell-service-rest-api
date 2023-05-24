<?php

namespace App\Services;

use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    public function createProduct(StoreProductRequest $request)
    {
        try {
            $imgName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();

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

    public function promoteProduct(Product $product)
    {
        $userId = $product->user_id;
        if ($user = User::findOrFail($userId)) {
            $promotionPrice = countDiscount($user);
        }

    }

    private function countDiscount(User $user)
    {
        $user->created_at = Carbon::parse('2022-03-01 10:00:00');
        $user->save(); // TODO: test data to delete later

        $promotionPrice = 120.0;

        $userAccountAge = now()->diffInYears($user->created_at);
        // at least one year on portal to get discount
        if ($userAccountAge >= 1) {
            $discount = 0.95;
            for ($i = 1; $i <= $userAccountAge; $i++) {
                $promotionPrice *= $discount;
            }
        }

        return $promotionPrice;
    }
}
