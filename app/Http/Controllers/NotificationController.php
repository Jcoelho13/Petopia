<?php

namespace App\Http\Controllers;

use App\Models\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications() {

        if (Auth::check() && !Auth::user()->isAdmin()) {

            $userId = Auth::id();

            $unreadNotifications = Notification::with('notify')
                ->where('user_id', $userId)
                ->where('is_read', false)
                ->orderBy('date', 'desc')
                ->get();
            $readNotifications = Notification::with('notify')
                ->where('user_id', $userId)
                ->where('is_read', true)
                ->orderBy('date','desc')
                ->paginate(10);


            return view('notifications_page')
                ->with('unreadNotifications', $unreadNotifications)
                ->with('readNotifications', $readNotifications);
        } else {
            return redirect('/login');
        }
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->is_read = true;
            $notification->save();
        }

        return response()->json(['success' => true]);
    }
}

