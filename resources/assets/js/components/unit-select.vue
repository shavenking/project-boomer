<template>
    <dropdown-select
        input-name="unit_id"
        :options="units"
        option-value-name="id"
        option-text-name="name"
    ></dropdown-select>
</template>

<script>
    import DropdownSelect from './dropdown-select.vue'

    function getUnits() {
        return window.$.getJSON('/api/v1/units')
    }

    export default {
        components: { DropdownSelect },

        data() {
            return {
                units: []
            }
        },

        ready() {
            getUnits().then(response => {
                this.units = response.units
            })
        }
    }
</script>
