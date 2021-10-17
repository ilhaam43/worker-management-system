<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\SuperAdmin\ProductCategoryService;
use App\Http\Requests\SuperAdmin\ProductCategoryRequest;
use App\Models\User;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(ProductCategoryService $service)
    {   
        $this->service = $service;
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

    public function store(ProductCategoryRequest $request)
    {
        try{    
            $store = $this->service->store($request);
        }catch(\Throwable $th){
            return back()->withError('Product categories failed to add because product categories cannot be duplicated');
        }
        return redirect()->route('superadmin.product-category.index')->with('success', 'Product category added successfully');
    }

    public function edit($id)
    {
        $productCategory = ProductCategory::find($id);
        
        if(!$productCategory){
            return redirect()->route('superadmin.product-category.index');
        }

        return view('superadmin.product-category.edit', compact('productCategory'));
    }

    public function update(ProductCategoryRequest $request, $id)
    {
        try{    
            $update = $this->service->update($request, $id);
        }catch(\Throwable $th){
            return back()->withError('Product categories failed to update because product categories cannot be duplicated');
        }
        return redirect()->route('superadmin.product-category.index')->with('success', 'Product category updated successfully');
    }

    public function destroy($id)
    {
        try{    
            $destroy = $this->service->destroy($id);
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Product category data failed to delete",]);
        }
        return response()->json(['success' => true, 'message' => "Product category data deleted successfully",]);
    }
}