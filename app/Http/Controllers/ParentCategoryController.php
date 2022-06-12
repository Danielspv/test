<?php

namespace App\Http\Controllers;

use App\Models\ParentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParentCategoryController extends Controller
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
            'parent_categories' => ParentCategory::all()
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
     * @param  \App\Http\Requests\StoreParentCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:50'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'code' =>  400,
                'message' => 'Incorrect data validation',
                'errors' =>  $validate->errors()
            ], 400);
        }

        $parentCategory = ParentCategory::create([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
            'parent_category' => $parentCategory
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ParentCategory $parentCategory)
    {
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
            'parent_category' => $parentCategory->load('categories')
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ParentCategory $parentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParentCategoryRequest  $request
     * @param  \App\Models\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParentCategory $parentCategory)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:50'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'code' =>  400,
                'message' => 'Incorrect data validation',
                'errors' =>  $validate->errors()
            ], 400);
        }

        $parentCategory->name = $request->name;
        $parentCategory->update();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request',
            'parent_category' => $parentCategory
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParentCategory  $parentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParentCategory $parentCategory)
    {
        $parentCategory->delete();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Successful request'
        ], 200);
    }
}
