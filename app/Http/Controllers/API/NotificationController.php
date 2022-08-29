<?php

namespace App\Http\Controllers\API;


use App\Http\Resources\NotificationResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Notification;
use App\Notifications\SendNotification;
use App\Notifications\OffersNotification;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    function __construct()
    {
         $this->middleware('permission:notification-list|notification-create|notification-edit|notification-delete', ['only' => ['index','show']]);
         $this->middleware('permission:notification-create', ['only' => ['create','store']]);
         $this->middleware('permission:notification-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:notification-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        //
        return NotificationResource::collection(auth()->user()->notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $user = User::find($request->user);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
       
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return NotificationResource::collection(auth()->user()->notifications);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = auth()->user();
        $res = $user->notifications()->where('id', $id)->delete();
        return "Deleted";
    }
}
