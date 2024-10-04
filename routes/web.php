<?php

use App\Models\User;
use App\Notifications\MessageTestNotification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('send-notification', function () {
    $message['status'] = request()->query('status', 'success');
    $message['body'] = 'Mensagem body padrão';

    $u = User::first();
    $u->notify(new MessageTestNotification($message));

    return 'Notificação enviada';
});

Route::get('login/{id}', function (int $id) {
    // Verifica se o método está disponível e faz login
    if (method_exists(Auth::guard(), 'loginUsingId')) {
        Auth::loginUsingId($id);
        return 'User logged in!';
    } else {
        return 'The loginUsingId method is not available for the current guard.';
    }
});
