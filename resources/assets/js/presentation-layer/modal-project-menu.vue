<template>
    <button class="ui fluid button" @click="openMenu()">選單</button>

    <div class="ui basic modal" v-el:modal>
        <i class="close icon"></i>
        <div class="content">
            <slot></slot>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        methods: {
            openMenu() {
                this.menu.modal('show')
            }
        },
        data() {
            return {
                menu: {}
            }
        },
        ready() {
            this.menu = window.$(this.$els.modal)
        }
    }
</script>