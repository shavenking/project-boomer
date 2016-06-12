<template>
    <input type="text" :name.once="name" v-el:input>
</template>

<script>
    export default {
        props: ['name'],

        ready() {
            window.$(this.$els.input).pickadate({
                close: '關閉',
                format: 'yyyy-mm-dd',
                formatSubmit: 'yyyy-mm-dd',
                hiddenName: true
            })
        }
    }
</script>
