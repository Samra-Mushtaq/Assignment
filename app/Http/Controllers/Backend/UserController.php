<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use DataTables;

use Carbon\Carbon;
use Mail;
use App\Mail\AdminMail;

class UserController extends Controller
{
   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return 
                Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                        return $btn;
                    })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $data = User::all();
        return $data;
    }

    public function show(User $user)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    public function destroy(User $user)
    {

    }
}
