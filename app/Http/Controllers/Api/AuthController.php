<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                "message" => "Ошибка валидации данных",
                "data" => [
                    "name" => $errors->get('name'),
                    "email" => $errors->get('email'),
                    "password" => $errors->get('password')
                ]
            ], 403);
        }

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        if (!$user) {
            return response()->json([
                "message" => "Ошибка сервера",
                "data" => null
            ], 500);
        }

        return response()->json([
            "message" => "Пользователь успешно создан",
            "data" => null
        ], 201);
    }

    public function login()
    {
        // Получаем пользователя
        $user = User::where('email', (request('email')))->first();

        // Проверяем существование пользователя и совпадение пароля
        if (!$user || !Hash::check(request('password'), $user->password)) {
            return response()->json([
                "data" => [
                    "email" => "Wrong email or password",
                    "password" => "Wrong email or password"
                ]
            ], 403);
        }

        // Внутренний API запрос для получения токенов
        $client = DB::table('oauth_clients')->where('password_client', true)->first();

        // Убедимся, что Password Client существует в БД (т.е. Laravel Passport установлен правильно)
        if (!$client) {
            return response()->json([
                "message" => "OAuth client error"
            ], 500);
        }

        // Формирум данные для создания токенов для текущего пользователя
        $data = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => request('email'),
            'password' => request('password'),
        ];

        // Запрос на создание токенов
        $request = Request::create('/oauth/token', 'POST', $data);
        $response = app()->handle($request);

        // Проверяем был ли внутренний запрос успешным
        if ($response->getStatusCode() != 200) {
            return response()->json([
                "status" => "fail",
                "data" => [
                    "email" => "Wrong email or password",
                    "password" => "Wrong email or password"
                ]
            ], 401);
        }

        // Вытаскиваем данные из ответа
        $data = json_decode($response->getContent());

        // Формируем окончательный ответ в нужном формате
        return response()->json([
            'status' => "success",
            'data' => [
                'token' => $data->access_token,
                'user' => $user
            ]
        ], 200);
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update(['revoked' => true]);

        $accessToken->revoke();

        return response()->json([], 201);
    }

    public function index() {
        return User::all();
    }

    public function updateAvatar($user_id) {
        $user = User::where('id', $user_id)->first();

        if ($user->avatar_url !== '/storage/avatars/default.png' && File::exists(public_path($user->avatar_url))) {
            File::delete(public_path($user->avatar_url));
        }
        $user->avatar_url = '/storage/' . request()->file('avatar')->store('avatars', 'public');
        $user->save();

        return response()->json(['success' => true, 'avatar_url' => $user->avatar_url], 200);
    }

    public function updateAccess($user_id, $access) {
        $user = User::where('id', $user_id)->first();
        $user->access = $access;
        $user->save();

        return response()->json(['success' => true, 'avatar_url' => $user->avatar_url], 200);
    }
}
