<?php

use Illuminate\Support\Facades\Broadcast;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user-point-data', function ($user, $id) {
    \Log::info("HERE");
    \Log::info($user->id);
    \Log::info($id);
    return true;
});

WebSocketsRouter::webSocket('/ws');

Broadcast::channel('private-channel.{userId}', function ($user, $userId) {
    return $user->id === $userId;
});