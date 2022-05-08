<?php

use Illuminate\Support\Facades\Broadcast;

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

// Send notifications to registered users.
Broadcast::channel('notifications', function ($user) {
    return $user != null;
});

// Recieve user that has been connected.
Broadcast::channel('chat', function ($user) {
    if ($user != null) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});
