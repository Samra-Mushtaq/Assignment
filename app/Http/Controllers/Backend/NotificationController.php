<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use App\Notifications\SendNotification;
use App\Notifications\OffersNotification;

class NotificationController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:notification-list|notification-create|notification-edit|notification-delete', ['only' => ['index','show']]);
        $this->middleware('permission:notification-create', ['only' => ['create','store']]);
        $this->middleware('permission:notification-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:notification-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = auth()->user();
        return view('backend.notifications.index',compact( 'user'));
    }

    public function create()
    {
        $user = auth()->user();
        return $user;
        
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $data = [
            'user' => $user->id,
            'title_en' => $request->title_en ,
            'title_ar' => $request->title_ar ,
            'description_en' => $request->description_en,
            'description_ar' =>  $request->description_ar,
        ];
        Notification::send($user, new SendNotification($data));
  
        return "Added";
    }

    public function show(Request $request, $id)
    {
        $user = auth()->user();
        $notifications = $user->notifications()->where('id', $id)->first();
        $data = [
            'title_en' => $request->title_en ,
            'title_ar' => $request->title_ar ,
            'description_en' => $request->description_en,
            'description_ar' =>  $request->description_ar,
        ];
        $notifications->data =  $data;
        $res = $notifications->save();
        return "Updated";
       
    }

    public function edit($id)
    {
        $user = auth()->user();
        $notifications = $user->notifications()->where('id', $id)->first();
        return $notifications;
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $notifications = $user->notifications()->where('id', $id)->first();
        $data = [
            'title_en' => $request->title_en ,
            'title_ar' => $request->title_ar ,
            'description_en' => $request->description_en,
            'description_ar' =>  $request->description_ar,
        ];
        $notifications->data =  $data;
        $res = $notifications->save();
        return "Updated";
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $res = $user->notifications()->where('id', $id)->delete();
        return "Deleted";
    }
}
