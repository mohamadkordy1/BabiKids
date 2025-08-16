<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Child;
use App\Models\Progress;
use App\Models\Activity;
use App\Models\Report;
use App\Models\Attendance;
use App\Models\Payment;
use App\Models\Staff;
class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        // Example of using the User model
 $children = staff::all();
 dd($children);
        // Example of using the Children model
    }
}
