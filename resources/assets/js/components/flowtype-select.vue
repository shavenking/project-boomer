<template>
    <div class="two fields">
        <div class="field">
            <dropdown-select
                input-name="mainflow_type_id"
                :options="mainflowTypes"
                option-value-name="id"
                option-text-name="name"
                @selected="onMainflowTypeSelected"
                v-ref:mainflow-type-select
            ></dropdown-select>
        </div>
        <div class="field">
            <dropdown-select
                input-name="detailingflow_type_id"
                :options="detailingflowTypes"
                option-value-name="id"
                option-text-name="name"
                @selected="onDetailingflowTypeSelected"
                v-ref:detailingflow-type-select
            ></dropdown-select>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import DropdownSelect from './dropdown-select.vue'

    function getMainflowTypes() {
        return window.$.getJSON('/api/v1/mainflow-types')
    }

    function getDetailingflowTypes(mainflowTypeId) {
        return window.$.getJSON(`/api/v1/mainflow-types/${mainflowTypeId}/detailingflow-types`)
    }

    export default {
        components: { DropdownSelect },

        props: ['onSelected', 'mainDefault', 'detailDefault'],

        methods: {
            onMainflowTypeSelected(mainflowTypeId) {
                getDetailingflowTypes(mainflowTypeId).then(response => {
                    this.detailingflowTypes = response.detailingflow_types

                    this.$nextTick(() => {
                        this.$refs.detailingflowTypeSelect.$emit('optionsUpdated')

                        if (this.detailDefault) {
                            this.$nextTick(() => {
                                this.$refs.detailingflowTypeSelect.select(this.detailDefault)
                            })
                        }
                    })
                })

                return false
            },
            onDetailingflowTypeSelected(detailingflowTypeId) {
                if (this.onSelected) {
                    this.onSelected(detailingflowTypeId)
                }

                return false
            }
        },

        data() {
            return {
                mainflowTypes: [],
                detailingflowTypes: []
            }
        },

        ready() {
            getMainflowTypes().then(response => {
                this.mainflowTypes = response.mainflow_types

                if (this.mainDefault) {
                    this.$nextTick(() => {
                        this.$refs.mainflowTypeSelect.select(this.mainDefault)
                    })
                }
            })
        }
    }
</script>
