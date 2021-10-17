<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productCategory = ProductCategory::all();

        return view('superadmin.product-category.index', compact('productCategory'))->with('i');
    }

    public function detail($id)
    {
        $productCategory = ProductCategory::find($id);
        
        if(!$productCategory){
            return redirect()->route('product-category');
        }

        return view('superadmin.product-category.edit', compact('productCategory'));
    }
}
