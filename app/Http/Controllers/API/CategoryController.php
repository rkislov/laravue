<?php

namespace App\Http\Controllers\API;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function all()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

}
