<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('category.index',compact('categories'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'category_name'=>'required',
            'category_image'=>'required',
        ]);
        
        $category = new Category();
        $category->category_name = $request->category_name;
        if($request->has('category_image')){
                $file_name = time().'.'.$request->category_image->getClientOriginalExtension();
                $request->category_image->move('image',$file_name);
                $category->category_image = $file_name;
        }
        $category->category_image = $request->category_image;
        $category->save();
        return response()->json([
            'message' => 'Category Added successfully'
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json(['data'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return response()->json(['data'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name'=>'required',
            'category_image'=>'required',
        ]);
        
        $category->category_name = $request->category_name;
        if($request->has('category_image')){
                $file_name = time().'.'.$request->category_image->getClientOriginalExtension();
                $request->category_image->move('image',$file_name);
                $category->category_image = $file_name;
        }
        $category->category_image = $request->category_image;
        $category->save();
        return response()->json([
            'message' => 'Category Added successfully'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
