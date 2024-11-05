<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $search = request()->query('search');
        return Product::with('images')->whereRaw("LOWER('name_pl') LIKE '%$search%'")->orWhereRaw("LOWER('name_en') LIKE '%$search%'")->get();
    }
}
