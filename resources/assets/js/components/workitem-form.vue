<template>
    <form class="ui form" @submit.prevent="onSubmit">
        <div class="ui dividing header">{{ isEditing ? item.name : '新增工料項目' }}</div>
        <div class="field">
            <label>名稱</label>
            <input type="text" name="name" v-model="item.name">
        </div>
        <div class="field">
            <label>數量</label>
            <input type="text" name="amount" v-model="item.amount">
        </div>
        <div class="field">
            <label>單價</label>
            <input type="text" name="unit_price" v-model="item.unit_price">
        </div>
        <div class="field">
            <label>單位</label>
            <unit-select v-ref:unit-select></unit-select>
        </div>
        <div class="field">
            <label>費用分類</label>
            <cost-type-select v-ref:cost-type-select></cost-type-select>
        </div>
        <button type="submit" class="ui primary button"><i class="plus icon"></i>{{ isEditing ? '儲存' : '新增' }}</button>
        <button type="button" class="ui button" @click="clearForm">{{ isEditing ? '取消' : '重填' }}</button>
        <slot></slot>
    </form>
</template>

<script type="text/babel">
    import pluck from 'lodash/collection/pluck'
    import zipObject from 'lodash/array/zipObject'
    import merge from 'lodash/object/merge'
    import UnitSelect from './unit-select.vue'
    import CostTypeSelect from './cost-type-select.vue'

    export default {
        components: { UnitSelect, CostTypeSelect },

        computed: {
            isEditing() {
                return this.item['id']
            }
        },

        methods: {
            onSubmit() {
                const inputs = this._form.serializeArray()

                const item = merge(zipObject(pluck(inputs, 'name'), pluck(inputs, 'value')), {
                    order: 1
                })

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
