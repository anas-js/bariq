<script setup lang="ts">
const emits = defineEmits(["select",'priceChange']);

const props = defineProps({
    item: Object as any,
});

// const currentSelect = ref(props.current);
const el = ref() as Ref<HTMLDivElement>;
const listActive = ref(false);

const selectServers = ref(props.item?.item_servers);
const serviceAvailable = ref(props.item?.service_available);

const input = ref(selectServers.value?.map((e) => e.name).join(" و "));
const inputDOM = ref() as Ref<HTMLInputElement>;



watch(()=>props.item,(item) => {
    selectServers.value = item.item_servers;
    serviceAvailable.value = item.service_available;
    // console.log('chcange');
})


// console.log(selectServers.value,serviceAvailable.value);
// const currentSelectHtml =




onUnmounted(() => {
    document.removeEventListener("click", handleClickOutSide);
});

onMounted(() => {
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


function calcTotal() {
    let total = 0;
    selectServers.value.forEach((s) => {
       const ser = serviceAvailable.value.find((sa)=>sa.id===s.id);
       total+=+ser.amount;

    });

    total =total * props.item.quantity;

     props.item.amount = total;

    emits('priceChange',total);

    // console.log();

}

function focusSearch() {
    input.value = "";
    listActive.value = true;
    serviceAvailable.value = props.item.service_available;
}

function blurSearch() {
    input.value = selectServers.value?.map((e) => e.name).join(" و ");
    serviceAvailable.value = props.item?.service_available;
    listActive.value = false;
    // console.log('blur');
}

function search() {
    // serviceAvailable
    serviceAvailable.value = props.item.service_available;
    serviceAvailable.value = serviceAvailable.value.filter(e=>e.name.includes(input.value))
    // if(input.value) {

    // }

}

function select(serv :any) {
    const isFind = selectServers.value.find((e) => e.id == serv.id);

    if(isFind && selectServers.value.length === 1) {
        $msg({
            text : "أقل شي خدمة واحدة",
            type : "error"
        });
        return;
    }

    if(isFind) {
        selectServers.value = selectServers.value.filter((e) => e.id !== serv.id);
    } else {
        selectServers.value.push({
            id: serv.id,
            name : serv.name
        });


    }
 emits('select',selectServers.value);
    // console.log(selectServers.value);
    calcTotal();
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

defineExpose({
    calcTotal
});
</script>

<template>
    <div ref="el" class="select-element">
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

            <span class="icon">
                <i class="ri-arrow-down-s-line"></i>
            </span>
        </div>
        <ul v-if="listActive" class="list" :class="{ active: listActive }">
        <!-- <li>1</li> -->
            <li
            @click="select(serv)"
                v-for="serv in serviceAvailable"
                :class="{ select: selectServers.find((e) => e.id == serv.id) }"
            >
            <div class="title">
                <span class="box-select">
                    <i
                        v-if="selectServers.find((e) => e.id == serv.id)"
                        class="ri-check-line"
                    ></i>
                    <i v-else class="ri-box-3-line"></i>
                </span>
                {{ serv.name }}
            </div>
            <p>{{ serv.amount }} ريال</p>
            </li>
            <li v-if="!serviceAvailable?.length">لا يوجد خدمات</li>
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
        width: max-content;
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
            display: flex;
            // justify-content: center;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;

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
