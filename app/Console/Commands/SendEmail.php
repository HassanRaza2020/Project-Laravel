<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


use App\Mail\MyEmail;


class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email send commmand';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Mail::to("hassan.raza@clarisync.com")->send(new MyEmail("Hassan Raza", 111000));
        $this->info("Mail sent successfully!!"); 

    }
}
