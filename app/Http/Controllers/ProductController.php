<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function all_product(){
        $products = Product::with('category')->get();
        return $products;
    }
}
