<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Service;
use Illuminate\Http\Request;

class itemsController extends Controller
{
    public function get(Request $request) {
        $items = Item::get();
        return $items;
    }
    public function services(Request $request,$item_id) {
        $item = Item::with(['services'])->find($item_id);
        // dd($item->services[0]->service_id);

        $item['services'] = collect($item['services'])->map(function ($item) {
            $item->id = $item->service_id;
            $item->makeVisible('id');
            $item->makeHidden('status');
            // dd($item->service_id);

            return $item;
        });


        return $item;
    }
}
