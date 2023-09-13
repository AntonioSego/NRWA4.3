<?php
       
namespace App\Http\Controllers\API;
       
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Category;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;
       
class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $categories = Category::all();
        
        return $this->sendResponse(CategoryResource::collection($categories), 'Categories retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
       
        $validator = Validator::make($input, [
            'category_name'  => 'required',
            'category_active' => 'required | numeric',
            'category_status' => 'required | numeric'
        ]);
       
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
       
        $category = Category::create($input);
       
        return $this->sendResponse(new CategoryResource($category), 'Category created successfully.');
    } 
     
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $category = Category::find($id);
      
        if (is_null($category)) {
            return $this->sendError('Category not found.');
        }
       
        return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully.');
    }
      
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category): JsonResponse
    {
        $input = $request->all();
       
        $validator = Validator::make($input, [
            'category_name'  => 'required',
            'category_active' => 'required | numeric',
            'category_status' => 'required | numeric'
        ]);
       
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
       
        $category->category_name = $input['category_name'];
        $category->category_active = $input['category_active'];
        $category->category_status = $input['category_status'];
        $category->save();
       
        return $this->sendResponse(new CategoryResource($category), 'Category updated successfully.');
    }
     
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
       
        return $this->sendResponse([], 'Category deleted successfully.');
    }
}
