<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Service;
use App\Models\Services_Detail;
use App\Models\Services_Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Order::truncate();
        Services_Order::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        for($i=0;$i<100;$i++) {
            $customer = Customer::inRandomOrder()->first();

            $date = now()->addMinute(rand(1,30));
            $order =  $customer->orders()->create([
                'status' => 1,
                'amount' => 0,
                'done_at' => $date,
                'received_at' =>  $date->addMinute(rand(1,30)),
            ]);


            for($i=0;$i<10;$i++) {
            $servers = Service::inRandomOrder()->first();
            $item = Item::inRandomOrder()->first();
            $servers_detal =  Services_Detail::where('service_id',$servers->id)->where('item_id',$item->id)->first();

            // dump('s:'.$servers->id,'t:'.$item->id);
            // dump($servers_detal->id);

            $order->services()->create([
                'amount' => $servers_detal->amount,
                'quantity' => 1,
                'service_id' => $servers->id,
                'item_id' => $item->id
            ]);



            // dd(Services_Detail::where('service_id',$servers->id)->where('item_id',$item->id)->first());

            $order->amount+= $servers_detal->amount;

            $order->save();
        }
        }





    }
}
