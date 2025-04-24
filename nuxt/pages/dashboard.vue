<script setup lang="ts"></script>

<template>
    <div class="dashboard-structure">
        <div class="list">
            <img class="logo" src="~/assets/images/logo.svg" />

            <nav class="links">
                <ul>
                    <li><NuxtLink to="/dashboard"><i class="ri-pie-chart-line"></i>لوحة التحكم</NuxtLink></li>
                    <li><NuxtLink to="/dashboard/orders"><i class="ri-archive-line"></i>الطلبات</NuxtLink></li>
                    <li><NuxtLink to="customers"><i class="ri-group-2-line"></i>العملاء</NuxtLink></li>
                    <li><NuxtLink><i class="ri-box-3-line"></i>الخدمات</NuxtLink></li>
                    <li><NuxtLink><i class="ri-t-shirt-2-line"></i>الأصناف</NuxtLink></li>
                    <li><NuxtLink><i class="ri-settings-4-line"></i>الإدارة</NuxtLink></li>
                </ul>
            </nav>
        </div>
        <div class="content">
            <div class="container">
                <NuxtPage class="page" />
            </div>
        </div>
    </div>
</template>
