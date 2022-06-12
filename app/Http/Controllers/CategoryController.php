<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
            'categories' => Category::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|alpha_num|min:2|max:10',
            'title' => 'required|string|min:2|max:10',
            'description' => 'required|string|min:10|max:500',
            'parent_category_id' => 'required|integer|exists:parent_categories,id'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'code' =>  400,
                'message' => 'Incorrect data validation',
                'errors' =>  $validate->errors()
            ], 400);
        }

        $category = new Category();
        $category->code = $request->code;
        $category->title = $request->title;
        $category->description = $request->description;
        $category->parent_category_id = $request->parent_category_id;
        $category->save();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
            'category' => $category
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
            'category' => $category
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validate = Validator::make($request->all(), [
            'code' => 'required|alpha_num|min:2|max:10',
            'title' => 'required|string|min:2|max:10',
            'description' => 'required|string|min:10|max:500',
            'parent_category_id' => 'required|integer|exists:parent_categories,id'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'code' =>  400,
                'message' => 'Incorrect data validation',
                'errors' =>  $validate->errors()
            ], 400);
        }

        $category->code = $request->code;
        $category->title = $request->title;
        $category->description = $request->description;
        $category->parent_category_id = $request->parent_category_id;
        $category->update();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
            'category' => $category
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
        ], 200);
    }
}
