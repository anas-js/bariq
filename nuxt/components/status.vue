<script setup lang="ts">
const props = defineProps({
    status: {
        type: Number,
        required: true,
    },
});

const statusTitle = ["تم الإستلام", "تحت العمل", "جاهز", "تم التسليم", "ملغي"];
</script>

<template>
    <div class="status"  :class="{ ['s'+status]: status }">
        <span class="point"></span>
        <p>{{ statusTitle[status-1] }}</p>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
.status {
    p {
        display: inline-block;
    }
    span {
        width: 10px;
        height: 10px;
        display: inline-block;
        border-radius: 25px;
        margin-inline-end: 5px;
    }

    &.s1 {
        color: $color_yellow;

        span {
            background-color: $color_yellow;
        }
    }

    &.s2 {
        color: $color_sky;

        span {
            background-color: $color_sky;
        }
    }

    &.s3 {
        color: $color_blue;

        span {
            background-color: $color_blue;
        }
    }

    &.s4 {
        color: $color_green;

        span {
            background-color: $color_green;
        }
    }

    &.s5 {
        color: $color_red;

        span {
            background-color: $color_red;
        }
    }
}
</style>
