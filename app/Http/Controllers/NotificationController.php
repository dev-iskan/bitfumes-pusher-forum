<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index () {
        return [
            'unread' => NotificationResource::collection(auth()->user()->unreadNotifications) ,
            'read' => NotificationResource::collection(auth()->user()->readNotifications)
        ];
    }

    public function markAsRead (Request $request) {
        auth()->user()->notifications->where('id', $request->id)->markAsRead();
    }
}
