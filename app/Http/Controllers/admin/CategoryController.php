<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::lastest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:categories|string|max:255',
        'slug' => 'unique:categories',
        'image'=> 'nullable',
    ],[
        'name.required' => 'Vui lòng nhập tên danh mục.',
        'name.unique' => 'Tên danh mục đã tồn tại.',
        'slug.unique' => 'Slug danh mục đã tồn tại.',
        'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
    ]);

    if ($validator->passes()) {
       $category = new Category();
       $category->name = $request->name;
       $category->slug = $request->slug;
       $category->status = $request->status;
       $category->save();

       return redirect()->back()
        ->with('success','Thêm danh mục thành công');
    }else{
        return redirect()->back()
        ->withErrors($validator);
    };



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
