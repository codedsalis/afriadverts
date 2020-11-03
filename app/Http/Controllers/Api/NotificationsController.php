<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Notification;
use App\Http\Resources\NotificationResource;


class NotificationsController extends Controller
{
    /**
     * Get all notifications
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return \response()->json([
                $validator->errors()
            ], 403);
        }

        $notifications = Notification::where('user_id', '=', $user->id)->paginate(10);

        return new NotificationResource($notifications);
    }
    

    public function markread(Request $request) {
        $user = User::findOrFail($request->user_id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return \response()->json([
                $validator->errors()
            ], 403);
        }


        Notification::where('user_id', $user->id)
                    ->where('read', 0)
                    ->update([
                        'read' => 1,
                    ]);
    }


    public function destroy($id) {
        $notification = Notification::findOrFail($id);

            if($notification->delete()) {
                return new NotificationResource($notification);
            }
    }
}
