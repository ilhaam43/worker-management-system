<?php
namespace App\Services;

use App\Models\Photo;

class PhotoService
{
    public function storePhoto($request)
    {
        $name = $request->file('photo_image')->getClientOriginalName();
        $uploadPhoto = $request->photo_image->move(public_path('admins/img/photos'), $name);
        $request['photo_url'] = 'admins/img/photos/' . $name;
        $store = Photo::create($request->except('photo_image'));

        return $store;
    }

    public function destroyPhoto($id)
    {
        try{
            $photo = Photo::find($id);
            $deletePhotoFile = unlink($photo->photo_url);
            $deletePhotoData = Photo::where('id',$id)->delete();
        }catch(\Throwable $th){
            return response()->json(['success' => false, 'message' => "Photo data failed to delete",]);
        }
        
        return response()->json(['success' => true, 'message' => "Photo data deleted successfully",]);
    }
}