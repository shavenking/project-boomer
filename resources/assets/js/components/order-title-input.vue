<template>
    <input type="text" v-model="orderTitle" v-on:keypress.enter="onKeypress">
</template>

<script>
    let regex = /^([0-9]+)\.\s*(\S.*)/

    export default {
        data() {
            return {
                orderTitle: ''
            }
        },

        methods: {
            onKeypress(e) {
                if (this.isValid) {
                    return this.$dispatch('valid', this.dataBag)
                }

                return this.$dispatch('invalid')
            }
        },

        events: {
            nodeCreated() {
                this.orderTitle = ''
            }
        },

        computed: {
            isValid() {
                return regex.test(this.orderTitle)
            },
            order() {
                if (this.isValid) {
                    return parseInt(this.orderTitle.split(regex).filter(Boolean)[0], 10)
                }

                return null
            },
            title() {
                if (this.isValid) {
                    return this.orderTitle.split(regex).filter(Boolean)[1]
                }

                return null
            },
            dataBag() {
                return {
                    order: this.order,
                    title: this.title
                }
            }
        }
    }
</script>
