<template>
    <dropdown-select
        input-name="unit_id"
        :options="units"
        option-value-name="id"
        option-text-name="name"
        v-ref:dropdown
    ></dropdown-select>
</template>

<script type="text/babel">
    import DropdownSelect from './dropdown-select.vue'

    function getUnits() {
        return window.$.getJSON('/api/v1/units')
    }

    export default {
        props: ['default'],

        components: { DropdownSelect },

        methods: {
            select(value) {
                this.$refs.dropdown.select(value)
            },
            clear() {
                this.$refs.dropdown.clear()
            }
        },

        data() {
            return {
                units: []
            }
        },

        ready() {


            getUnits().then(response => {
                this.units = response.units

                this.$nextTick(() => {
                    if (this.default) {
                        this.select(this.default)
                    }
                })
            })
        }
    }
</script>
