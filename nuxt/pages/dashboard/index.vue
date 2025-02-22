<script setup lang="ts">
// const data = [
//     { date: "2024-10-01", Income: 122 },
//     { date: "2024-10-02", Income: 175 },
//     { date: "2024-10-03", Income: 301 },
//     { date: "2024-10-04", Income: 210 },
//     { date: "2024-10-05", Income: 95 },
//     { date: "2024-10-06", Income: 150 },
//     { date: "2024-10-07", Income: 180 },
//     { date: "2024-10-08", Income: 212 },
//     { date: "2024-10-09", Income: 320 },
//     { date: "2024-10-10", Income: 248 },
//     { date: "2024-10-11", Income: 400 },
//     { date: "2024-10-12", Income: 310 },
//     { date: "2024-10-13", Income: 260 },
//     { date: "2024-10-14", Income: 515 },
//     { date: "2024-10-15", Income: 670 },
//     { date: "2024-10-16", Income: 530 },
//     { date: "2024-10-17", Income: 625 },
//     { date: "2024-10-18", Income: 710 },
//     { date: "2024-10-19", Income: 810 },
//     { date: "2024-10-20", Income: 935 },
//     { date: "2024-10-21", Income: 755 },
//     { date: "2024-10-22", Income: 980 },
//     { date: "2024-10-23", Income: 1160 },
//     { date: "2024-10-24", Income: 1250 },
//     { date: "2024-10-25", Income: 1050 },
//     { date: "2024-10-26", Income: 800 },
//     { date: "2024-10-27", Income: 920 },
//     { date: "2024-10-28", Income: 1180 },
//     { date: "2024-10-29", Income: 1500 },
//     { date: "2024-10-30", Income: 1380 },
//     { date: "2024-10-31", Income: 1600 },
// ];

function getData() {
    return {
        incomes(time: string = "30") {
            return {
                data: {
                    date: [
                        "2025-01-01",
                        "2025-01-02",
                        "2025-01-03",
                        "2025-01-04",
                        "2025-01-05",
                        "2025-01-06",
                        "2025-01-07",
                        "2025-01-08",
                        "2025-01-09",
                        "2025-01-10",
                        "2025-01-11",
                        "2025-01-12",
                        "2025-01-13",
                        "2025-01-14",
                        "2025-01-15",
                        "2025-01-16",
                        "2025-01-17",
                        "2025-01-18",
                        "2025-01-19",
                        "2025-01-20",
                        "2025-01-21",
                        "2025-01-22",
                        "2025-01-23",
                        "2025-01-24",
                        "2025-01-25",
                        "2025-01-26",
                        "2025-01-27",
                        "2025-01-28",
                        "2025-01-29",
                        "2025-01-30",
                    ],
                    values: [
                        120, 150, 90, 200, 170, 130, 180, 220, 160, 190, 250,
                        300, 270, 210, 195, 180, 230, 280, 260, 240, 275, 290,
                        310, 285, 260, 250, 220, 200, 190, 175,
                    ],
                },
                status: {
                    value: 1,
                    pc: 20,
                },
            };
        },
        orders(time: string = "30") {
            return {
                data: {
                    date: [
                        "2025-01-01",
                        "2025-01-02",
                        "2025-01-03",
                        "2025-01-04",
                        "2025-01-05",
                        "2025-01-06",
                        "2025-01-07",
                        "2025-01-08",
                        "2025-01-09",
                        "2025-01-10",
                        "2025-01-11",
                        "2025-01-12",
                        "2025-01-13",
                        "2025-01-14",
                        "2025-01-15",
                        "2025-01-16",
                        "2025-01-17",
                        "2025-01-18",
                        "2025-01-19",
                        "2025-01-20",
                        "2025-01-21",
                        "2025-01-22",
                        "2025-01-23",
                        "2025-01-24",
                        "2025-01-25",
                        "2025-01-26",
                        "2025-01-27",
                        "2025-01-28",
                        "2025-01-29",
                        "2025-01-30",
                    ],
                    values: [
                        10, 12, 8, 15, 14, 9, 13, 17, 11, 16, 20, 22, 19, 18,
                        16, 15, 21, 23, 22, 19, 24, 25, 27, 26, 22, 21, 19, 18,
                        17, 14,
                    ],
                },
                status: {
                    value: -1,
                    pc: 20,
                },
            };
        },
        customers(time: string = "30") {
            return {
                data: {
                    date: [
                        "2025-01-01",
                        "2025-01-02",
                        "2025-01-03",
                        "2025-01-04",
                        "2025-01-05",
                        "2025-01-06",
                        "2025-01-07",
                        "2025-01-08",
                        "2025-01-09",
                        "2025-01-10",
                        "2025-01-11",
                        "2025-01-12",
                        "2025-01-13",
                        "2025-01-14",
                        "2025-01-15",
                        "2025-01-16",
                        "2025-01-17",
                        "2025-01-18",
                        "2025-01-19",
                        "2025-01-20",
                        "2025-01-21",
                        "2025-01-22",
                        "2025-01-23",
                        "2025-01-24",
                        "2025-01-25",
                        "2025-01-26",
                        "2025-01-27",
                        "2025-01-28",
                        "2025-01-29",
                        "2025-01-30",
                    ],
                    values: [
                        5, 6, 4, 7, 6, 5, 6, 8, 6, 7, 9, 10, 9, 8, 7, 7, 10, 11,
                        10, 9, 12, 13, 14, 13, 11, 10, 9, 8, 7, 6,
                    ],
                },
                status: {
                    value: 0,
                    pc: 0,
                },
            };
        },
        activityTime(time: string = "30") {
            return {
                data: {
                    times: ["من 6 الى 11 مساءً", "من 10 الى 11 صباحاً"],
                    pc: [80, 20],
                },
            };
        },
        executionAverageTime(time: string = "30") {
            return {
                time: 30,
                type: "دقيقة",
            };
        },
        deliveryAverageTime(time: string = "30") {
            return {
                time: 4,
                type: "ساعات",
            };
        },
        mostServicesOrder(time: string = "30") {
            return {
                services: [
                    {
                        title: "شماغ - غسيل وكوي",
                        pc: 70,
                    },
                    {
                        title: "ثوب - كوي",
                        pc: 20,
                    },
                    {
                        title: "بدلة - غسيل و كوي",
                        pc: 6,
                    },
                    {
                        title: "بطانية - غسيل",
                        pc: 3,
                    },
                    {
                        title: "خدمات اخرى",
                        pc: 1,
                    },
                ],
            };
        },
        lastOrders() {
            return {
                orders: [
                    {
                        id: 1,
                        customer: {
                            name: "خالد مسعد",
                            id: 12,
                        },
                        amount: 31,
                        status: 2,
                        date: "2025-10-10 10:20",
                    },
                    {
                        id: 2,
                        customer: {
                            name: "راكان محمد",
                            id: 12,
                        },
                        amount: 21,
                        status: 3,
                        date: "2025-10-10 10:20",
                    },
                ],
            };
        },
    };
}

const incomes = ref({ ...getData().incomes(), timeline: "أخر شهر" });
const orders = ref({ ...getData().orders(), timeline: "أخر شهر" });
const customers = ref({ ...getData().customers(), timeline: "أخر شهر" });
const activityTime = ref({ ...getData().activityTime(), timeline: "أخر شهر" });
const executionAverageTime = ref({
    ...getData().executionAverageTime(),
    timeline: "أخر شهر",
});
const deliveryAverageTime = ref({
    ...getData().deliveryAverageTime(),
    timeline: "أخر شهر",
});
const mostServicesOrder = ref({
    ...getData().mostServicesOrder(),
    timeline: "أخر شهر",
});

const calcTotal = (data: any) => {
    return data.values.reduce((a: any, b: any) => a + b);
};

function timeLineSelect(event: any, type: string) {
    switch (type) {
        case "incomes": {
            incomes.value = {
                ...getData().incomes(event.time.value),
                timeline: event.time.title,
            };
            break;
        }
        case "orders": {
            orders.value = {
                ...getData().orders(event.time.value),
                timeline: event.time.title,
            };

            break;
        }
        case "customers": {
            customers.value = {
                ...getData().customers(event.time.value),
                timeline: event.time.title,
            };

            break;
        }
        case "activityTime": {
            activityTime.value = {
                ...getData().activityTime(event.time.value),
                timeline: event.time.title,
            };
            break;
        }
        case "executionAverageTime": {
            executionAverageTime.value = {
                ...getData().executionAverageTime(event.time.value),
                timeline: event.time.title,
            };
            break;
        }
        case "deliveryAverageTime": {
            deliveryAverageTime.value = {
                ...getData().deliveryAverageTime(event.time.value),
                timeline: event.time.title,
            };

            console.log(deliveryAverageTime.value.timeline);
            break;
        }
        case "mostServicesOrder": {
            mostServicesOrder.value = {
                ...getData().mostServicesOrder(event.time.value),
                timeline: event.time.title,
            };

            break;
        }
    }
    event.done();
}

// timelines Lists
const timeLineIncomeList = ref();
const timeLineOrdersList = ref();
const timeLineCustomersList = ref();
const timeLineActivityTimeList = ref();
const timeLineExecutionAverageTimeList = ref();
const timeLineDeliveryAverageTimeList = ref();
const timeLineMostServicesOrderList = ref();

const preTimeLine = ref("آخر شهر");
function preTimeLineSelect(event: any) {
    timeLineIncomeList.value.loading();
    timeLineSelect(
        { done: timeLineIncomeList.value.done, time: event.time },
        "incomes"
    );

    timeLineOrdersList.value.loading();
    timeLineSelect(
        { done: timeLineOrdersList.value.done, time: event.time },
        "orders"
    );

    timeLineCustomersList.value.loading();
    timeLineSelect(
        { done: timeLineCustomersList.value.done, time: event.time },
        "customers"
    );

    timeLineActivityTimeList.value.loading();
    timeLineSelect(
        { done: timeLineActivityTimeList.value.done, time: event.time },
        "activityTime"
    );

    timeLineExecutionAverageTimeList.value.loading();
    timeLineSelect(
        { done: timeLineExecutionAverageTimeList.value.done, time: event.time },
        "executionAverageTime"
    );

    timeLineDeliveryAverageTimeList.value.loading();
    timeLineSelect(
        { done: timeLineDeliveryAverageTimeList.value.done, time: event.time },
        "deliveryAverageTime"
    );

    timeLineMostServicesOrderList.value.loading();
    timeLineSelect(
        { done: timeLineMostServicesOrderList.value.done, time: event.time },
        "mostServicesOrder"
    );

    preTimeLine.value = event.time.title;
    event.done();
}

const lastOrders = ref(getData().lastOrders());



function showCustomer(id: number) {}


</script>



<template>
    <div class="dashboard-page">
        <div class="top">
            <h1><i class="ri-pie-chart-line"></i>لوحة التحكم</h1>

            <div class="pre-timeline">
                <span class="date" @click="$refs['preTimeLineList'].toggle()"
                    >{{ preTimeLine }}<i class="ri-arrow-drop-down-line"></i
                ></span>
                <TimelineList
                    @select="preTimeLineSelect($event)"
                    ref="preTimeLineList"
                />
            </div>
        </div>
        <div class="page-conteiner">
            <div class="statistics">
                <div class="lineChart">
                    <div class="top">
                        <p class="title">الإيرادات</p>

                        <span
                            v-if="incomes.status.value === 1"
                            class="tag green"
                            >+{{ incomes.status.pc }}%</span
                        >
                        <span
                            v-else-if="incomes.status.value === -1"
                            class="tag red"
                            >-{{ incomes.status.pc }}%</span
                        >

                        <div class="timeline">
                            <span
                                class="date"
                                @click="$refs['timeLineIncomeList'].toggle()"
                                >{{ incomes.timeline
                                }}<i class="ri-arrow-drop-down-line"></i
                            ></span>
                            <TimelineList
                                @select="timeLineSelect($event, 'incomes')"
                                ref="timeLineIncomeList"
                            />
                        </div>
                    </div>
                    <div class="value">
                        <h2>{{ calcTotal(incomes.data) }}</h2>
                        <p>ريال</p>
                    </div>
                    <div class="chart">
                        <Chart
                            :status="incomes.status.value"
                            :row="incomes.data.date"
                            :column="incomes.data.values"
                        />
                    </div>
                </div>
                <div class="lineChart">
                    <div class="top">
                        <p class="title">الطلبات</p>
                        <span v-if="orders.status.value === 1" class="tag green"
                            >+{{ orders.status.pc }}%</span
                        >
                        <span
                            v-else-if="orders.status.value === -1"
                            class="tag red"
                            >-{{ orders.status.pc }}%</span
                        >
                        <div class="timeline">
                            <span
                                class="date"
                                @click="$refs['timeLineOrdersList'].toggle()"
                                >{{ orders.timeline
                                }}<i class="ri-arrow-drop-down-line"></i
                            ></span>
                            <TimelineList
                                @select="timeLineSelect($event, 'orders')"
                                ref="timeLineOrdersList"
                            />
                        </div>
                    </div>
                    <div class="value">
                        <h2>{{ calcTotal(orders.data) }}</h2>
                        <p>طلب</p>
                    </div>
                    <div class="chart">
                        <Chart
                            :status="orders.status.value"
                            :row="orders.data.date"
                            :column="orders.data.values"
                        />
                    </div>
                </div>
                <div class="lineChart">
                    <div class="top">
                        <p class="title">العملاء</p>
                        <span
                            v-if="customers.status.value === 1"
                            class="tag green"
                            >+{{ customers.status.pc }}%</span
                        >
                        <span
                            v-else-if="customers.status.value === -1"
                            class="tag red"
                            >-{{ customers.status.pc }}%</span
                        >
                        <div class="timeline">
                            <span
                                class="date"
                                @click="$refs['timeLineCustomersList'].toggle()"
                                >{{ customers.timeline
                                }}<i class="ri-arrow-drop-down-line"></i
                            ></span>
                            <TimelineList
                                @select="timeLineSelect($event, 'customers')"
                                ref="timeLineCustomersList"
                            />
                        </div>
                    </div>
                    <div class="value">
                        <h2>{{ calcTotal(customers.data) }}</h2>
                        <p>عملاء</p>
                    </div>
                    <div class="chart">
                        <Chart
                            :status="customers.status.value"
                            :row="customers.data.date"
                            :column="customers.data.values"
                        />
                    </div>
                </div>

                <div class="activityTime">
                    <div class="top">
                        <p class="title">أوقات النشاط</p>
                        <div class="timeline">
                            <span
                                class="date"
                                @click="
                                    $refs['timeLineActivityTimeList'].toggle()
                                "
                                >{{ activityTime.timeline
                                }}<i class="ri-arrow-drop-down-line"></i
                            ></span>
                            <TimelineList
                                @select="timeLineSelect($event, 'activityTime')"
                                ref="timeLineActivityTimeList"
                            />
                        </div>
                    </div>
                    <div class="chart">
                        <Chart
                            chart="pie"
                            :row="activityTime.data.times"
                            :column="activityTime.data.pc"
                        />
                    </div>
                </div>

                <div class="number-box">
                    <p class="title">متوسط وقت التنفيذ</p>
                    <div class="content">
                        <div>
                            <div class="value">
                                <h2>{{ executionAverageTime.time }}</h2>
                                <p>{{ executionAverageTime.type }}</p>
                            </div>
                            <div class="timeline">
                                <span
                                    class="date"
                                    @click="
                                        $refs[
                                            'timeLineExecutionAverageTimeList'
                                        ].toggle()
                                    "
                                    >{{ executionAverageTime.timeline
                                    }}<i class="ri-arrow-drop-down-line"></i
                                ></span>
                                <TimelineList
                                    @select="
                                        timeLineSelect(
                                            $event,
                                            'executionAverageTime'
                                        )
                                    "
                                    ref="timeLineExecutionAverageTimeList"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="number-box">
                    <p class="title">متوسط وقت الإستلام</p>
                    <div class="content">
                        <div>
                            <div class="value">
                                <h2>{{ deliveryAverageTime.time }}</h2>
                                <p>{{ deliveryAverageTime.type }}</p>
                            </div>
                            <div class="timeline">
                                <span
                                    class="date"
                                    @click="
                                        $refs[
                                            'timeLineDeliveryAverageTimeList'
                                        ].toggle()
                                    "
                                    >{{ deliveryAverageTime.timeline
                                    }}<i class="ri-arrow-drop-down-line"></i
                                ></span>
                                <TimelineList
                                    @select="
                                        timeLineSelect(
                                            $event,
                                            'deliveryAverageTime'
                                        )
                                    "
                                    ref="timeLineDeliveryAverageTimeList"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mostServicesOrder">
                    <div class="top">
                        <p class="title">اكثر الخدمات طلباً</p>
                        <div class="timeline">
                            <span
                                class="date"
                                @click="
                                    $refs[
                                        'timeLineMostServicesOrderList'
                                    ].toggle()
                                "
                                >{{ mostServicesOrder.timeline
                                }}<i class="ri-arrow-drop-down-line"></i
                            ></span>
                            <TimelineList
                                @select="
                                    timeLineSelect($event, 'mostServicesOrder')
                                "
                                ref="timeLineMostServicesOrderList"
                            />
                        </div>
                    </div>
                    <div class="servers-order">
                        <div v-for="item in mostServicesOrder.services">
                            <div class="title">{{ item.title }}</div>
                            <div class="pc">
                                <p>{{ item.pc }}%</p>
                                <span
                                    class="bar"
                                    :style="`width:${item.pc}%`"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="last-orders">
                <div class="title">
                    <h2>آخر الطلبات</h2>
                    <NuxtLink to="/dashboard/orders"
                        >الكل<i class="ri-arrow-drop-left-line"></i
                    ></NuxtLink>
                </div>
                <Tabel :data="lastOrders.orders">
                    <template #column>
                        <h3>الطلب</h3>
                        <h3>العميل</h3>
                        <h3>المبلغ</h3>
                        <h3>الحالة</h3>
                        <h3>الوقت</h3>
                        <h3>التفاصيل</h3>
                    </template>
                    <template #row="{ row }">
                        <p>{{ row.id }}#</p>
                        <p class="customer" @click="showCustomer(row.id)">
                            {{ row.customer.name }}
                        </p>
                        <p>{{ row.amount }} ريال</p>
                        <p><Status :status="row.status"></Status></p>
                        <p>{{ $help().formatDate(row.date) }}</p>
                        <div>
                            <button @click="$refs['PopUpOrder'].showOrder(row.id)" class="expand">
                                <i class="ri-expand-diagonal-2-line"></i>
                            </button>
                        </div>
                    </template>
                </Tabel>
            </div>
        </div>
        <PopUpOrder ref="PopUpOrder">
        </PopUpOrder>
    </div>
</template>
