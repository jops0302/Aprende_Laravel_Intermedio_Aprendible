<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){
        return view('projects.index',[
            'category' => $category,
            'projects' => $category->projects()->with('category')->latest()->paginate()
        ]);
    }
}
