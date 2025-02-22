<script setup lang="ts">
const props = defineProps({
    data : {
        type : Array<any>,
        required : true
    }
});
</script>
<template>
    <div class="table">
        <div class="column">
                <slot name="column"></slot>
        </div>
        <div class="row" v-for="row in data">
            <slot name="row" :row="row"></slot>
        </div>

        <slot name="content"></slot>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
.table {
    width: 100%;
    background-color: $color_white;
    padding: 30px;
    // border-collapse:collapse;
    border-radius: 37.92px;
    box-sizing: border-box;

    > * {
        display: flex;
        justify-content: space-between;
        // padding: 0 40px;

        > * {
            width: 100%;
            text-align: center;
            &:first-child,&:last-child {
            width: 50%;
        }
        }



    }

    .column {
        color: $color_b;
        font-size: 14px;
    }

    .row {
        padding: 20px 0px;
        margin-top: 10px;
        background-color: $color_backgroud;
        border-radius: 20px;

    }
}
</style>
