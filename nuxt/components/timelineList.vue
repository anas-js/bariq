<script setup lang="ts">
const el = ref() as Ref<HTMLElement>;

const emits = defineEmits(["select"]);
const active = ref(false);

const loading = ref(false);

const timeList = [
    {
        title: "اليوم",
        value: "0",
    },
    {
        title: "أمس",
        value: "1",
    },
    {
        title: "هذا الشهر",
        value: "m",
    },
    {
        title: "أخر 30 يوم",
        value: "30",
    },
    {
        title: "أخر سنة",
        value: "365",
    },
    {
        title: "جميع الأوقات",
        value: "all",
    },
    {
        title: "تحديد مدة زمنية",
        value: {
            start: "",
            end: "",
        },
    },
];

function close() {
    if (loading.value) {
        return;
    }
    active.value = false;
}

defineExpose({
    show() {
        active.value = true;
    },
    toggle() {
        if (loading.value) {
            return;
        }

        active.value = !active.value;
    },
    close,
    loading() {
        active.value = true;
        loading.value = true;


    },
    done() {
        loading.value = false;
        active.value = false;
        enterTimeObj.value.status = false;
        enterTimeObj.value.dir = "";

        close();
    },
});

// User Select Time From List
function selectTime(time: any) {
    if (typeof time.value === "object") {
        const element = enterTimeElement.value[0];
        if (
            element.parentElement!.getBoundingClientRect().left >
            element.clientWidth
        ) {
            enterTimeObj.value.dir = "left";
        } else {
            enterTimeObj.value.dir = "rigth";
        }
        enterTimeObj.value.status = true;
        return;
    }

    enterTimeObj.value.status = false;
    enterTimeObj.value.dir = "";
    loading.value = true;

    emits("select", {
        time,
        done() {
            loading.value = false;
            active.value = false;
            close();
        },
    });
}

// User Enter Time
const enterTimeObj = ref({
    status: false,
    dir: "",
});
const enterTimeElement = ref() as Ref<HTMLDivElement[]>;
const timeStart = ref("2025-10-10");
const timeEnd = ref("2025-10-20");
function enterTime() {
    if (timeStart.value > timeEnd.value) {
        $msg({
            text: "تاريخ البداية يجب ان يكون قبل تاريخ النهاية",
            type: "error",
        });
        return;
    }
    loading.value = true;

    emits("select", {
        time: {
            title: `${timeStart.value} - ${timeEnd.value}`,
            value: {
                start: timeStart.value,
                end: timeEnd.value,
            },
        },
        done() {
            loading.value = false;
            active.value = false;
            enterTimeObj.value.status = false;
            enterTimeObj.value.dir = "";

            close();
        },
    });
}

// Event List
let handleClickOutSide: any = null;
onMounted(() => {
    handleClickOutSide = (event: any) => {
        // @ts-ignore
        if (!el.value.parentElement!.contains(event.target)) {
            close();
        }
    };
    document.addEventListener("click", handleClickOutSide);
});

onUnmounted(() => {
    document.removeEventListener("click", handleClickOutSide);
});
</script>

<template>
    <div ref="el" class="timeline-list" :class="{ active: active }">
        <Loading v-if="loading" />
        <ul v-else>
            <li
                v-for="(time, index) in timeList"
                :index="index"
                :class="{ selectTimes: typeof time.value === 'object' }"
                @click="selectTime(time)"
            >
                {{ time.title }}

                <template v-if="typeof time.value === 'object'">
                    <i class="icon ri-arrow-drop-left-line"></i>
                    <div
                        ref="enterTimeElement"
                        class="select-date"
                        :class="{
                            active: enterTimeObj.status,
                            left: enterTimeObj.dir === 'left',
                            rigth: enterTimeObj.dir === 'rigth',
                        }"
                    >
                        <div>
                            <label>من</label>
                            <input v-model="timeStart" type="date" />
                        </div>
                        <div>
                            <label>الى</label>
                            <input v-model="timeEnd" type="date" />
                        </div>
                        <button @click="enterTime">تم</button>
                    </div>
                </template>
            </li>
        </ul>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/global.scss";
.timeline-list {
    position: absolute;
    z-index: 10;
    width: 120px;
    left: 0;
    box-shadow: 0 5px 20px rgba($color: $color_black, $alpha: 0.03);
    background-color: $color_white;
    padding: 5px;
    border-radius: 20px;
    visibility: hidden;
    opacity: 0;
    transition: 0.3s;
    top: 90%;
    pointer-events: none;

    &.active {
        visibility: visible;
        opacity: 1;
        top: 100%;
        pointer-events: all;
    }
    svg {
        fill: $color_a !important;
    }

    ul {
        list-style-type: none;
        color: $color_a;

        li {
            transition: 0.3s;
            padding: 10px;
            position: relative;
            border-radius: 13px;
            .icon {
                transition: 0.3s;

                visibility: hidden;
                opacity: 0;
            }
            &:hover {
                background-color: $color_backgroud;

                .icon {
                    visibility: visible;
                    opacity: 1;
                }
            }

            .select-date {
                position: absolute;
                background-color: $color_white;
                box-shadow: 0 5px 20px rgba($color: $color_black, $alpha: 0.03);
                padding: 10px;
                right: 0;
                top: 50%;
                transform: translateY(-50%);
                border-radius: 13px;
                display: flex;
                gap: 5px;
                opacity: 0;
                visibility: hidden;
                transition: 0.3s;
                // pointer-events: none;

                input {
                    @extend .main-input;
                }
                button {
                    @extend .main-button;
                    cursor: pointer;
                }

                &.active {
                    opacity: 1;
                    visibility: visible;
                    // pointer-events: all;
                    // transform: translateY(-50%) translateX(-100%);
                }

                &.left {
                    right: calc(100% + 10px);
                }

                &.rigth {
                    right: -10px;
                    transform: translateY(-50%) translateX(100%);
                }
            }

            // &.selectTimes:hover {

            //     .select-date {

            // }
            // }
        }
    }
}
</style>
