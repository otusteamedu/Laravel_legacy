<template lang="pug">
    .carousel-3d-slide( :style="slideStyle" :class="computedClasses" @click="goTo()")
        slot(:index="index" :isCurrent="isCurrent" :leftIndex="leftIndex" :rightIndex="rightIndex")
        transition(name="fade" mode="out-in")
            .carousel-3d-slide__overlay(v-show="isCurrent")
                .carousel-3d-slide__new-price(v-if="newPrice")
                    span {{ newPrice }} ₽/м<sup>2</sup>
                .carousel-3d-slide__bottom
                    span.uk-h3 {{ title }}
                    .carousel-3d-slide__info
                        span.carousel-3d-slide__info-item
                            span.carousel-3d-slide__info-name Ширина:
                            span.carousel-3d-slide__info-value {{ width }} см
                        span.carousel-3d-slide__info-item
                            span.carousel-3d-slide__info-name Цена, м<sup>2</sup>:
                            span.carousel-3d-slide__info-value(
                                :class="{ 'old-price': newPrice }"
                            ) {{ price }} ₽
</template>

<script>
    export default {
        name: 'slide',
        props: {
            index: {
                type: Number
            },
            width: {
                type: Number
            },
            title: {
                type: String
            },
            price: {
                type: Number
            },
            newPrice: {
                type: Number,
                default: null
            }
        },
        data () {
            return {
                parent: this.$parent,
                styles: {},
                zIndex: 999
            }
        },
        computed: {
            isCurrent () {
                return this.index === this.parent.currentIndex
            },
            leftIndex () {
                return this.getSideIndex(this.parent.leftIndices)
            },
            rightIndex () {
                return this.getSideIndex(this.parent.rightIndices)
            },
            slideStyle () {
                let styles = {}

                if (!this.isCurrent) {
                    const lIndex = this.leftIndex
                    const rIndex = this.rightIndex
                    if (rIndex >= 0 || lIndex >= 0) {
                        styles = rIndex >= 0 ? this.calculatePosition(rIndex, true, this.zIndex) : this.calculatePosition(lIndex, false, this.zIndex)
                        styles.opacity = 1
                        styles.visibility = 'visible'
                    }

                    if (this.parent.hasHiddenSlides) {
                        if (this.matchIndex(this.parent.leftOutIndex)) {
                            styles = this.calculatePosition(this.parent.leftIndices.length - 1, false, this.zIndex)
                        } else if (this.matchIndex(this.parent.rightOutIndex)) {
                            styles = this.calculatePosition(this.parent.rightIndices.length - 1, true, this.zIndex)
                        }
                    }
                }

                return Object.assign(styles, {
                    'border-width': this.parent.border + 'px',
                    'width': this.parent.slideWidth + 'px',
                    'height': this.parent.slideHeight + 'px',
                    'transition': ' transform ' + this.parent.animationSpeed + 'ms, ' +
                        '               opacity ' + this.parent.animationSpeed + 'ms, ' +
                        '               visibility ' + this.parent.animationSpeed + 'ms'
                })
            },
            computedClasses () {
                return {
                    [`left-${this.leftIndex + 1}`]: this.leftIndex >= 0,
                    [`right-${this.rightIndex + 1}`]: this.rightIndex >= 0,
                    'current': this.isCurrent
                }
            }
        },
        methods: {
            getSideIndex (array) {
                let index = -1

                array.forEach((pos, i) => {
                    if (this.matchIndex(pos)) {
                        index = i
                    }
                })

                return index
            },
            matchIndex (index) {
                return (index >= 0) ? this.index === index : (this.parent.total + index) === this.index
            },
            calculatePosition (i, positive, zIndex) {
                const z = !this.parent.disable3d ? parseInt(this.parent.inverseScaling) + ((i) * 200) : 0
                const y = !this.parent.disable3d ? parseInt(this.parent.perspective) : 0
                const leftRemain = (this.parent.space === 'auto')
                    ? parseInt((i + 1) * (this.parent.width / 1.5), 10)
                    : parseInt((i + 1) * (this.parent.space), 10)
                const transform = (positive)
                    ? 'translateX(' + (leftRemain) + 'px) translateZ(-' + z + 'px) ' +
                    'rotateY(0)'
                    : 'translateX(-' + (leftRemain) + 'px) translateZ(-' + z + 'px) ' +
                    'rotateY(0)'
                const top = this.parent.space === 'auto' ? 0 : parseInt((i + 1) * (this.parent.space))

                return {
                    transform: transform,
                    top: top,
                    zIndex: zIndex - (Math.abs(i) + 1)
                }
            },
            goTo () {
                if (!this.isCurrent) {
                    if (this.parent.clickable === true) {
                        this.parent.goFar(this.index)
                    }
                } else {
                    this.parent.onMainSlideClick()
                }
            }
        }
    }
</script>

<style lang="scss">
    /*.carousel-3d-slide {*/
    /*    position: absolute;*/
    /*    opacity: 0;*/
    /*    visibility: hidden;*/
    /*    overflow: hidden;*/
    /*    top: 0;*/
    /*    border-radius: 1px;*/
    /*    border-color: #000;*/
    /*    border-color: rgba(0, 0, 0, 0.4);*/
    /*    border-style: solid;*/
    /*    background-size: cover;*/
    /*    background-color: #ccc;*/
    /*    display: block;*/
    /*    margin: 0;*/
    /*    box-sizing: border-box;*/
    /*}*/

    /*.carousel-3d-slide {*/
    /*    text-align: left;*/
    /*}*/

    /*.carousel-3d-slide img {*/
    /*    width: 100%;*/
    /*}*/

    /*.carousel-3d-slide.current {*/
    /*    opacity: 1 !important;*/
    /*    visibility: visible !important;*/
    /*    transform: none !important;*/
    /*    z-index: 999;*/
    /*}*/
    @import '../../../../sass/uikit/variables-theme';
    @import '../../../../sass/variables';

    .carousel-3d-slide {
        position: absolute;
        opacity: 0;
        visibility: hidden;
        overflow: hidden;
        top: 0;
        border-radius: 1px;
        border-color: #000;
        border-color: rgba(0, 0, 0, 0.4);
        border-style: solid;
        background-size: cover;
        display: block;
        margin: 0;
        box-sizing: border-box;
        text-align: center;
        padding: $global-small-margin $global-small-gutter $global-margin;
        background: transparent;
        &.current {
            opacity: 1 !important;
            visibility: visible !important;
            transform: none !important;
            z-index: 999;
        }
        figure {
            border: 1px solid white;
            box-shadow: $global-medium-box-shadow;
        }
        img {
            width: 100%;
        }
        &__overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            padding: $global-small-margin $global-small-gutter $global-margin;
            z-index: 10;
            display: flex;
            flex-direction: column;
            /*justify-content: space-between;*/
            align-items: center;
        }
        &__new-price {
            padding: $global-small-margin $global-small-gutter;
            background: $global-primary-background;
            color: $global-inverse-color;
            font-weight: normal;
            font-size: $global-medium-font-size;
            line-height: 1;
        }
        &__bottom {
            margin-top: auto;
        }
        &__info {
            padding-bottom: $global-margin;
            &-item {
                &:not(:first-child) {
                    margin-left: $global-small-margin;
                }
            }
            &-value {
                font-weight: $base-strong-font-weight;
                margin-left: $global-small-margin / 2;
                &.old-price {
                    text-decoration: line-through;
                }
            }
        }
    }

</style>
