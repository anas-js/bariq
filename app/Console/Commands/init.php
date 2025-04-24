<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Order_Item_Services;
use App\Models\Order_Items;
use App\Models\Service;
use App\Models\Services_Detail;
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
        Services_Detail::truncate();
        Order::truncate();
        Order_Items::truncate();
        Order_Item_Services::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        // create Landry
        $laundry = Laundry::create([
            'name' => 'مغسلة بريق',
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

        Item::create(
            [
                'name' => 'ثوب شتوي',
                'status' => 1
            ]
        );

        Item::create(
            [
                'name' => 'شماغ شتوي',
                'status' => 1
            ]
        );

        Item::create(
            [
                'name' => 'بطانية',
                'status' => 1
            ]
        );

        Item::create(
            [
                'name' => 'بدلة',
                'status' => 1
            ]
        );

        Item::create(
            [
                'name' => 'ثوب نسائي',
                'status' => 1
            ]
        );


        // create Service
        Service::create(

            [

                'name' => 'غسيل عادي',
                'status' => 1
            ]

        );

        Service::create(

            [

                'name' => 'غسيل جاف',
                'status' => 1
            ]

        );

        Service::create(

            [

                'name' => 'كوي عادي',
                'status' => 1
            ]

        );

        Service::create(

            [

                'name' => 'كوي بخار',
                'status' => 1
            ]

        );


        Service::create(

            [

                'name' => 'غسيل (إزالة الحبر)',
                'status' => 1
            ]

        );


        // create Service Details
        for ($i = 1; $i <= 7; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                Services_Detail::create([
                    'amount' => rand(2, 10),
                    'item_id' => $i,
                    'service_id' => $j
                ]);
            }
        }


        // Create Customer
        Customer::create([
            'name' => 'أنس',
            'phone' => '555555555',
        ]);

        Customer::create([
            'name' => 'ضاري',
            'phone' => '555555555',
        ]);

        Customer::create([
            'name' => 'يوسف',
            'phone' => '555555555',
        ]);

        Customer::create([
            'name' => 'ميسرة',
            'phone' => '555555555',
        ]);

        Customer::create([
            'name' => 'منتظر',
            'phone' => '555555555',
        ]);

        Customer::create([
            'name' => 'وليد',
            'phone' => '555555555',
        ]);


        // Create Order



        for ($i = 0; $i < 300; $i++) {
            $customer = Customer::inRandomOrder()->first();
            $item = Item::inRandomOrder()->first();
            $date = now()->subDay(rand(0,365));

            $order =  $customer->orders()->getModel()->forceCreate([
                'status' => rand(1,5),
                'amount' => 1,
                'done_at' => $date->copy()->addMinute(rand(1,1500)),
                'received_at' => $date->copy()->addMinute(rand(1,1500)),
                'created_at'=> $date,
                'customer_id' => $customer->id
            ]);


            $order_item = $order->orderItems()->create([
                'amount' => 0,
                'quantity' => 1,
                'item_id' => $item->id,
            ]);

            // Select Servers
            $servers = Service::inRandomOrder()->first();
            $serversDetal = $servers->details($item->id);

            // Added Servers
            $order_item->itemServers()->create([
                'service_id' => $servers->id
            ]);

            $order_item->amount += $serversDetal->amount;

            $order_item->save();

            $order->amount += $order_item->amount;

            $order->save();
        }


        for ($i = 0; $i < 300; $i++) {
            $customer = Customer::inRandomOrder()->first();
            $date = now()->subDay(rand(0,365));

            $order =  $customer->orders()->getModel()->forceCreate([
                'status' =>  rand(1,5),
                'amount' => 1,
                'done_at' => $date->copy()->addMinute(rand(1,1500)),
                'received_at' => $date->copy()->addMinute(rand(1,1500)),
                'created_at'=> $date,
                'customer_id' => $customer->id
            ]);

            for ($j = 4; $j < 4; $j++) {
                $item = Item::inRandomOrder()->first();

                $order_item = $order->orderItems()->create([
                    'amount' => 0,
                    'quantity' => 1,
                    'item_id' => $item->id,
                ]);


                for ($o = 0; $o < 3; $o++) {
                    // Select Servers
                    $servers = Service::inRandomOrder()->first();
                    $serversDetal = $servers->details($item->id);

                    // Added Servers
                    $order_item->itemServers()->create([
                        'service_id' => $servers->id
                    ]);

                    $order_item->amount += $serversDetal->amount;
                }


                $order_item->save();
            }

            $order->amount += $order_item->amount;

            $order->save();
        }



        for ($i = 0; $i < 300; $i++) {

            $customer = Customer::inRandomOrder()->first();
            $item = Item::inRandomOrder()->first();
            $date = now()->subDay(rand(0,365));

            $order =  $customer->orders()->getModel()->forceCreate([
                'status' => rand(1,5),
                'amount' => 1,
                'done_at' => $date->copy()->addMinute(rand(1,1500)),
                'received_at' => $date->copy()->addMinute(rand(1,1500)),
                'created_at'=> $date,
                'customer_id' => $customer->id
            ]);


            $order_item = $order->orderItems()->create([
                'amount' => 0,
                'quantity' => 1,
                'item_id' => $item->id,
            ]);

            for ($j = 0; $j < 3; $j++) {
                // Select Servers
                $servers = Service::inRandomOrder()->first();
                $serversDetal = $servers->details($item->id);

                // Added Servers
                $order_item->itemServers()->create([
                    'service_id' => $servers->id
                ]);

                $order_item->amount += $serversDetal->amount;
            }





            $order_item->save();

            $order->amount += $order_item->amount;

            $order->save();
        }






        $this->info('Bulid Done!');
    }
}
