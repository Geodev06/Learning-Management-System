<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications()
    {
        // Fetch the latest notifications and count unseen notifications in a single query
        $notifications = Notification::selectRaw('*, (SELECT COUNT(*) FROM notifications WHERE receiver_id = ? AND seen_flag = 0) AS unseen_count', [Auth::user()->id])
            ->where('receiver_id', Auth::user()->id)
            ->where('seen_flag', 0)
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

    public function seen(Request $request)
    {
        Notification::find($request->id)->update([
            'seen_flag' => 1
        ]);
    }

    public function notifications_view(Request $request)
    {
        $notifications = Notification::selectRaw('*, (SELECT COUNT(*) FROM notifications WHERE receiver_id = ? AND seen_flag = 0) AS unseen_count', [Auth::user()->id])
            ->where('receiver_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->orderBy('seen_flag', 'asc')
            ->paginate(10);

        return view('pages.notifications_view', compact('notifications'));
    }

    public function delete(Request $request)
    {
        Notification::find($request->id)->delete();
        return response()->json('Notification Item has been Deleted.', 200);
    }
}
