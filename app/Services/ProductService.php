<?php

namespace App\Services;

use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\Response;


class ProductService
{

    public function createProduct(StoreProductRequest $request): JsonResponse
    {
        try {
//            $imgName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
//            $url = Storage::url($imgName);

            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => '/storage/default.jpg',
                'price' => $request->price,
                'quantity' => $request->quantity,
                'condition' => $request->condition,
                'type' => $request->type,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
            ]);

//            $file = file_get_contents($request->image);
//            Storage::disk('public')->put($imgName, $file);

            return response()->json(['message' => 'Successfully added new product!', 'id' => $product->id], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong!'], Response::HTTP_CONFLICT);
        }
    }

    public function uploadImage(Product $product, UpdateProductRequest $request)
    {
//        echo $request->file('image')->getClientOriginalExtension();
//        $imgName = Str::random(32) . '.' . $request->image->getClientOriginalExtension();
//        Storage::url($imgName);
//        $product->image = $request->image;
//        $file = file_get_contents($request->image);
//        Storage::disk('public')->put($imgName, $file);
//        $product->save();
//
//        return response()->json(['message' => 'Image uploaded!'], Response::HTTP_OK);
        // TODO: zrobic oddzielny przycisk na uplaod image dla prouktu i chuj,
        // TODO: do tego zrobic tabele dla uzytkownika z produktami ktore ktos od niego kupil
        // TODO: przy kazdym takim rekordzie przycisk wyslij zmaoiwnie, ktory wysla maila do usera
        // TODO: a później jeszcze twrzy pdfa jakiegos czy cos(do wysylki papierek), który też jest wysyłany na maila usera, który wysyla
        // TODO: admin panel z crudem,
        // TODO: docs i wysyłam i się bronie na początkiu następnego tygodnia...
    }

    public function promoteProduct(Product $product): JsonResponse
    {
        $userId = $product->user;
        if ($user = User::findOrFail($userId)) {
            $promotionPrice = $this->countDiscount($user);
            $product->is_promoted = true;
            $product->save();

            return response()->json(['message' => 'Product promoted', 'price' => $promotionPrice], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Something went wrong!'], Response::HTTP_CONFLICT);
    }

    private function countDiscount(User $user): float
    {
        $user->created_at = Carbon::parse('2022-03-01 10:00:00');
        $user->save(); // TODO: test data to delete later

        $promotionPrice = 120.0;

        $userAccountAge = now()->diffInYears($user->created_at);
        // at least one year on portal to get discount
        if ($userAccountAge >= 1) {
            $discount = 0.05; // 5%
            for ($i = 1; $i <= $userAccountAge; $i++) {
                $promotionPrice *= (1 - $discount);
            }
        }

        return $promotionPrice;
    }

    public function getPromotedProducts(): ProductCollection
    {
        $promotedProducts = Product::with('category')->where('is_promoted', true)->paginate();

        return new ProductCollection($promotedProducts);
    }
}
