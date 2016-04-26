<template>
    <dropdown-select
        input-name="subcontractor_id"
        :options="subcontractors"
        option-value-name="id"
        option-text-name="name"
        v-ref:dropdown
    ></dropdown-select>
</template>

<script>
    import DropdownSelect from './dropdown-select.vue'
    import { get } from '../query-helpers/subcontractors'

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
                subcontractors: []
            }
        },

        ready() {


            get().then(response => {
                this.subcontractors = response.subcontractors

                this.$nextTick(() => {
                    if (this.default) {
                        this.select(this.default)
                    }
                })
            })
        }
    }
</script>
