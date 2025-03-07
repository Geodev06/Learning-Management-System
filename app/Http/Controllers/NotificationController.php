<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications()
    {
        // Fetch the latest notifications and count unseen notifications in a single query
        $notifications = Notification::selectRaw('*, (SELECT COUNT(*) FROM notifications WHERE receiver_id = ? AND seen_flag = 0) AS unseen_count', [Auth::user()->id])
            ->where('receiver_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->orderBy('seen_flag', 'asc')
            ->limit(6)
            ->get();

        // Extract unseen count from the first result or set it to 0 if no results
        $unseen_count = $notifications->isNotEmpty() ? $notifications->first()->unseen_count : 0;

        // Prepare the view
        $view = view('partials.notifications', compact('notifications', 'unseen_count'))->render();

        return response()->json($view, 200);
    }
}
