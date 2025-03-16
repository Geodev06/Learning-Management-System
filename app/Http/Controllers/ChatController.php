<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function inbox(Request $request)
    {
        $users = collect();

        $search = base64_encode($request->search);
        
        $query = User::where('users.id', '!=', Auth::user()->id);
        
        if (!empty($search)) {
            $query->where('users.first_name', 'like', '%' . $search . '%');
        }
        
        if (Auth::user()->role == 'STUDENT') {
            $query->whereIn('users.role', ['TEACHER', 'ADMIN']);
        }
        
        // Sort by unseen message count
        $users = $query->leftJoin('messages as m', function ($join) {
                $join->on('m.created_by', '=', 'users.id')
                     ->where('m.receiver_id', '=', Auth::user()->id)
                     ->where('m.seen_flag', '=', 0);
            })
            ->select('users.*', DB::raw('COUNT(m.id) as unseen'))
            ->groupBy('users.id')
            ->orderByDesc('unseen')
            ->orderByDesc('updated_at')

            ->paginate(6);
        
        return view('pages.inbox', compact('users'));
        
    }

    public function get_message(Request $request)
    {
        $receiver_id = $request->receiver_id;
        $where = [Auth::user()->id, $receiver_id];
        $messages = Message::whereIn('receiver_id', $where)
            ->whereIn('created_by', $where)->get();

        Message::whereIn('receiver_id', $where)
            ->where('receiver_id', Auth::user()->id)
            ->whereIn('created_by', $where)->update([
                'seen_flag' => 1
            ]);


        $view = view('partials.message', compact('messages'))->render();

        return response()->json($view, 200);
    }

    public function send_message(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'message' => 'required|string|max:500',  // Ensure message is not empty and is a string
        ]);

        try {
            DB::beginTransaction();
            Message::create([
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
                'created_by' => Auth::user()->id,

            ]);
            DB::commit();
            event(new MessageSent('get_message'));

            // Respond with a success message
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
            Log::error($th->getMessage());
        }
    }
}
