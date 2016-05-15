<template>
    <div class="field">
        <label>{{ selectTypeOrderLabel }}</label>
        <flowtype-select :on-selected.once="onFlowtypeSelected"></flowtype-select>
    </div>
    <div class="field">
        <label>{{ selectWorkLabel }}</label>
        <dropdown-select
            input-name="work_id"
            :options="works"
            option-value-name="id"
            option-text-name="name"
            :multiple.once="false"
            v-ref:work-select
        ></dropdown-select>
    </div>
</template>

<script>
    import FlowtypeSelect from './flowtype-select.vue'
    import DropdownSelect from './dropdown-select.vue'

    function getWorks(detailingflowTypeId) {
        if (!detailingflowTypeId) {
            return window.$.getJSON('/api/v1/works')
        }

        return window.$.getJSON(`/api/v1/works?detailingflow_type_id=${detailingflowTypeId}`)
    }

    export default {
        props: ['selectTypeOrderLabel', 'selectWorkLabel'],

        components: { FlowtypeSelect, DropdownSelect },

        methods: {
            onFlowtypeSelected(detailingflowTypeId) {
                if (!detailingflowTypeId) {
                    return false
                }

                getWorks(detailingflowTypeId).then(response => {
                    this.works = response.works

                    this.$nextTick(() => {
                        this.$refs.workSelect.$emit('optionsUpdated')
                    })
                })
            }
        },

        data() {
            return {
                works: []
            }
        },

        ready() {
            getWorks().then(response => {
                this.works = response.works
            })
        }
    }
</script>
