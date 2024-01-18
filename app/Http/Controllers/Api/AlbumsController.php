<?php

namespace App\Http\Controllers\Api;

use App\Models\Album;
use App\Models\AlbumObject;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;

class AlbumsController extends BaseController
{
    public function get(Request $request)
    {
        $albums = Album::where('user_id', auth()->id())->get();
        foreach ($albums as &$album) {
            $album["object_count"] = count(AlbumObject::where('album_id', $album["id"])->get());
        }

        return response()->json([
            'albums' => $albums
        ]);
    }

    public function create()
    {
        $album = new Album;
        $album->title = request('title');
        $album->description = request('description');
        $album->user_id = auth()->id();
        $album->save();

        $albums = Album::where('user_id', auth()->id())->get();
        foreach ($albums as &$album) {
            $album["object_count"] = count(AlbumObject::where('album_id', $album["id"])->get());
        }

        return response()->json([
            'albums' => $albums
        ]);
    }

    public function destroy($album_id)
    {
        Album::where('user_id', auth()->id())->where('id', $album_id)->first()->delete();

        $albums = Album::where('user_id', auth()->id())->get();
        foreach ($albums as &$album) {
            $album["object_count"] = count(AlbumObject::where('album_id', $album["id"])->get());
        }

        return response()->json([
            'albums' => $albums
        ]);
    }
}
