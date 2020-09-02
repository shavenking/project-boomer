<template>
    <div class="field">
        <dropdown-select
            input-name="mainflow_type_id"
            :options="mainflowTypes"
            option-value-name="id"
            option-text-name="name"
            v-ref:mainflow-type-select
        ></dropdown-select>
    </div>
</template>

<script type="text/babel">
    import Vue from 'vue'
    import DropdownSelect from './dropdown-select.vue'

    function getMainflowTypes() {
        return window.$.getJSON('/api/v1/mainflow-types')
    }

    export default {
        components: { DropdownSelect },

        props: ['mainDefault'],

        data() {
            return {
                mainflowTypes: []
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
