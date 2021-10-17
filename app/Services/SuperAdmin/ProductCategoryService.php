<?php
namespace App\Services\SuperAdmin;

use App\Models\ProductCategory;

class ProductCategoryService
{
    public function store($request)
    {
        $store = ProductCategory::create($request->all());

        return $store;
    }

    public function update($request, $id)
    {
        $update = ProductCategory::find($id)->update($request->all());

        return $update;
    }

    public function destroy($id)
    {
        $destroy = ProductCategory::where('id',$id)->delete();

        return $destroy;
    }
}