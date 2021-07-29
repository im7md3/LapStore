<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
  
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }


    public function show($slug)
    {
        $cat=Category::where('slug',$slug)->get();
        
        $products=Product::where('category_id',$cat[0]->id)->orderBy('id','DESC')->paginate(12);
        return Inertia::render('Category/show',compact(['cat','products']));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
