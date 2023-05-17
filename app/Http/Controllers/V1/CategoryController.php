<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCategoryRequest;
use App\Http\Requests\V1\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use App\Services\V1\CategoryQuery;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        //TODO: handel transform
        $filter = new CategoryQuery();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new CategoryCollection(Category::paginate());
        } else {
            return new CategoryCollection(Category::where($queryItems)->paginate());
        }
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->all()));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
    }

    public function destroy($id)
    {
        if ($foundCategory = Category::find($id)) {
            $foundCategory->delete();

            return response([
                'message' => 'Category: ' . $foundCategory->name . ' deleted'
            ], Response::HTTP_NO_CONTENT);
        }

        return response(['message' => 'Category: ' . $id . ' not found!'],
            Response::HTTP_NOT_FOUND);
    }
}
