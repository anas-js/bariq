<script setup lang="ts">
const popup = ref();
const loading = ref();

const orderTemp = ref();
const orderEdit = ref();
const editMode = ref(false);
const emits = defineEmits(['createOrder']);

defineExpose({
    ...popup.value,
    async showOrder(order_id: any) {
        loading.value = true;

        popup.value.show();
        // console.log($app().BK_URL + "/orders/" + order_id);

        await $api
            .get($app().BK_URL.api + "/orders/" + order_id)
            .then((res) => {
                // console.log(res);
                orderTemp.value = res;
                orderEdit.value = JSON.parse(JSON.stringify(res));
                console.log(res);
                // console.log(res);
                // orderTemp.value = {
                //     id: 1,
                //     status: 2,
                //     customer: {
                //         id: 1,
                //         name: "راكان المسعد",
                //         phone: "0500000000",
                //     },
                //     invoice: [
                //         {
                //             item: {
                //                 id: 1,
                //                 name: "شماغ",
                //             },
                //             services: [
                //                 {
                //                     id: 2,
                //                     name: "غسيل",
                //                     amount: 2,
                //                     merge_with: [3],
                //                 },
                //                 {
                //                     id: 3,
                //                     name: "كوي",
                //                     amount: 3,
                //                     merge_with: [2],
                //                 },
                //             ],
                //             quantity: 3,
                //         },
                //         {
                //             item: {
                //                 id: 1,
                //                 name: "شماغ",
                //             },
                //             services: [
                //                 {
                //                     id: 2,
                //                     name: "غسيل",
                //                     amount: 2,
                //                     merge_with: [3],
                //                 },
                //                 {
                //                     id: 3,
                //                     name: "كوي",
                //                     amount: 3,
                //                     merge_with: [2],
                //                 },
                //             ],
                //             quantity: 3,
                //         },
                //     ],
                //     total: 30,
                //     created_at: "2010-10-10 10:20:10",
                // };
            })
            .catch((error) => {
                console.log(error);
            });

        loading.value = false;
    },
    newOrder() {
        popup.value.show();
        editMode.value = true;

        orderEdit.value = {
            amount: 0,
            customer: null,
            order_items: [],
        };

        // orderEdit
    },
});

function updateOrderStatus(e) {
    orderEdit.value.status = e;
}
function saveEdit() {
    orderTemp.value = JSON.parse(JSON.stringify(orderEdit.value));

    console.log(orderTemp.value);
    editMode.value = false;
}

function updatePrice() {
    // console.log( orderEdit.value.amount);

    if (!orderEdit.value.order_items.length) {
        orderEdit.value.amount = 0;
        return;
    }
    orderEdit.value.amount = orderEdit.value.order_items
        .map((e) => +e.amount)
        .reduce((a, b) => a + b);
    // console.log(orderEdit.value.order_items.map((e)=>+e.amount).reduce((a,b)=>a+b));
}

function updateItemPrice(item: any) {
    //
    // console.log(item);
    if (item.quantity < 0 || item.quantity > 100) {
        $msg({
            text: "اكبر كمية هي 100 واقلها هي واحد",
            type: "error",
        });
        item.quantity = 1;
    }

    let total = 0;
    item.item_servers.forEach((s) => {
        const ser = item.service_available.find((sa) => sa.id === s.id);
        total += +ser.amount;
    });
    item.amount = item.quantity * total;

    updatePrice();
}

function deleteItem(item: any) {
    // console.log()
    orderEdit.value.order_items = orderEdit.value.order_items.filter(
        (e) => e.id != item.id
    );

    updatePrice();

    // item.
}

const addItemsSelect = ref({});

function getAddItemInfo(item: any) {
    // console.log(itemId);
    addItemsSelect.value = {};
    $api.get($app().BK_URL.api + "/items/" + item.id).then((res: any) => {
        // console.log(res);
        addItemsSelect.value = {
            amount: 0,
            item_servers: [],
            service_available: res.services,
            item: item,
            quantity: 1,
        };
    });

    // console.log(addItemsSelect.value);
}

function selectItemToAddCart(e) {
    // console.log(e);

    addItemsSelect.value.item_servers = e;
}

const OrderItemSelectAddToCart = ref();

function addItemToCartQuantityChange(e) {
    const q = Number(e.target.value);
    if (q > 100 || q < 0) {
        $msg({
            text: "القيمة الادنى 0 والعليا 100",
            type: "error",
        });
        return;
    }
    if (addItemsSelect.value) {
        addItemsSelect.value.quantity = q;
        OrderItemSelectAddToCart.value.calcTotal();
    }

    // console.log();
}

function addItemToCart() {
    if (!addItemsSelect.value?.item_servers?.length) {
        $msg({
            text: "يرجى اختيار خدمات",
            type: "error",
        });
        return;
    }

    addItemsSelect.value.id = Math.random();
    orderEdit.value.order_items.push(
        JSON.parse(JSON.stringify(addItemsSelect.value))
    );

    // addItemsSelect.value = {};
    // console.log();

    updatePrice();
    // console.log(addItemsSelect.value);
}

function closePopUp() {
    popup.value.close();
    // editMode.value = true;

    orderEdit.value = {
        amount: 0,
        customer: null,
        order_items: [],
    };
}

async function createNewOrder() {
    if (!orderEdit.value?.customer?.id) {
        $msg({
            type: "error",
            text: "يرجى اختيار العميل",
        });
        return;
    }

    if (!orderEdit.value.order_items.length) {
        $msg({
            type: "error",
            text: "لم تقم بإضافة اي خدمات في الطلب",
        });
        return;
    }
    const data = {
        customer: orderEdit.value.customer.id,
        items: orderEdit.value.order_items.map((e) => {
            const data = {};

            data.item = e.item.id;
            data.servers = e.item_servers.map((e) => e.id);
            data.quantity = e.quantity;
            return data;
        }),
    };

    // console.log(data,orderEdit.value);

    loading.value = true;

   await $api.post($app().BK_URL.api + "/orders/create", {
        body: data,
    })
        .then(() => {
            $msg({
                type: "ok",
                text: "تم إنشاء الطلب بنجاح",
            });

            popup.value.close();
        })
        .catch(() => {
            $msg({
                type: "error",
                text: "فشل إنشاء الطلب",
            });

        });

        emits('createOrder');
        loading.value = false;
}

function changeCustomer(e) {
    // console.log(e);
    orderEdit.value.customer = e;
}
</script>

<template>
    <PopUpBottom
        ref="popup"
        class="order-popup"
        @close="editMode = false"
        :loading="loading"
    >
        <template #title>
            <p>الطلب</p>
            <h1>{{ orderTemp?.id || "طلب جديد" }}</h1>
        </template>

        <div class="order-body">
            <div class="order-status" v-if="orderTemp">
                <ElementSelect
                    v-if="editMode"
                    :customeList="true"
                    :current="orderTemp?.status || 1"
                    @select="updateOrderStatus"
                >
                    <template #list>
                        <li data-value="1"><Status :status="1"></Status></li>
                        <li data-value="2"><Status :status="2"></Status></li>
                        <li data-value="3"><Status :status="3"></Status></li>
                        <li data-value="4"><Status :status="4"></Status></li>
                        <li data-value="5"><Status :status="5"></Status></li>
                    </template>
                </ElementSelect>
                <Status v-else :status="orderTemp?.status || 1"></Status>
            </div>

            <div class="invoice">
                <h3><i class="ri-archive-stack-line"></i>تفاصيل الطلب</h3>

                <div class="table-invoice">
                    <Tabel
                        class="editmode"
                        v-if="editMode"
                        :data="orderEdit?.order_items || []"
                    >
                        <template #column>
                            <p>النوع</p>
                            <p>الكمية</p>
                            <p>المبلغ</p>
                            <p>حذف؟</p>
                        </template>
                        <template #row="{ row }">
                            <p>
                                {{ row?.item?.name }}

                                <OrderItemSelect
                                    @price-change="updatePrice"
                                    :item="row"
                                />
                            </p>
                            <input
                                min="1"
                                max="100"
                                @input="updateItemPrice(row)"
                                class="quantity"
                                type="number"
                                v-model="row.quantity"
                            />

                            <p>
                                <!-- row.item_servers.reduce(
                                        (a, b) => a.amount + b.amount
                                    ) -->
                                {{ row.amount }}
                                ريال
                            </p>

                            <button class="delete" @click="deleteItem(row)">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </template>

                        <template #content>
                            <div class="total">
                                <h3>المجموع</h3>
                                <p>{{ orderEdit?.amount }} ريال</p>
                            </div>

                            <div class="add-items">
                                <div>
                                    <label>إضافة صنف</label>
                                    <OrderItemSelectItem
                                        @select="getAddItemInfo"
                                    />
                                </div>
                                <div>
                                    <label>الخدمة</label>

                                    <OrderItemSelect
                                        ref="OrderItemSelectAddToCart"
                                        :item="addItemsSelect"
                                        @select="selectItemToAddCart"
                                    />
                                </div>
                                <div>
                                    <label>الكمية</label>
                                    <input
                                        @input="addItemToCartQuantityChange"
                                        type="number"
                                        value="1"
                                        min="1"
                                        max="100"
                                    />
                                </div>
                                <div>
                                    <button
                                        class="addBtn"
                                        @click="addItemToCart"
                                    >
                                        إضافة
                                        <span class="ryal"
                                            >{{
                                                addItemsSelect.amount
                                            }}
                                            ريال</span
                                        >
                                    </button>
                                </div>
                            </div>
                        </template>
                    </Tabel>

                    <Tabel v-else :data="orderTemp?.order_items || []">
                        <template #column>
                            <p>النوع</p>
                            <p>الكمية</p>
                            <p>المبلغ</p>
                        </template>
                        <template #row="{ row }">
                            <p>
                                {{ row.item.name }}

                                -
                                {{
                                    row.item_servers
                                        .map((i) => i.name)
                                        .join(" و ")
                                }}
                            </p>

                            <p>{{ row.quantity }}</p>
                            <p>
                                <!-- row.item_servers.reduce(
                                        (a, b) => a.amount + b.amount
                                    ) -->
                                {{ row.amount }}
                                ريال
                            </p>
                        </template>

                        <template #content>
                            <div class="total">
                                <h3>المجموع</h3>
                                <p>{{ orderTemp?.amount }} ريال</p>
                            </div>
                        </template>
                    </Tabel>
                </div>

                <div class="info">
                    <div class="customer">
                        <h3><i class="ri-user-smile-line"></i>العميل</h3>
                        <div>
                            <template v-if="!editMode">
                                <p>{{ orderTemp?.customer.name }}</p>
                                <p>{{ orderTemp?.customer.phone }}</p>
                            </template>
                            <template v-else>
                                <CustomerSelect
                                    :customer="orderEdit?.customer"
                                    @select="changeCustomer"
                                ></CustomerSelect>
                            </template>
                        </div>
                    </div>

                    <div v-if="orderTemp" class="datetime">
                        <h3><i class="ri-calendar-line"></i>الوقت</h3>
                        <p>{{ $help().formatDate(orderTemp?.created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <template #buttons>
            <template v-if="orderTemp">
                <template v-if="editMode">
                    <button @click="saveEdit()">
                        <i class="ri-save-line"></i> حفظ الطلب
                    </button>
                    <button @click="editMode = false" class="cancel">
                        <i class="ri-close-line"></i> الغاء التعديلات
                    </button>
                </template>

                <template v-else>
                    <button>
                        <i class="ri-receipt-line"></i> طباعة / عرض الفاتورة
                    </button>
                    <button @click="editMode = true" class="second">
                        <i class="ri-pencil-line"></i> تعديل الطلب
                    </button>
                </template>
            </template>
            <template v-else>
                <button @click="createNewOrder()">
                    <i class="ri-save-line"></i> إنشاء طلب جديد
                </button>
                <button @click="closePopUp()" class="cancel">
                    <i class="ri-close-line"></i> الغاء
                </button>
            </template>

            <!-- <button v-else @click="saveEdit()" class="second">
                <i class="ri-pencil-line"></i> الغاء
            </button> -->
        </template>
    </PopUpBottom>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/global.scss";
.order-popup {
    .box {
        width: 700px;
    }
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

                    &.editmode {
                        text-align: center;
                        // align-items: center;
                        .column {
                            > * {
                                justify-content: center;
                                &:first-of-type {
                                    width: 50%;
                                }
                                &:nth-child(2) {
                                    width: 15%;
                                }
                                &:nth-child(3) {
                                    width: 20%;
                                }
                                &:last-child {
                                    width: 5%;
                                    // text-align: ct;
                                }
                            }
                        }

                        .row {
                            > * {
                                justify-content: center;
                                &:first-of-type {
                                    width: 50%;
                                    justify-content: right;
                                }
                                &:nth-child(2) {
                                    width: 15%;
                                }
                                &:nth-child(3) {
                                    width: 20%;
                                }
                                &:last-child {
                                    width: 5%;
                                    // text-align: ct;
                                }
                            }
                        }

                        .add-items {
                            margin-top: 20px;
                            align-items: flex-end;
                            gap: 10px;
                            > div {
                                text-align: right;

                                label {
                                    color: $color_a;
                                }

                                input:not(.select-element input):not(
                                        .select-element-items input
                                    ) {
                                    @extend .main-input;
                                    border-color: $color_a;
                                    border: 2px solid $color_a;
                                }

                                .select-element {
                                    box-sizing: border-box;
                                    width: 100%;
                                    background-color: $color_white;

                                    .input {
                                        box-sizing: border-box;
                                        width: 100%;

                                        input {
                                            background-color: $color_white;
                                            width: 100% !important;
                                        }
                                    }
                                    .list {
                                        color: $color_a;
                                    }
                                }

                                &:first-of-type {
                                    width: 40%;
                                }
                                &:nth-of-type(2) {
                                    width: 30%;
                                }
                                &:nth-of-type(3) {
                                    width: 15%;
                                }
                                &:nth-of-type(4) {
                                    width: 15%;
                                }
                            }
                        }
                    }

                    .column {
                        font-weight: bold;

                        > * {
                            &:first-of-type {
                                width: 70%;
                                text-align: right;
                                // padding-right: 10px;
                            }
                            &:nth-child(2) {
                                width: 10%;
                            }
                            &:last-child {
                                width: 20%;
                                // text-align: ct;
                            }
                        }
                    }

                    .row {
                        color: $color_a;
                        padding: 0;
                        margin-top: 5px;

                        > * {
                            display: flex;
                            align-items: center;
                            gap: 10px;

                            &:first-of-type {
                                width: 70%;
                                text-align: right;
                                // padding-right: 10px;
                            }
                            &:nth-child(2) {
                                width: 15%;
                            }
                            &:last-child {
                                justify-content: left;
                                width: 15%;
                                text-align: left;
                            }
                        }
                    }

                    .total {
                        display: block;
                        width: fit-content;
                        // margin: 0 38px auto;
                        margin-right: auto;
                        margin-left: 0;
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
                    .delete {
                        @extend .main-button;
                        // background-color: $color_red;
                        background: none;
                        cursor: pointer;
                        color: $color_red;
                    }

                    .quantity {
                        @extend .main-input;
                        // border-radius: 14px;
                        border-color: $color_a;
                        border: 2px solid $color_a;
                    }

                    .select-element {
                        input {
                            background-color: $color_backgroud;
                            width: 120px;
                        }
                    }

                    .addBtn {
                        @extend .main-button;
                        cursor: pointer;

                        .ryal {
                            background-color: $color_backgroud;
                            color: $color_a;
                            display: block;
                            font-size: 15px;
                            border-radius: 25px;
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
            align-items: start;
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
