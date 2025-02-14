<template>
    <div class="pop-up">
        <div class="box">
            <div class="title">
                <div class="slot">
                    <slot name="title"></slot>
                </div>
                <button class="close"><i class="ri-close-line"></i></button>
            </div>
            <slot></slot>
            <div class="buttons">
               <slot name="buttons"></slot>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
@import "~/assets/styles/colors.scss";
@import "~/assets/styles/global.scss";
.pop-up {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba($color: $color_black, $alpha: 0.05);
    backdrop-filter: blur(10px);
    z-index: 100;
    left: 0;
    top: 0;

    .box {
        bottom: 0;
        width: 550px;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        background-color: $color_white;
        padding: 30px 40px;
        padding-bottom: 14px;
        border-radius: 70px 70px 0 0 ;

        > {
            .title {
                position: relative;

                .slot {
                    h1 {
                        color: $color_a;
                        // font-size: ;
                    }
                }

                .close {
                    position: absolute;
                    left: 0;
                    top: 50%;
                    transform: translateY(-50%);
                    @extend .main-button;
                    width: fit-content;
                    color: $color_a;
                    padding: 5px;
                    border-radius: 10px;
                    font-size: 17px;

                    i {
                        display: block;
                    }
                    background-color:rgba($color: $color_a, $alpha: 0.2);
                }
            }

            .buttons {
                margin-top: 20px;
                display: flex;
                gap: 10px;

                > * {
                    width: 100%;
                    font-weight: bold;
                    @extend .main-button;
                    text-align: right;
                    padding-right: 20px;
                    vertical-align: middle;
                    i {
                        margin-inline-end: 7px;
                        vertical-align: middle;
                        font-weight: normal;
                        font-size: 23px;

                    }

                    &.second {
                        background-color: $color_backgroud;
                        color: $color_a;
                    }

                    &.cancel {
                        background-color: $color_backgroud;
                        color: $color_a;
                    }
                }
            }
        }
    }
}
</style>
