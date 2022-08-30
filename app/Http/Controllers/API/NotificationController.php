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

    public function index()
    {
        return NotificationResource::collection(auth()->user()->notifications);
    }

    public function store(Request $request)
    {
       
    }

    public function show(Request $request, $id)
    {
        return NotificationResource::collection(auth()->user()->notifications);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
