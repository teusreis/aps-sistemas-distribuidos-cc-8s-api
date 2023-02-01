<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function dropdown()
    {
        return response()->json([
            'status' => 'ok',
            'data' => Category::all(['id', 'name'])
        ]);
    }

    public function index()
    {
        $categories = Category::withDonationCount()->get();

        return response()->json([
            'status' => 'ok',
            'data' => $categories
        ]);
    }
}
