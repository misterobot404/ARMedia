<?php

namespace App\Http\Controllers\Api;

use App\Models\Album;
use App\Models\AlbumObject;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AlbumObjectsController extends BaseController
{
    public function get($album_id)
    {
        return response()->json([
            'album' => Album::where('id', $album_id)->first(),
            'objects' => AlbumObject::where('album_id', $album_id)->get()
        ]);
    }

    public function create()
    {
        $object = new AlbumObject();

        $object->name = request('name');
        $object->album_id = request('album_id');


        $object_file_name = '/assets/object_assets/' . uniqid() . request('object')->getClientOriginalName();
        file_put_contents(public_path() . $object_file_name, File::get(request('object')));
        $object->object = $object_file_name;

        $marker_file_name = '/assets/object_assets/' . uniqid() . request('marker')->getClientOriginalName();
        file_put_contents(public_path() . $marker_file_name, File::get(request('marker')));
        $object->marker = $marker_file_name;

        $object->save();

        return response()->json([
            'objects' => AlbumObject::where('album_id', request('album_id'))->get()
        ]);
    }

    public function destroy($album_id, $object_id)
    {
        $object = AlbumObject::where('id', $object_id)->first();
        unlink(public_path() . $object->object);
        unlink(public_path() . $object->marker);
        $object->delete();

        return response()->json([
            'objects' => AlbumObject::where('album_id', $album_id)->get()
        ]);
    }
}
