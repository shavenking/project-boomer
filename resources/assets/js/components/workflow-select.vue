<template>
    <dropdown-select
        input-name="workflow_id"
        :options="workflows"
        option-value-name="id"
        option-text-name="name"
        v-ref:dropdown
    ></dropdown-select>
</template>

<script type="text/babel">
    import DropdownSelect from './dropdown-select.vue'

    function getWorkflows() {
        return window.$.getJSON('/api/v1/workflows')
    }

    export default {
        components: { DropdownSelect },

        props: ['default'],

        data() {
            return {
                workflows: []
            }
        },

        ready() {
            getWorkflows().then(response => {
                this.workflows = response.workflows

                if (this.default) {
                    this.$nextTick(() => {
                        this.$refs.dropdown.select(this.default)
                    })
                }
            })
        }
    }
</script>
