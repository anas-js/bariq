<script setup lang="ts">

const login = ref({
    email : "",
    password: ""
});

const erros = ref({
    email : "",
    password: ""
});

</script>

<template>
    <div class="login-page">
        <div class="rigth">
            <div ref="form" class="form">
                <img class="logo" src="~/assets/images/logo.svg" />

                <div class="fields">
                    <div>
                        <label>اسم المستخدم او البريد الإلكتروني</label>
                        <input
                            v-model="login.email"
                            type="email"

                            name="email"

                            autocomplete="on"
                        />
                    </div>
                    <p class="err">{{erros.email}}</p>

                    <div>
                        <label>كلمة المرور</label>
                        <input
                            v-model="login.password"
                            type="password"

                            name="password"
                        />
                    </div>
                    <p class="err">{{erros.password}}</p>
                </div>

                <div class="actions">
                    <NuxtLink class="forget-password" to="">
                        نسيت كلمة المرور؟
                    </NuxtLink>

                    <button class="submit">تسجيل الدخول</button>
                    <img class="pattren" src="~/assets/images/pattren.svg" />
                </div>
            </div>
        </div>
        <div class="left">
        <img class="pattren" src="~/assets/images/pattren-big.svg" />
        </div>
    </div>
</template>
