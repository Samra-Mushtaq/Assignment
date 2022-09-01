<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Notification;
use App\Notifications\SendNotification;
use App\Notifications\OffersNotification;
use App\Http\Requests\NotificationRequest;

use DataTables;
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
        return view('backend.notifications.index');
    }

    public function dataTable () {
        $notifications = auth()->user()->notifications;
        return Datatables::of($notifications)
            ->addIndexColumn()
            ->addColumn('actions', function ($record) {
                $actions = '';
                if(auth()->user()->hasPermissionTo('notification-edit')) {
                    $actions .= '<button class="btn btn-primary  mr-1 p-1" data-act="ajax-modal" data-method="get"
                            data-action-url="'. route('notifications.edit', $record->id). '" data-title="Edit Notification"
                            data-toggle="tooltip" data-placement="top" title="Edit Notification">
                                Edit
                            </button>';
                }
                if(auth()->user()->hasPermissionTo('notification-delete')) {
                    $actions .= '<a class="btn btn-danger delete p-1" data-table="notifications-table" data-method="get"
                            data-url="' .route('notifications.destroy', $record->id). '" data-toggle="tooltip" data-placement="top" title="Delete Notification">
                                Delete
                            </a>';
                }
                return $actions;
            })
            ->addColumn('title_en', function ($record) {
                $data = $record->data['title_en'];
                return $data;
            })
            ->addColumn('title_ar', function ($record) {
                $data = $record->data['title_ar'];
                return $data;
            })
            ->addColumn('description_en', function ($record) {
                $data = $record->data['description_en'];
                return $data;
            })
            ->addColumn('description_ar', function ($record) {
                $data = $record->data['description_ar'];
                return $data;
            })
            ->rawColumns(['actions', 'title_en', 'title_ar', 'description_en', 'description_ar'])->make(true);
    }

    public function create()
    {
        return view('backend.notifications.model');
        
    }

    public function store(NotificationRequest $request)
    {
        try{
            $user = auth()->user();
            $data = [
                'user' => $user->id,
                'title_en' => $request->title_en ,
                'title_ar' => $request->title_ar ,
                'description_en' => $request->description_en,
                'description_ar' =>  $request->description_ar,
            ];
            Notification::send($user, new SendNotification($data));
    
            return response()->json([
                'message' => 'Notification Successfully Added'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong'
            ]); 
        }
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
        $notification = $user->notifications()->where('id', $id)->first();
        return view('backend.notifications.model',compact('notification'));
    }

    public function update(NotificationRequest $request, $id)
    {
        try{
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
            return response()->json([
                'message' => 'Notification Successfully Updated'
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong'
            ]); 
        }
    }

    public function destroy($id)
    {
        try{
            $user = auth()->user();
            $res = $user->notifications()->where('id', $id)->delete();
            return response()->json([
                'message' => 'Notification Successfully Deleted',
                'status' => 'success',
            ]); 
        }catch(\Exception $exception) {
            return response()->json([
                'message' => 'Something Went wrong',
                'status' => 'error',
            ]); 
        }
    }
}
