<template>
    <div class="field">
        <flowtype-select :on-selected.once="onFlowtypeSelected"></flowtype-select>
    </div>
    <div class="field">
        <dropdown-select
            :input-name.once="workFieldName"
            :options="works"
            option-value-name="id"
            option-text-name="name"
            :multiple.once="isMultiple"
            v-ref:work-select
        ></dropdown-select>
    </div>
</template>

<script type="text/babel">
    import FlowtypeSelect from './flowtype-select.vue'
    import DropdownSelect from './dropdown-select.vue'
    import { getProjectWorks } from '../query-helpers/project-works.js'

    export default {
        props: ['projectId', 'multiple'],

        components: { FlowtypeSelect, DropdownSelect },

        computed: {
            isMultiple() {
                return !!this.multiple
            },
            workFieldName() {
                return this.isMultiple ? 'work_ids' : 'work_id'
            }
        },

        methods: {
            onFlowtypeSelected(detailingflowTypeId) {
                if (!detailingflowTypeId) {
                    return false
                }

                getProjectWorks(this.projectId, {
                    detailingflow_type_id: detailingflowTypeId
                }).then(response => {
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
            getProjectWorks(this.projectId, {}).then(response => {
                this.works = response.works
            })
        }
    }
</script>
