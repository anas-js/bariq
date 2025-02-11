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
        incomes(time : string = '30') {
            return {
                data: {
                    date: [
                        "2025-10-23",
                        "2025-10-23",
                        "2025-10-23",
                        "2025-10-23",
                    ],
                    values: [24, 0, 22, 70],
                },
                status: {
                    value: 1,
                    pc: 20,
                },
            };
        },
        orders() {
            return {
                data: {
                    date: [
                        "2025-10-23",
                        "2025-10-23",
                        "2025-10-23",
                        "2025-10-23",
                    ],
                    values: [4, 0, 6, 20],
                },
                status: {
                    value: -1,
                    pc: 20,
                },
            };
        },
        customers() {
            return {
                data: {
                    date: [
                        "2025-10-23",
                        "2025-10-23",
                        "2025-10-23",
                        "2025-10-23",
                    ],
                    values: [2, 0, 4, 4],
                },
                status: {
                    value: 0,
                    pc: 0,
                },
            };
        },
        activityTime() {},
        executionAverageTime() {},
        deliveryAverageTime() {},
        mostServices() {},
    };
}


const incomes = ref(
    {...getData().incomes(),
        timeline: 'أخر شهر'
    });
const orders = ref({...getData().orders(), timeline: 'أخر شهر'});
const customers = ref({...getData().customers(), timeline: 'أخر شهر'});

const calcTotal = (data: any) => {
    return data.values.reduce((a: any, b: any) => a + b);
};

function timeLineSelect(event:any,type : string) {
    switch(type) {
        case 'incomes' : {
            incomes.value = {...getData().incomes(event.time.value),timeline:event.time.title};
            event.done();
            break;
        }
    }
};
</script>

<template>
    <div class="dashboard-page">
        <h1><i class="ri-pie-chart-line"></i>لوحة التحكم</h1>

        <div class="statistics">
            <div>
                <div class="top">
                    <p class="title">الإيرادات</p>

                    <span v-if="incomes.status.value===1" class="tag green">+{{incomes.status.pc}}%</span>
                    <span v-else-if="incomes.status.value===-1" class="tag red">-{{incomes.status.pc}}%</span>

                    <div class="timeline" >
                        <span class="date" @click="$refs['timeLineIncomeList'].toggle()"
                            >{{ incomes.timeline }}<i class="ri-arrow-drop-down-line"></i
                        ></span>
                        <TimelineList @select="timeLineSelect($event,'incomes')"  ref="timeLineIncomeList" />
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
            <div>
                <div class="top">
                    <p class="title">الطلبات</p>
                    <span v-if="orders.status.value===1" class="tag green">+{{orders.status.pc}}%</span>
                    <span v-else-if="orders.status.value===-1" class="tag red">-{{orders.status.pc}}%</span>
                    <div class="timeline">
                        <span class="date"
                            >{{ orders.timeline }}<i class="ri-arrow-drop-down-line"></i
                        ></span>

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
            <div>
                <div class="top">
                    <p class="title">العملاء</p>
                    <span v-if="customers.status.value===1" class="tag green">+{{customers.status.pc}}%</span>
                    <span v-else-if="customers.status.value===-1" class="tag red">-{{customers.status.pc}}%</span>
                    <div class="timeline">
                        <span class="date"
                            >{{ customers.timeline }}<i class="ri-arrow-drop-down-line"></i
                        ></span>
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
        </div>
    </div>
</template>
