<script setup lang="ts">
const emits = defineEmits(["select"]);

const props = defineProps({
    customer: Object as any,
});

// const currentSelect = ref(props.current);

const loading = ref(true);
const items = ref([]);
const el = ref() as Ref<HTMLDivElement>;
const listActive = ref(false);

const selectItem = ref(0);
const itemSearch = ref(items.value);


// items.value.find(e=>e.id=selectItem.value)
const input = ref('');
const inputDOM = ref() as Ref<HTMLInputElement>;

// const currentSelectHtml =




onUnmounted(() => {
    document.removeEventListener("click", handleClickOutSide);
});

onMounted(() => {
    selectItem.value = props.customer?.id;
    input.value = props.customer?.name;
    // console.log(props.item);
    // if (props.customeList) {
    //     selectDOM.value
    //     .querySelectorAll(`.list li`).forEach((e : HTMLDivElement)=> {
    //         e.onclick = function () {
    //         currentSelect.value = e.getAttribute('data-value') || 1;
    //         listActive.value = false;
    //         emits('select',currentSelect.value);
    //         };
    //     })
    // } else {
    //     inputEditable.value.value = "1";
    // }
});

// watch(
//     () => props.current,
//     (n) => {
//         currentSelect.value = n;
//         if (props.customeList) {

//         }
//     }
// );

// function showList() {
//     listActive.value = true;
// }



function focusSearch() {
    // loading.value =
    // input.value = "";
    listActive.value = true;

    if(!items.value.length) {
        $api.get($app().BK_URL.api+'/customers').then(res=>{
        //  console.log(res);
        loading.value = false;
        items.value = res;
        itemSearch.value = res;
    });
    }

    // serviceAvailable.value = props.item.service_available;
}

function blurSearch() {

    // if(loading.value) {
    //     return;
    // }
    // input.value = '';
    // serviceAvailable.value = props.item.service_available;
    listActive.value = false;
    // console.log('b');
    // console.log('blur');
}

function search() {
    // serviceAvailable
    // serviceAvailable.value = props.item.service_available;
    // serviceAvailable.value = serviceAvailable.value.filter(e=>e.name.includes(input.value))
    // if(input.value) {

    // }

}

function select(item :any) {
    selectItem.value = item.id;
    listActive.value = false;
    input.value = item.name;

    // loading.value =true;


    emits('select',item);
    // console.log(item.name);


    // console.log(selectItem.value);
    // console.log(item);
    // const isFind = selectServers.value.find((e) => e.id == serv.id);

    // if(isFind && selectServers.value.length === 1) {
    //     $msg({
    //         text : "أقل شي خدمة واحدة",
    //         type : "error"
    //     });
    //     return;
    // }

    // if(isFind) {
    //     selectServers.value = selectServers.value.filter((e) => e.id !== serv.id);
    // } else {
    //     selectServers.value.push({
    //         id: serv.id,
    //         name : serv.name
    //     });


    // }
    // calcTotal();
    // blurSearch();
}

// Event List
let handleClickOutSide: any = null;
onMounted(() => {
    handleClickOutSide = (event: any) => {
        // @ts-ignore
        if (!el?.value?.contains(event.target)) {
             blurSearch();
        }
    };
    document.addEventListener("click", handleClickOutSide);
});
</script>

<template>
    <div ref="el" class="select-element-items">
        <div class="input">
            <input
                @input="search"
                @focus="focusSearch"

                v-model="input"
                ref="inputDOM"
                type="text"
            />
            <!-- <div v-else>
                {{ list?.find((e) => e.value == currentSelect) }}
            </div> -->

            <span class="icon" @click="focusSearch()">
                <i class="ri-arrow-down-s-line"></i>
            </span>
        </div>
        <ul v-if="listActive" class="list" :class="{ active: listActive }">

            <li
            @click="select(item)"
                v-for="item in itemSearch"
                :class="{select:(item.id==selectItem)}"
                v-if="!loading"
            >
            <div class="title">
                <span class="box-select" >
                    <i
                        v-if="(item.id==selectItem)"
                        class="ri-check-line"
                    ></i>

                    <i v-else class="ri-t-shirt-2-line"></i>
                </span>
                {{ item.name }}
            </div>
            <!-- <p>{{ serv.amount }} ريال</p> -->
            </li>

            <li v-if="loading"><Loading /></li>
            <li v-else-if="!itemSearch.length">لا يوجد أصناف</li>

        </ul>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
// @import "~/assets/styles/global.scss";
.select-element-items {
    position: relative;
    width: fit-content;
    width: 100%;
    background-color: $color_white;

    .input {
        background: none;
        border: 2px $color_a solid;
        width: fit-content;
        border-radius: 14px;
        color: $color_a;
        display: flex;
        align-items: center;
        padding: 7px 10px;
        width: 100%;
        box-sizing: border-box;

        input {
            border: none;
            outline: none;
            color: $color_a;
            width: 100% !important;
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

    .list {
        list-style-type: none;
        position: absolute;
        z-index: 10;
        width: 100%;
        right: 0;
        box-shadow: 0 5px 20px rgba($color: $color_black, $alpha: 0.03);
        background-color: $color_white;
        padding: 5px;
        border-radius: 20px;
        visibility: hidden;
        opacity: 0;
        transition: 0.3s;

        max-height: 120px;
        overflow: auto;
        min-height: 40px;
        top: auto;
        bottom: 107%;

        .loading {
            svg {
                fill: $color_a;
            }
        }

        li {
            cursor: pointer;
            padding: 3px 10px;
            display: flex;
            // justify-content: center;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            color: $color_a;

            .title {
                margin-left: 10px;
                .box-select {
                pointer-events: none;
                display: inline-block;
                padding: 5px;
                border-radius: 11px;
                font-size: 20px;
                background-color: $color_a;

                color: $color_backgroud;

                i {
                    display: block;
                }
            }
            }


            &.select {
                font-weight: bold;
                .box-select {
                    background-color: $color_backgroud;
                    color: $color_a;
                }
            }
        }
        // pointer-events: none;

        &.active {
            visibility: visible;
            opacity: 1;
        }
    }
}
</style>
