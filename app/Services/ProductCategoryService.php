<?php
namespace App\Services;

use App\Models\ProductCategory;

class ProductCategoryService
{
    public function storeProductCategory($request)
    {
        $store = ProductCategory::create($request->all());

        return $store;
    }

    public function updateProductCategory($request, $id)
    {
        $update = ProductCategory::find($id)->update($request->all());

        return $update;
    }

    public function destroyProductCategory($id)
    {
        $destroy = ProductCategory::where('id',$id)->delete();

        return $destroy;
    }
}