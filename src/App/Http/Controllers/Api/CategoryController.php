<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domain\Products\Data\CategoryData;
use Domain\Products\Models\Category;
use Illuminate\Http\Response;
use Spatie\LaravelData\PaginatedDataCollection;

class CategoryController extends Controller
{
    public function __construct(public Category $model)
    {
        $this->middleware('auth:sanctum')->only(['store', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return PaginatedDataCollection<array-key, CategoryData>
     */
    public function index()
    {
        return CategoryData::collection(
            $this->model->query()->latest('id')->paginate()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryData $data): CategoryData
    {
        $category = $this->model->query()->create(
            $data->toArray()
        );

        return CategoryData::from($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): CategoryData
    {
        return CategoryData::from($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryData $data, Category $category): Response
    {
        $category->update($data->only('title', 'parent_id')->toArray());

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): Response
    {
        $category->delete();

        return response()->noContent();
    }
}
