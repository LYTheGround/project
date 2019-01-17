<?php

namespace App\Http\Controllers;



class NotificationController extends Controller
{

    public function read()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return 'true';
    }

    public function index()
    {
        return view('notification.notification');
    }

    public function destroy()
    {
        auth()->user()->notifications()->delete();
        return back();
    }
}
