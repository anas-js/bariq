<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardController\incomeReq;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function income(incomeReq $request)
    {
        // $admin = $request->user();
        $timeline = $this->timelineHandle();
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
                $data['status']['pc'] = abs($pcAmount);
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
        $timeline = $this->timelineHandle();
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
                $pcAmount = (($totalOrders - $totalLastOrders) /$totalLastOrders) * 100;

                $data['status']['value'] = $pcAmount < 0 ? -1 : 1;
                $data['status']['pc'] = abs($pcAmount);
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
        $timeline = $this->timelineHandle();
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
                $pcAmount = (($totalOrders - $totalLastOrders) /$totalLastOrders) * 100;

                $data['status']['value'] = $pcAmount < 0 ? -1 : 1;
                $data['status']['pc'] = abs($pcAmount);
            } else if ($totalOrders != $totalLastOrders) {
                $data['status']['value'] = 1;
                $data['status']['pc'] = 100;
            }
        }




        return $data;
    }

    public function activityTime(incomeReq $request) {
        $times = collect([]);

        $timeline = $this->timelineHandle();
        $dates = $timeline['data'];

        $orders = collect(Order::whereDate('created_at', '>=', $dates['start'])->whereDate('created_at', '<=',  $dates['end'])->get());


        $orders->each(function ($o) use (&$times) {
            $created_houer = Carbon::parse($o->created_at)->hour;


            if(isset($times[$created_houer])) {
                // $times[$created_houer]++;
                $times[$created_houer] =$times[$created_houer]+1;
            } else {
                $times[$created_houer] = 1;
            }
        });


        $times =  collect([
            4 => 3,
            5 => 3,
            10 => 3,
            11 => 3,
            12 => 3,
            14 => 3,
            19 => 3,
            20 => 3,
        ]);

        $data = [
            'times' => [],
            'pc' => []
        ];

        // $times = $times->sort(fn($a,$b)=>$b-$a);

        $lastKey = null;
        $skip = 1;
        // $lastKeyhour = null;


        $times->each(function ($v,$k) use (&$lastKey,&$times,&$data,&$skip){

            if(isset($lastKey)) {

                if($lastKey+$skip === $k) {
                    // dump($times[$lastKey+$skip] ." =  ". $times[$lastKey]+$v);
                    // dump(" key: ". $lastKey+$skip." last Value :". $times[$lastKey+$skip]." add:".$times[$lastKey+$skip-1] . " last key:".$lastKey. " skip :".$skip);
                   $times[$lastKey+$skip] += $times[$lastKey+$skip-1];


                    array_pop($data['times']);
                    // dump($lastKey);

                    //  $times[$lastKey+$skip-1] = null;
                     $times->forget($lastKey+$skip-1);
                    // if(!isset($times[$lastKey])) {
                    //     $times->forget($lastKey);
                    // }



                    //

                    array_push($data['times'],"من ".$this->timeTitle($lastKey)." الى ". $this->timeTitle($k+1));

                    $skip++;

                } else {

                    array_push($data['times'],"من ".$this->timeTitle($k)." الى ".$this->timeTitle($k+1));
                    $skip = 1;
                    $lastKey = $k;

                }

            } else {
                array_push($data['times'],"من ".$this->timeTitle($k)." الى ".$this->timeTitle($k+1));

                $lastKey = $k;

            }

        });

        dd($times,$data);





    }

    private function timelineHandle()
    {
        $timeline = request()->timeline;
        $isArray = request()->isArray;
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
                        return [
                            'data' => [
                                'start' => "0000-01-01",
                                'end' => "9999-01-01"
                            ],
                            'statistics' => false

                        ];
                        break;
                    }
            }
        }
    }

    private function timeTitle($hour)  {


        if($hour == 24) {
            return "12 صباحاً";
        } else if($hour < 12) {
            if($hour==0) {
                 return "12 صباحاً";
            }
            return "$hour صباحاً";
        } else {
            $hour = $hour-12;
            if($hour==0) {
                return "12 مساءً";
           }
            return "$hour مساءً";
        }
    }
}
