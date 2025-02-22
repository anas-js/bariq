<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class init extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bariq:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bulid App';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Admin::truncate();
        Item::truncate();
        Service::truncate();
        Customer::truncate();
        Order::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        // create Landry
        $laundry = Laundry::create([
            'name' => 'مغسلة بريق',
            'time_open' => now(),
            'time_close'  => now(),
            'whatsapp_token'  => '1111dfsdf',
        ]);

        // create Admin
        $laundry->admin()->create([
            'name' => 'خالد',
            'username' => 'kaled',
            'email' => 'kaled@bariq.com',
            'password' => '12345678'
        ]);



        // create Items
        Item::create(
            [
                'name' => 'شماغ',
                'status' => 1
            ]
        );

        Item::create(
            [
                'name' => 'ثوب',
                'status' => 1
            ]
        );

        // create Service
        Service::create(

            [

                'name' => 'غسيل',
                'status' => 1
            ]

        );

        Service::create(

            [

                'name' => 'كوي',
                'status' => 1
            ]

        );




        $customer = Customer::create([
            'name' => 'anas',
            'phone' => '555555555',
        ]);

        $order =  $customer->orders()->create([
            'status' => 1,
            'amount' => 20,
            'done_at' => now(),
            'received_at' =>  now(),
        ]);



        $order->services()->create([
            'amount' => 20,
            'quantity' => 2,
            'service_id' => 1,
            'item_id' => 1
        ]);




        $this->info('Bulid Done!');
    }
}
