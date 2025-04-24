<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardController\incomeReq;
use App\Models\Laundry;
use App\Models\Order;
use App\Models\Order_Items;
use App\Models\Services_Order;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function income(incomeReq $request)
    {



        $timeline = $this->timelineHandle($request);
        //
        $dates = $timeline['data'];
        $statistics = $timeline['statistics'];
        // dd($timeline);


        $orders = collect(Order::whereDate('received_at', '>=', $dates['start'])->whereDate('received_at', '<=',  $dates['end'])->get());

        $data = [
            'data' => [
                'date' => [],
                'values' => []
            ],
            'status' => [
                'value' => 0,
                'pc' => 0
            ],
        ];

        $startDate = Carbon::parse($dates['start']);
        $endDate = Carbon::parse($dates['end']);

        $totalAmount = 0;



        while (true) {
            $sumOfDay = $orders->filter(function ($o) use ($startDate, $totalAmount) {
                return $startDate->equalTo(Carbon::parse($o->done_at)->startOfDay());
            })->sum('amount');
            array_push($data['data']['date'], $startDate->format('Y-m-d'));
            array_push($data['data']['values'], $sumOfDay);
            $totalAmount += $sumOfDay;

            if ($startDate->greaterThanOrEqualTo($endDate)) {
                break;
            }
            $startDate->addDay(1);
        }


        if ($statistics) {
            $totalLastAmount = Order::whereDate('received_at', '>=', $statistics['start'])->whereDate('received_at', '<=',  $statistics['end'])->sum('amount');



            if ($totalAmount != $totalLastAmount && $totalLastAmount != 0) {
                $pcAmount = (($totalAmount - $totalLastAmount) / $totalLastAmount) * 100;

                $data['status']['value'] = $pcAmount < 0 ? -1 : 1;
                $data['status']['pc'] = round(abs($pcAmount),1);
            } else if ($totalAmount != $totalLastAmount) {
                $data['status']['value'] = 1;
                $data['status']['pc'] = 100;
            }
        }




        return $data;
    }

    public function orders(incomeReq $request)
    {
        // $admin = $request->user();
        $timeline = $this->timelineHandle($request);
        $dates = $timeline['data'];
        $statistics = $timeline['statistics'];


        $orders = collect(Order::whereDate('received_at', '>=', $dates['start'])->whereDate('received_at', '<=',  $dates['end'])->get());

        $data = [
            'data' => [
                'date' => [],
                'values' => []
            ],
            'status' => [
                'value' => 0,
                'pc' => 0
            ],
        ];

        $startDate = Carbon::parse($dates['start']);
        $endDate = Carbon::parse($dates['end']);

        $totalOrders = 0;



        while (true) {
            $sumOfDay = $orders->filter(function ($o) use ($startDate) {
                return $startDate->equalTo(Carbon::parse($o->done_at)->startOfDay());
            })->count();

            array_push($data['data']['date'], $startDate->format('Y-m-d'));
            array_push($data['data']['values'], $sumOfDay);
            $totalOrders += $sumOfDay;

            if ($startDate->greaterThanOrEqualTo($endDate)) {
                break;
            }
            $startDate->addDay(1);
        }


        if ($statistics) {
            $totalLastOrders = Order::whereDate('received_at', '>=', $statistics['start'])->whereDate('received_at', '<=',  $statistics['end'])->count();


            if ($totalOrders != $totalLastOrders && $totalLastOrders != 0) {
                $pcAmount = (($totalOrders - $totalLastOrders) / $totalLastOrders) * 100;

                $data['status']['value'] = $pcAmount < 0 ? -1 : 1;
                $data['status']['pc'] = round(abs($pcAmount),1);
            } else if ($totalOrders != $totalLastOrders) {
                $data['status']['value'] = 1;
                $data['status']['pc'] = 100;
            }
        }




        return $data;
    }
    public function customers(incomeReq $request)
    {
        // $admin = $request->user();
        $timeline = $this->timelineHandle($request);
        $dates = $timeline['data'];
        $statistics = $timeline['statistics'];


        $orders = collect(Order::whereDate('received_at', '>=', $dates['start'])->whereDate('received_at', '<=',  $dates['end'])->get());

        $data = [
            'data' => [
                'date' => [],
                'values' => []
            ],
            'status' => [
                'value' => 0,
                'pc' => 0
            ],
        ];

        $startDate = Carbon::parse($dates['start']);
        $endDate = Carbon::parse($dates['end']);

        $totalOrders = 0;



        while (true) {
            //!!!!! defrint customer
            $sumOfDay = $orders->filter(function ($o) use ($startDate) {
                return $startDate->equalTo(Carbon::parse($o->done_at)->startOfDay());
            })->unique('customer_id')->count();

            array_push($data['data']['date'], $startDate->format('Y-m-d'));
            array_push($data['data']['values'], $sumOfDay);
            $totalOrders += $sumOfDay;

            if ($startDate->greaterThanOrEqualTo($endDate)) {
                break;
            }
            $startDate->addDay(1);
        }




        if ($statistics) {

            $totalLastOrders = Order::select('customer_id')->whereDate('received_at', '>=', $statistics['start'])->whereDate('received_at', '<=',  $statistics['end'])->distinct()->count();
            // dd($totalLastOrders);


            if ($totalOrders != $totalLastOrders && $totalLastOrders != 0) {
                $pcAmount = (($totalOrders - $totalLastOrders) / $totalLastOrders) * 100;

                $data['status']['value'] = $pcAmount < 0 ? -1 : 1;
                $data['status']['pc'] = round(abs($pcAmount));
            } else if ($totalOrders != $totalLastOrders) {
                $data['status']['value'] = 1;
                $data['status']['pc'] = 100;
            }
        }




        return $data;
    }

    public function activityTime(incomeReq $request)
    {
        $times = collect([]);

        $timeline = $this->timelineHandle($request);
        $dates = $timeline['data'];

        $orders = collect(Order::whereDate('created_at', '>=', $dates['start'])->whereDate('created_at', '<=',  $dates['end'])->get());


        $orders->each(function ($o) use (&$times) {
            $created_houer = Carbon::parse($o->created_at)->hour;


            if (isset($times[$created_houer])) {
                // $times[$created_houer]++;
                $times[$created_houer] = $times[$created_houer] + 1;
            } else {
                $times[$created_houer] = 1;
            }
        });


        // $times =  collect([]);

        $data = [
            'times' => [],
            'pc' => []
        ];

        $times = $times->sort(fn($a, $b) => $b - $a);

        $lastKey = null;
        $skip = 1;

        // $lastKeyhour = null;

        $stop = false;


        $times->each(function ($v, $k) use (&$lastKey, &$times, &$data, &$skip, &$stop) {
            if ($k === 'lastValue') {
                return false;
            }

            if ($stop) {
                $times['lastValue'] += $v;
                $times->forget($k);
                return;
            }
            if (isset($lastKey)) {
                if ($lastKey + $skip === $k) {

                    $times[$lastKey + $skip] += $times[$lastKey + $skip - 1];


                    array_pop($data['times']);

                    $times->forget($lastKey + $skip - 1);

                    array_push($data['times'], "من " . $this->timeTitle($lastKey) . " الى " . $this->timeTitle($k + 1));

                    $skip++;
                } else {
                    if (count($data['times']) == 4) {
                        $stop = true;
                        $times['lastValue'] = $v;
                        $times->forget($k);
                        array_push($data['times'], 'اوقات اخرى');
                        return;
                        // return false;
                    }
                    array_push($data['times'], "من " . $this->timeTitle($k) . " الى " . $this->timeTitle($k + 1));
                    $skip = 1;
                    $lastKey = $k;
                }
            } else {
                array_push($data['times'], "من " . $this->timeTitle($k) . " الى " . $this->timeTitle($k + 1));

                $lastKey = $k;
            }
        });


        $times = $times->values();

        if ($times->sum() != 0) {
            $pcEachOne = 100 / $times->sum();

            $times->each(function ($v) use (&$data, $pcEachOne) {

                array_push($data['pc'], round($v * $pcEachOne,1));
            });
        } else {
            $data = [
                'times' => ['لا يوجد نشاط'],
                'pc' => [100]
            ];
        }
        // if(count($data['times']) > 5) {

        // }

        return $data;
    }

    public function executionAverageTime(incomeReq $request)
    {

        $timeline = $this->timelineHandle($request);
        $dates = $timeline['data'];
        $orders = collect(Order::whereDate('created_at', '>=', $dates['start'])->whereDate('created_at', '<=',  $dates['end'])->selectRaw('TIMESTAMPDIFF(SECOND,created_at,done_at) as exe_time')->pluck('exe_time'))->filter();


        $avgSec = $orders->isNotEmpty() ? $orders->sum() / $orders->count() : 0;


        return $this->calcAvg($avgSec);
    }

    public function deliveryAverageTime(incomeReq $request)
    {

        $timeline = $this->timelineHandle($request);
        $dates = $timeline['data'];
        $orders = collect(Order::whereDate('created_at', '>=', $dates['start'])->whereDate('created_at', '<=',  $dates['end'])->selectRaw('TIMESTAMPDIFF(SECOND,done_at, received_at) as delivery_time')->pluck('delivery_time'))->filter();


        $avgSec = $orders->isNotEmpty() ? $orders->sum() / $orders->count() : 0;



        return $this->calcAvg($avgSec);
    }

    public function mostServicesOrder(incomeReq $request)
    {
        $timeline = $this->timelineHandle($request);
        $dates = $timeline['data'];



        $order_items = collect(Order_Items::with(['itemServers' => function ($q) {
            $q->with('service');
        }, 'item'])->whereHas('order', function ($q) use ($dates) {
            $q->whereDate('orders.created_at', '>=', $dates['start'])->whereDate('orders.created_at', '<=',  $dates['end']);
        })->get());


        $preprocess = collect([]);




        $order_items->each(function ($o_item) use ($preprocess) {

            $hasSameItem = $preprocess->search(function ($d) use ($o_item) {
                return ($d['item'] == $o_item->item['id']) && collect($o_item->itemServers->values())->pluck('service_id')->diff($d['servers'])->isEmpty();
            });



            if ($hasSameItem === false) {
                $services = collect($o_item->itemServers->values())->sortBy('service_id');



                $preprocess->push([
                    'item' => $o_item->item['id'],
                    'servers' => $services->pluck('service_id')->toArray(),
                    'total' => $o_item['quantity'],
                    'names' => [
                        'item' => $o_item['item']['name'],
                        'servers' => $services->map(function ($s) {
                            return $s['service']['name'];
                        })->values(),
                    ]
                ]);
            } else {

                $item = $preprocess->get($hasSameItem);
                $item['total'] += $o_item['quantity'];
                $preprocess->put($hasSameItem, $item);
            }
        });


        $data = [];

        if ($preprocess->isNotEmpty()) {

            $pc = 100 / $preprocess->sum('total');

            $preprocess->sortByDesc('total')->values()->each(function ($pre, $i) use (&$data, $pc) {




                if ($i === 4) {
                    array_push($data, [
                        'title' => 'أخرى',
                        'pc' => number_format(round($pc * $pre['total'], 1))
                    ]);
                } else if ($i > 4) {

                    $data[4]['pc'] += number_format(round($pc * $pre['total'], 1));
                } else {
                    array_push($data, [
                        'title' => $pre['names']['item'] . ' - ' . $pre['names']['servers']->implode(', '),
                        'pc' => number_format(round($pc * $pre['total'], 1))
                    ]);
                }
            });
        }




        return [
            'services' => collect($data)->sortByDesc('pc')->values()
        ];





        //     // return ($s['item'] == 10) && ;
        // }));

        // $ServicesOrdered->each(function ($s) {
        //     $s->item_id;
        //     $s->service_id;
        //     $s->quantity;
        // });

    }

    public function lastOrders(Request $request) {
        $orders = Order::query()->with('customer')->orderBy('created_at','desc')->orderBy('id','asc')->limit(5)->get();


        return [
            'orders' => $orders
        ];
    }

    private function timelineHandle($request)
    {
        $timeline = json_decode($request->timeline, true) ?? $request->timeline;

        $isArray = $request->isArray;

        if ($isArray) {

            $dateStart = Carbon::parse($timeline['start'])->startOfDay();
            $dateEnd = Carbon::parse($timeline['end']);



            if ($dateStart->greaterThan(now()->startOfDay())) {
                $dateStart = now()->startOfDay();
            }
            if ($dateEnd->greaterThan(now()->startOfDay())) {
                $dateEnd = now()->startOfDay();
            }


            // status
            $days = $dateStart->diffInDays($dateEnd) + 1;

            // dd($dateStart->diffInDays($dateEnd));


            return [
                'data' => [
                    'start' => $dateStart->format('Y-m-d'),
                    'end' => $dateEnd->format('Y-m-d')
                ],
                'statistics' => [
                    'start' => $dateStart->clone()->subDay($days)->format('Y-m-d'),
                    'end' => $dateStart->subDay(1)->format('Y-m-d'),
                ]
            ];
        } else {
            switch ($timeline) {
                case "0": {
                        return [
                            'data' => [
                                'start' => now()->format('Y-m-d'),
                                'end' => now()->format('Y-m-d')
                            ],
                            'statistics' => [
                                'start' => Carbon::yesterday()->format('Y-m-d'),
                                'end' => Carbon::yesterday()->format('Y-m-d')
                            ]

                        ];
                        break;
                    }
                case "1": {
                        return [
                            'data' => [
                                'start' => Carbon::yesterday()->format('Y-m-d'),
                                'end' => Carbon::yesterday()->format('Y-m-d')
                            ],
                            'statistics' => [
                                'start' => Carbon::yesterday()->subDay(1)->format('Y-m-d'),
                                'end' => Carbon::yesterday()->subDay(1)->format('Y-m-d')
                            ]
                        ];
                        break;
                    }
                case "m": {
                        return [
                            'data' => [
                                'start' => now()->startOfMonth()->format('Y-m-d'),
                                'end' => now()->endOfMonth()->format('Y-m-d')
                            ],
                            'statistics' => [
                                'start' => now()->subMonth(1)->startOfMonth()->format('Y-m-d'),
                                'end' => now()->subMonth(1)->endOfMonth()->format('Y-m-d')
                            ]

                        ];
                        break;
                    }
                case "30": {
                        return [
                            'data' => [
                                'start' => now()->startOfDay()->subDay(29)->format('Y-m-d'),
                                'end' => now()->format('Y-m-d')
                            ],
                            'statistics' => [
                                'start' => now()->startOfDay()->subDay(59)->format('Y-m-d'),
                                'end' => now()->subDay(30)->format('Y-m-d')
                            ]
                        ];
                        break;
                    }
                case "365": {
                        return [
                            'data' => [
                                'start' => now()->startOfDay()->subDay(364)->format('Y-m-d'),
                                'end' => now()->format('Y-m-d')
                            ],
                            'statistics' => [
                                'start' => now()->startOfDay()->subDay(729)->format('Y-m-d'),
                                'end' => now()->subDay(365)->format('Y-m-d')
                            ]
                        ];
                        break;
                    }
                case "all": {
                    // ;
                    // Carbon::parse(Laundry::get()->first()->created_at)->format('Y-m-d')
                        return [
                            'data' => [
                                'start' =>  Carbon::parse(Order::find(1)->created_at)->format('Y-m-d'),
                                'end' => now()->format('Y-m-d')
                            ],
                            'statistics' => false

                        ];
                        break;
                    }
            }
        }
    }

    private function timeTitle($hour)
    {


        if ($hour == 24) {
            return "12 صباحاً";
        } else if ($hour < 12) {
            if ($hour == 0) {
                return "12 صباحاً";
            }
            return "$hour صباحاً";
        } else {
            $hour = $hour - 12;
            if ($hour == 0) {
                return "12 مساءً";
            }
            return "$hour مساءً";
        }
    }
    private function calcAvg($avgSec)
    {

        $second = $avgSec % 60;
        $mint = ($avgSec / 60) % 60;
        $hour = ($avgSec / 60 / 60) % 24;
        $day = ($avgSec / 60 / 60 / 24) % 30;
        $month = ($avgSec / 60 / 60 / 24 / 30) % 12;
        $year = ($avgSec / 60 / 60 / 24 / 30 / 12);


        function merge($num1, $num2, $full)
        {

            if (round($num2) == $full) {
                return floor($num1) + 1;
            }

            if ($num2 !== 0) {
                $pcByOne = (100 / $full) * $num2;
                return floor($num1) . "." . strval($pcByOne)[0];
            }


            return floor($num1);
        }

        // dd();

        if ($year >= 1) {
            return [
                'type' => 'سنة',
                'time' => merge($year, $month, 12)
            ];
        }

        if ($month >= 1) {
            return [
                'type' => 'شهر',
                'time' => merge($month, $day, 30)
            ];
        }


        if ($day >= 1) {
            return [
                'type' => 'يوم',
                'time' => merge($day, $hour, 24)
            ];
        }

        if ($mint >= 1) {
            return [
                'type' => 'دقيقة',
                'time' => merge($mint, $second, 60)
            ];
        }

        if ($second >= 1) {
            return [
                'type' => 'ثانية',
                'time' => $second
            ];
        }

        return [
            'type' => 'ثانية',
            'time' => 0
        ];
    }
}
