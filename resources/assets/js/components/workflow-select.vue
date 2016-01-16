<template>
    <dropdown-select
        input-name="workflow_id"
        :options="workflows"
        option-value-name="id"
        option-text-name="name"
    ></dropdown-select>
</template>

<script>
    import DropdownSelect from './dropdown-select.vue'

    function getWorkflows() {
        return window.$.getJSON('/api/v1/workflows')
    }

    export default {
        components: { DropdownSelect },

        data() {
            return {
                workflows: []
            }
        },

        ready() {
            getWorkflows().then(response => {
                this.workflows = response.workflows
            })
        }
    }
</script>
