<script setup lang="ts">
const popup = ref();
const loading = ref();

const orderTemp = ref();
const editMode = ref(false);

defineExpose({
    ...popup.value,
    async showOrder(order_id: any) {
        loading.value = true;

        popup.value.show();
        console.log(order_id);

        await $api
            .get("https://bariq.app:3000/", {
                params: {
                    order: order_id,
                },
            })
            .then((res) => {
                console.log("g");
                orderTemp.value = {
                    id: 1,
                    status: 2,
                    customer: {
                        id: 1,
                        name: "راكان المسعد",
                        phone: "0500000000",
                    },
                    invoice: [
                        {
                            item: {
                                id: 1,
                                name: "شماغ",
                            },
                            services: [
                                {
                                    id: 2,
                                    name: "غسيل",
                                    amount: 2,
                                    merge_with: [3],
                                },
                                {
                                    id: 3,
                                    name: "كوي",
                                    amount: 3,
                                    merge_with: [2],
                                },
                            ],
                            quantity: 3,
                        },
                        {
                            item: {
                                id: 1,
                                name: "شماغ",
                            },
                            services: [
                                {
                                    id: 2,
                                    name: "غسيل",
                                    amount: 2,
                                    merge_with: [3],
                                },
                                {
                                    id: 3,
                                    name: "كوي",
                                    amount: 3,
                                    merge_with: [2],
                                },
                            ],
                            quantity: 3,
                        },
                    ],
                    total: 30,
                    created_at: "2010-10-10 10:20:10",
                };
            })
            .catch((error) => {
                console.log(error);
            });

        loading.value = false;
    },
});
</script>

<template>
    <PopUpBottom ref="popup" class="order-popup">
        <template #title>
            <p>الطلب</p>
            <h1>{{ orderTemp?.id }}</h1>
        </template>

        <div class="order-body">
        <div class="order-status">
            <Status :status="orderTemp?.status || 1"></Status>
            <ElementSelect :customeList="true" :current="1">
            <template #list>
            <div data-value="1">1</div>
            <div data-value="2">2</div>
            <div data-value="3">3</div>
            <div data-value="5">4</div>
            </template>
            </ElementSelect>
        </div>


            <div class="invoice">
                <h3><i class="ri-archive-stack-line"></i>تفاصيل الطلب</h3>

                <div class="table-invoice">
                    <Tabel :data="orderTemp?.invoice || []">
                        <template #column>
                            <p>النوع</p>
                            <p>الكمية</p>
                            <p>المبلغ</p>
                        </template>
                        <template #row="{ row }">
                            <p>
                                {{ row.item.name }} -
                                {{
                                    row.services.map((i) => i.name).join(" و ")
                                }}
                            </p>
                            <p>{{ row.quantity }}</p>
                            <p>
                                {{
                                    row.services.reduce(
                                        (a, b) => a.amount + b.amount
                                    )
                                }}
                                ريال
                            </p>
                        </template>

                        <template #content>
                            <div class="total">
                                <h3>المجموع</h3>
                                <p>{{ orderTemp?.total }} ريال</p>
                            </div>
                        </template>
                    </Tabel>
                </div>

                <div class="info">
                    <div class="customer">
                        <h3><i class="ri-user-smile-line"></i>العميل</h3>
                        <div>
                        <p>{{ orderTemp?.customer.name }}</p>
                        <p>{{ orderTemp?.customer.phone }}</p>
                        </div>
                    </div>

                    <div class="datetime">
                        <h3><i class="ri-calendar-line"></i>الوقت</h3>
                        <p>{{ $help().formatDate(orderTemp?.created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <template #buttons>
            <button>
                <i class="ri-receipt-line"></i> طباعة / عرض الفاتورة
            </button>
            <button class="second">
                <i class="ri-pencil-line"></i> تعديل الطلب
            </button>
        </template>
    </PopUpBottom>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
// @import "~/assets/styles/global.scss";
.order-popup {
    .title {
        p {
            color: $color_b;
            font-weight: bold;
            font-size: 25px;
        }

        h1 {
            margin-top: -20px;
        }
    }

    .order-body {
        h3 {
            color: $color_b;
            font-weight: normal;

            i {
                display: inline-block;
                margin-inline-end: 5px;
            }
        }

        .order-status {

        }
        .invoice {
            margin-top: 10px;

            .table-invoice {
                .table {
                    padding: 10px 20px;
                    background-color: $color_backgroud;
                    padding-bottom: 20px;

                    .column {
                        font-weight: bold;
                    }

                    .row {
                        color: $color_a;
                        padding: 0;
                        margin-top: 5px;
                    }

                    .total {
                        display: block;
                        width: fit-content;
                        // margin: 0 38px auto;
                        margin-right: auto;
                        margin-left: 38px;
                        margin-top: 26px;

                        h3 {
                            font-size: 14px;
                            font-weight: bold;
                        }

                        p {
                            color: $color_a;
                        }
                        > * {
                            width: fit-content;
                        }
                    }
                }
            }
        }

        .info {
            margin-top: 20px;
            padding: 20px 0;
            color: $color_a;
            font-size: 18px;
            display: flex;
            align-items:start;
            justify-content: space-between;

            .customer {
                > div {
                    line-height: 20px;
                    // margin-top: 0px;
                    // font-size: 18px;
                }

            }

            .datetime {
                p {
                    line-height: 20px;
                }
            }
        }
    }
}
</style>
