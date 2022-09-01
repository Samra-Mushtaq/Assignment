<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use Carbon\Carbon;
use Mail;
use App\Mail\AdminEmail;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        
        $admin_user = User::whereHas(
            'roles', function($q){
                $q->where('name', 'admin');
            }
        )->first();
        
        if($admin_user != null){

            $email = $admin_user->email; 
            $current = Carbon::now();
            $before = Carbon::now()->subHours(12);
            $before_date_time = $before->toDateTimeString();
            $current_date_time = $current->toDateTimeString();
            // dd($before_date_time . " - " . $current_date_time);
            $users = User::whereBetween('created_at', [$before_date_time,$current_date_time])->get();
            $data = [
                "users" => $users,
                "email" => $email,
                "title" => "New Registered Users Detail"
            ];
            Mail::to($email)->send(new AdminEmail($data));
        }
      
    }
}
