<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;

class createAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bariq:admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin Account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Admin::create([
            'name' => 'خالد',
            'username' => 'kaled',
            'email' => 'kaled@bariq.com',
            'password' => '12345678'
        ]);

        $this->info('Admin Created!');


    }
}
