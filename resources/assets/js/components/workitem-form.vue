<template>
    <form class="ui form" @submit.prevent="onSubmit">
        <div class="field">
            <label>{{ labels.unit }}</label>
            <unit-select v-ref:unit-select></unit-select>
        </div>
        <div class="field">
            <label>{{ labels.costType }}</label>
            <cost-type-select v-ref:cost-type-select></cost-type-select>
        </div>
        <div class="field">
            <label>{{ labels.order }}</label>
            <input type="text" name="order" v-model="item.order">
        </div>
        <div class="field">
            <label>{{ labels.name }}</label>
            <input type="text" name="name" v-model="item.name">
        </div>
        <div class="field">
            <label>{{ labels.amount }}</label>
            <input type="text" name="amount" v-model="item.amount">
        </div>
        <div class="field">
            <label>{{ labels.unitPrice }}</label>
            <input type="text" name="unit_price" v-model="item.unit_price">
        </div>

        <button type="submit" class="ui primary button">{{ isEditing ? labels.update : labels.create }}</button>
        <button type="button" class="ui button" @click="clearForm">{{ isEditing ? labels.cancel : labels.clear }}</button>
    </form>
</template>

<script>
    import UnitSelect from './unit-select.vue'
    import CostTypeSelect from './cost-type-select.vue'
    import pluck from 'lodash/collection/pluck'
    import zipObject from 'lodash/array/zipObject'
    import merge from 'lodash/object/merge'

    export default {
        components: { UnitSelect, CostTypeSelect },

        props: {
            labels: {
                required: true,
                type: Object
            }
        },

        computed: {
            isEditing() {
                return this.item['id']
            }
        },

        methods: {
            onSubmit() {
                const inputs = this._form.serializeArray()

                const item = zipObject(pluck(inputs, 'name'), pluck(inputs, 'value'))

                if (this.isEditing) {
                    this.$parent.$emit('update', merge(item, {
                        id: this.item.id
                    }))
                } else {
                    this.$parent.$emit('create', item)
                }
            },
            clearForm() {
                this.$refs.unitSelect.clear()
                this.$refs.costTypeSelect.clear()

                this.item = {}
            }
        },

        events: {
            edit(item) {
                this.item = merge({}, item)

                this.$refs.unitSelect.select(item.unit.id)
                this.$refs.costTypeSelect.select(item.cost_type.id)
            },
            created(item) {
                this.clearForm()
            },
            updated(item) {
                this.clearForm()
            }
        },

        data() {
            return {
                item: {}
            }
        },

        ready() {
            this._form = window.$(this.$el)
        }
    }
</script>
