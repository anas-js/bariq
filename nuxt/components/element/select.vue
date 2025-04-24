<script setup lang="ts">
const emits = defineEmits(['select']);

const props = defineProps({
    list: Array<any>,
    current: {
        default: null,
        required: false,
        type: [String, Number,Array],
    },
    editable: {
        default: false,
        required: false,
        type: Boolean,
    },
    customeList: {
        default: false,
        required: false,
        type: Boolean,
    },
});

const currentSelect = ref(props.current);
const selectDOM = ref() as Ref<HTMLDivElement>;
const listActive = ref(false);
const inputEditable = ref() as Ref<HTMLInputElement>;
// const currentSelectHtml =

function selectCurrInCustome() {
    const copy = selectDOM.value
        .querySelector(`.list li[data-value="${currentSelect.value}"]`)
        ?.cloneNode(true);



    selectDOM.value.querySelector(`.input .currentSelectHtml`)!.innerHTML = "";
    selectDOM.value
        .querySelector(`.input .currentSelectHtml`)
        ?.appendChild(copy!);
}

onMounted(() => {
    if (props.customeList) {
        selectCurrInCustome();

        selectDOM.value
        .querySelectorAll(`.list li`).forEach((e : HTMLDivElement)=> {
            e.onclick = function () {
            //   console.log( );
            currentSelect.value = e.getAttribute('data-value') || 1;
            selectCurrInCustome();
            listActive.value = false;
            emits('select',currentSelect.value);
            };
        })
    } else if(props.editable) {
        // console.log( inputEditable.value);
        inputEditable.value.value = "1";

    }
    // console.log(props.current);
});

watch(
    () => props.current,
    (n) => {
        currentSelect.value = n;
        if (props.customeList) {
            selectCurrInCustome();
        }
    }
);

function showList() {
    // console.log('click');
    listActive.value = !listActive.value;
    // console.log(listActive.value);
}


// const l = [
//     {
//         title: "",
//         value: "1",
//     },
// ];
</script>

<template>
    <div ref="selectDOM" class="select-element">
        <div class="input" @click="showList">
            <template v-if="customeList">
                <div class="currentSelectHtml">1</div>
            </template>
            <template v-else>
                <input ref="inputEditable" v-if="editable" type="text" />
                <div v-else>
                    {{ list?.find((e) => e.value == currentSelect).name }}
                </div>
            </template>

            <span class="icon">
                <i class="ri-arrow-down-s-line"></i>
            </span>
        </div>
        <ul  v-if="customeList" class="list" :class="{ active: listActive }">
            <slot name="list"></slot>
        </ul>
        <ul v-if="listActive" class="list" :class="{ active: listActive }">
        <li v-for="item in list">{{ item.name }}</li>
        </ul>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
// @import "~/assets/styles/global.scss";
.select-element {
    position: relative;
    width: fit-content;
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
        .currentSelectHtml {
            list-style-type: none;
            cursor: pointer;
        }

        .icon {
            font-size: 20px;

            cursor: pointer;
            i {
                display: block;
            }
        }
    }

    .list {
        list-style-type: none;
        position: absolute;
        z-index: 10;
        width: 120px;
        right: 0;
        box-shadow: 0 5px 20px rgba($color: $color_black, $alpha: 0.03);
        background-color: $color_white;
        padding: 5px;
        border-radius: 20px;
        visibility: hidden;
        opacity: 0;
        transition: 0.3s;
        top: 90%;

        li {
            cursor: pointer;
            padding: 3px 10px;
        }
        // pointer-events: none;

        &.active {
            visibility: visible;
            opacity: 1;
        }
    }
}
</style>
