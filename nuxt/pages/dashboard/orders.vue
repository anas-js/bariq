<script setup lang="ts">
const orders = ref();

onMounted(() => {
   $api.get($app().BK_URL.api + "/orders/all").then((res) => {
        orders.value = res.orders;
        //  console.log(res);
    });

});


function updateOrders() {
    orders.value = null;
    $api.get($app().BK_URL.api + "/orders/all").then((res) => {
        orders.value = res.orders;
        //  console.log(res);
    });
}
function showCustomer(id: number) {}
</script>

<template>
    <div class="orders-page">
        <div class="top">
            <h1><i class="ri-archive-line"></i>الطلبات</h1>
            <button @click="$refs['PopUpOrder'].newOrder()" class="new-order">
                <i class="ri-add-line"></i>طلب جديد
            </button>
        </div>
        <div class="page-conteiner">
            <div class="orders">
                <div class="title">
                    <h2>الطلبات</h2>
                </div>
                <Tabel v-if="orders" :data="orders">
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
                        <p>{{ $help().formatDate(row.created_at) }}</p>
                        <div>
                            <button
                                @click="$refs['PopUpOrder'].showOrder(row.id)"
                                class="expand"
                            >
                                <i class="ri-expand-diagonal-2-line"></i>
                            </button>
                        </div>
                    </template>
                </Tabel>
                <Loading v-else />
            </div>
        </div>
        <PopUpOrder ref="PopUpOrder" @create-order="updateOrders"> </PopUpOrder>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/global.scss";

.orders-page {
    .top {
        .new-order {
            @extend .main-button;
            font-weight: bold;
            position: absolute;
            left: 0;
            display: inline-block;
            width: fit-content;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    }
}
</style>
