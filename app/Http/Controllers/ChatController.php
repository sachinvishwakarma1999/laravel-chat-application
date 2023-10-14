<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
  public function index()
  {
    return view('chat.index');
  }

  public function getUsers(Request $request)
  {
    $getUsers = User::get()->where('id','!=', Auth::user()->id);
    $html = View::make('chat._user-list', ['users' => $getUsers])->render();
    return response()->json(['success' => true, 'html' => $html]);
  }

  public function getChattingMessageList($userId)
  {
    $userDetails = User::find(['id' => $userId]);

    $getChatHistory = self::getChatHistory($userId);
    if (!empty($userDetails)) {
      $html = View::make('chat._message-list', [
        'userDetails' => $userDetails,
        'getChatHistory' => $getChatHistory
      ])->render();
      return response()->json(['success' => true, 'html' => $html]);
    }
    return response()->json(['success' => false, 'message' => 'user not found']);
  }


  public function getChatHistory($toId)
  {

    $loggedInUserId = auth()->user()->id;
    $conversationUserId = $toId;
    return UserConversation::where(function ($query) use ($loggedInUserId, $conversationUserId) {
      $query->where('from_id', $loggedInUserId)->where('to_id', $conversationUserId);
    })->orWhere(function ($query) use ($loggedInUserId, $conversationUserId) {
      $query->where('from_id', $conversationUserId)->where('to_id', $loggedInUserId);
    })->orderBy('created_at', 'asc')->get();
  }


  public function sendMessage(Request $request)
    {
        try {
            $post = $request->all();
            UserConversation::create($post);
            return response()->json(['success' => true, 'message' => 'message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


}




