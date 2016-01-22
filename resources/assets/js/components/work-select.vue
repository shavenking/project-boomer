<template>
    <dropdown-select
        input-name="work_ids"
        :options="works"
        option-value-name="id"
        option-text-name="name"
        :multiple.once="true"
    ></dropdown-select>
</template>

<script>
    import DropdownSelect from './dropdown-select.vue'

    let getWorks = () => {
        return window.$.getJSON('/api/v1/works')
    }

    export default {
        components: { DropdownSelect },

        data() {
            return {
                works: []
            }
        },

        ready() {
            getWorks().then((response) => {
                this.works = response.works
            })
        }
    }
</script>
