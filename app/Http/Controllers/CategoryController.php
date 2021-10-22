<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::where('category_is_deleted','=','N')->get();
        return response()->json([
            'code' => 200,
            'message' => '',
            'status' => 0,
            'data' => $data
        ], 200);
    }
}
