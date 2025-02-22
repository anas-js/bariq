<script setup lang="ts">
const props = defineProps({
    list: Array<any>,
    current : {
        default : null,
        required : false,
        type:[String, Number]
    },
    editable : {
        default : false,
        required : false,
        type : Boolean
    },
    customeList : {
        default : false,
        required : false,
        type : Boolean
    },
});

const currentSelect = ref(props.current);



onMounted(() => {
    console.log(list.value)
});

const l = [
    {
        title : "",
        value: "1"
    }
];
</script>

<template>
    <div class="select-element">
        <div class="input">
          <template v-if="customeList">

          </template>
          <template v-else>
            <input v-if="editable" type="text" />
            <div v-else>{{ list?.find(e=>e.value==currentSelect) }}</div>
        </template>

            <span class="icon">
                <i class="ri-arrow-down-s-line"></i>
            </span>
        </div>
        <div>
        <slot name="list"></slot>
        </div>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
// @import "~/assets/styles/global.scss";
.select-element {
    .input {
        background: none;
        border: 2px $color_a solid;
        width: fit-content;
        border-radius: 14px;
        color: $color_a;
        display: flex;
        align-items: center;
        padding: 7px 10px;

        input {
            border: none;
            outline: none;
            color: $color_a;
            width: 100%;
            display: block;
            // padding: 7px 10px;
            font-size: 17px;
            box-sizing: border-box;
            // border-radius: 14px;

            &::placeholder {
                color: $color_white_c;
            }
        }

        .icon {
            font-size: 20px;

            cursor: pointer;
            i {
                display: block;
            }
        }
    }
}
</style>
