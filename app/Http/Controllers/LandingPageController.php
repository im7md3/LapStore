<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    public function index()
    {
        $products=Product::inRandomOrder()->take(8)->get();
        return Inertia::render('Welcome',compact('products'));
    }
}
