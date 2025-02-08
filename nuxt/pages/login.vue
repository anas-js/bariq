<script setup lang="ts">
const $auth = useAuth();
definePageMeta({
    login: true,
});

const loading = ref(false);

const login = ref({
    email: "kaled",
    password: "12345678",
});

const erros = ref({
    email: "",
    password: "",
});

async function userLogin() {
    loading.value = true;

    erros.value.email = "";
    erros.value.password = "";

    // error handling
    if (!login.value.email) {
        erros.value.email = "لا يمكن ترك هذل الحقل فارغاً";
    }

    if (!login.value.password) {
        erros.value.password = "لا يمكن ترك هذل الحقل فارغاً";
    }

    if (erros.value.email || erros.value.password) {
        return;
    }

    // login
    await $api
        .post(useAppConfig().BK_URL.api + "/login", {
            body: login.value,
        })
        .then((res) => {
            $auth.setUser(res as any);
            $auth.setLoginStatus(true);

            setTimeout(() => {
                navigateTo("/dashboard");
            }, 1500);
        })
        .catch((e) => {
            $errorViewer(erros.value, e.response._data.errors);
        });

    loading.value = false;
}
</script>

<template>
    <div class="login-page" :class="{ 'login-done': $auth.loggedIn }">
        <div class="rigth">
            <div ref="form" class="form">
                <img class="logo" src="~/assets/images/logo.svg" />

                <div v-if="!$auth.loggedIn" class="fields">
                    <div>
                        <label>اسم المستخدم او البريد الإلكتروني</label>
                        <input
                            v-model="login.email"
                            type="email"
                            name="email"
                            autocomplete="on"
                        />
                    </div>
                    <p class="err">{{ erros.email }}</p>

                    <div>
                        <label>كلمة المرور</label>
                        <input
                            v-model="login.password"
                            type="password"
                            name="password"
                        />
                    </div>
                    <p class="err">{{ erros.password }}</p>
                </div>

                <div class="actions">
                    <NuxtLink
                        v-if="!$auth.loggedIn"
                        class="forget-password"
                        to=""
                    >
                        نسيت كلمة المرور؟
                    </NuxtLink>

                    <button
                        :disabled="loading || $auth.loggedIn"
                        @click="userLogin()"
                        class="submit"
                    >
                        <template v-if="$auth.loggedIn"
                            >يا مرحبا {{ $auth.user?.name }}</template
                        >

                        <template v-else-if="loading"><Loading /></template>
                        <template v-else>تسجيل الدخول</template>
                    </button>

                    <img class="pattren" src="~/assets/images/pattren.svg" />
                </div>
            </div>
        </div>
        <div class="left">
            <!-- <img class="pattren" src="~/assets/images/pattren-big.svg" /> -->
        </div>
    </div>
</template>
