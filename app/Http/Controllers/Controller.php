<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Place;
use App\Models\Category;
use App\Models\Review;
use App\Models\Deal;
use App\Models\Message;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index() {
        dd('123');
    }

    public function objects() {
        dd(Place::all());
    }

    public function categories() {
        dd(Category::all());
    }

    public function deals() {
        dd(Review::all());
    }

    public function reviews() {
        dd(Deal::all());
    }

    public function messages() {
        dd(Message::all());
    }
}
