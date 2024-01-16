<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Http\Requests\StoreObjectRequest;
use App\Http\Requests\UpdateObjectRequest;
use App\Models\Place;

class ObjectsController extends BaseController
{
    public function index(Request $request)
    {
        return Place::where('moderated', true)->get();
    }

    public function indexMyAll()
    {
        return Place::where('owner_user_id', auth()->id())->get();
    }

    public function indexAll(Request $request)
    {
        return Place::all();
    }

    public function same(Request $request)
    {
        $category = $request->input('category');
        return Place::where('category_id', '=', $category)->get();
    }

    public function info($obj)
    {
        $object = Place::where('id', $obj)->first();
        return [
            'object' => $object,
            'owner' => User::where('id', $object['owner_user_id'])->first()
        ];
    }

    public function store(StoreObjectRequest $request)
    {
        $data = $request->validated();
        $data["owner_user_id"] = auth()->id();

        // Сохраняем все картинки
        if (request()->file('gallery')) {
            foreach (request()->file('gallery') as $key => $file) {
                $data["gallery"][$key] = '/storage/' . $file->store('gallery', 'public');
            }
            $data["gallery"] = json_encode($data["gallery"]);
        }

        // Сохраняем панораму
        if (request()->file('panorama')) {
            $data["panorama_url"] = '/storage/' . request()->file('panorama')->store('panorama', 'public');
        }


        Place::create($data);
        return response()->json(['success' => true], 201);
    }

    public function update(Request $request)
    {
        $place = Place::findOrFail($request->post("id"));
        $place->category_id = $request->post("category_id");
        $place->title = $request->post("title");
        $place->description = $request->post("description");
        $place->coordinates = $request->post("coordinates");
        $place->address = $request->post("address");
        $place->address_comment = $request->post("address_comment");
        $place->inventory = $request->post("inventory");
        $place->benefits = $request->post("benefits");
        $place->hour_price = $request->post("hour_price");
        $place->minimal_autodeal_rating = $request->post("minimal_autodeal_rating");
        $place->show_price_for_authorised_only = $request->post("show_price_for_authorised_only");
        $place->schedule = $request->post("schedule");

        $gallery_res = json_decode($request->post("gallery"));
        // Сохраняем все картинки
        if (request()->file('new_gallery')) {
            foreach (request()->file('new_gallery') as $key => $file) {
                $gallery_res[] = '/storage/' . $file->store('gallery', 'public');
            }
        }
        $place->gallery = $gallery_res;

        // Сохраняем панораму
        if (request()->file('panorama_url')) {
            $place->panorama_url = '/storage/' . request()->file('panorama_url')->store('panorama', 'public');
        }
        else if (request()->post('panorama_url') === 'undefined' || request()->post('panorama_url') === 'null') {
            $place->panorama_url = null;
        }

        $place->save();
        return response()->json(['success' => true], 201);
    }

    public function destroy($id)
    {
        Place::where('id', $id)->first()->delete();
        return response()->json(['success' => true], 200);
    }

    public function confirmObject($user, $id)
    {
        $object = Place::where('id', $id)->first();
        $object->moderated = true;
        $object->save();

        response()->json(['success' => true], 200);
    }

    public function user_objects(User $user)
    {
        return $user->objects;
    }
}
