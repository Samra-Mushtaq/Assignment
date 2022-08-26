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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = auth()->user();
        return view('backend.notifications.index',compact( 'user'));
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
  
        return 1;
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
        $user = auth()->user();
        $notifications = $user->notifications()->where('id', $id)->first();
        return $notifications;
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
        return $res;
    }
}
