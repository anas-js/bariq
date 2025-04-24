<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function get(Request $request, $id)
    {
        $order = collect(Order::with(['customer', 'orderItems' => function ($q) {
            $q->with(['itemServers' => function ($q) {
                $q->with('service');
            }, 'item', 'serviceAvailable']);
        }])->find($id));
        // dd($order['order_items']);
        $order['order_items'] = collect($order['order_items'])->map(function ($item) {

            $item['service_available'] = collect($item['service_available'])->map(function ($servece) {
                $servece['id'] = $servece['service']['id'];

                $servece['merge_with'] = collect($servece['service']['services_merges'])->map(function ($s) {
                    return $s['merge_with_service_id'];
                })->merge(collect($servece['service']['merge_with'])->map(function ($s) {
                    return $s['service_id'];
                }))->unique();

                // dd($servece);
                // $servece['merge_with'];
                unset($servece['service']);

                return $servece;
            });

            $item['item_servers'] = collect($item['item_servers'])->map(function ($servece) {
                return $servece['service'];
            });
            //  dd($item);
            return $item;
        });



        // $order['order_items'] = 5;

        // $order->service_available =  1;
        return  $order;
    }

    public function create(Request $request)
    {
        $customer = Customer::find($request->customer);
        $items  = collect($request->items);

        $order = $customer->orders()->create([
            'status' => 1,
            'amount' => 0,
             'received_at' => now()
        ]);

        $items->each(function ($item) use ($order) {
            $order_item = $order->orderItems()->create([
                'amount' => 0,
                'quantity' => $item['quantity'],
                'item_id' => $item['item'],
            ]);

            $servece = collect($item['servers']);

            $servece->each(function ($servec) use ($order_item, $item) {
                $servers = Service::find($servec);
                $serversDetal = $servers->details($item['item']);

                $order_item->itemServers()->create([
                    'service_id' => $servec
                ]);


                $order_item->amount += $serversDetal->amount;
                $order_item->save();
            });


            $order_item->amount = $order_item->amount * $order_item->quantity;
            $order->amount += $order_item->amount;

        });



        $order->save();

        return ['ok'];
    }

    public function allOrders(Request $request) {
        $orders = Order::query()->with('customer')->orderBy('created_at','desc')->orderBy('id','asc')->get();


        return [
            'orders' => $orders
        ];
    }

}
