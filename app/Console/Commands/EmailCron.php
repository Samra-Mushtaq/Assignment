<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use Carbon\Carbon;
use Mail;
use App\Mail\AdminMail;

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
        $email = 'admin@admin.com';
        $current = Carbon::now();
        $before = Carbon::now()->subHours(12);
        $before_date_time = $before->toDateTimeString();
        $current_date_time = $current->toDateTimeString();
        // dd($before_date_time . " - " . $current_date_time);

        $users = User::where('created_at', '>=', $before_date_time)->where('created_at', '<=', $current_date_time)->get();

        $data["users"] = $users;
        $data["email"] = $email;
        $data["title"] = "Daily Update";
        $data["body"] = "";

        Mail::send('backend.mails.admin_mail', $data, function($message)use($data) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
        });
    }
}
