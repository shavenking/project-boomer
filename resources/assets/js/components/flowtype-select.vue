<template>
    <div class="two fields">
        <div class="field">
            <dropdown-select
                input-name="mainflow_type_id"
                :options="mainflowTypes"
                option-value-name="id"
                option-text-name="name"
                @selected="onMainflowTypeSelected"
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

        methods: {
            onMainflowTypeSelected(mainflowTypeId) {
                getDetailingflowTypes(mainflowTypeId).then(response => {
                    this.detailingflowTypes = response.detailingflow_types

                    Vue.nextTick(() => {
                        this.$refs.detailingflowTypeSelect.$emit('optionsUpdated')
                    })
                })

                return false
            },
            onDetailingflowTypeSelected(detailingflowTypeId) {
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
            })
        }
    }
</script>
