<template>
    <dropdown-select
        input-name="cost_type_id"
        :options="costTypes"
        option-value-name="id"
        option-text-name="name"
        v-ref:dropdown
    ></dropdown-select>
</template>

<script>
    import DropdownSelect from './dropdown-select.vue'

    function getTypes() {
        return window.$.getJSON('/api/v1/cost-types')
    }

    export default {
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
                costTypes: []
            }
        },

        ready() {
            getTypes().then(response => {
                this.costTypes = response.cost_types
            })
        }
    }
</script>
