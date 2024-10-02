<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('CentreRecyclage.categorie', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $centers = $category->recyclingCenters; 
        return view('CentreRecyclage.show', compact('centers'));
    }
    

}
