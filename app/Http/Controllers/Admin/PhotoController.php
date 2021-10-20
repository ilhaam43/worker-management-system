<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Services\PhotoService;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $service;

    public function __construct(PhotoService $service)
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
        $photo = Photo::all();
        return view('admin.photo.index', compact('photo'))->with('i');
    }

    public function store(PhotoRequest $request)
    {
        try{    
            $store = $this->service->storePhoto($request);
        }catch(\Throwable $th){
            return redirect()->route('admin.photos.index')->with('error', 'Photo data failed to create');
        }
        return redirect()->route('admin.photos.index')->with('success', 'Photo data create successfully');
    }

    public function destroy($id)
    {
        $destroy = $this->service->destroyPhoto($id);
        return $destroy;
    }
}
