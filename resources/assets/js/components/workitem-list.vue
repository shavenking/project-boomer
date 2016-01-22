<template>
    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide column">
                <div class="ui raised segment">
                    <div class="ui mini five statistics">
                        <div class="statistic">
                            <div class="label">{{ totalPriceLabel }}</div>
                            <div class="value">{{ total | currency }}</div>
                        </div>
                        <div class="statistic" v-for="(key, typeTotal) in typeTotals">
                            <div class="label">{{ costTypes[key] }}</div>
                            <div class="value">{{ typeTotal | currency }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="nine wide column">
                <div class="ui cards">
                    <price-card
                        v-for="item in items | orderBy 'order'"
                        :item.once="item"
                        :amount-text.once="amountText"
                        :unit-price-text.once="unitPriceText"
                    ></price-card>
                </div>
            </div>
            <div class="seven wide column">
                <workitem-form :labels.once="labels" class="sticky" id="vue-workitem-form-{{ _uid }}" v-ref:form></workitem-form>
            </div>
        </div>
    </div>
</template>

<script>
    import PriceCard from './price-card.vue'
    import WorkitemForm from './workitem-form.vue'
    import zipObject from 'lodash/array/zipObject'
    import pluck from 'lodash/collection/pluck'
    import merge from 'lodash/object/merge'

    function getItems(workId) {
        return window.$.getJSON(`/api/v1/works/${workId}/work-items`)
    }

    function getTypes() {
        return window.$.getJSON('/api/v1/cost-types')
    }

    function createItem(workId, item) {
        return window.$.post(`/api/v1/works/${workId}/work-items`, item)
    }

    function updateItem(workId, item) {
        return window.$.post(`/api/v1/works/${workId}/work-items/${item.id}`, merge(item, {
            _method: 'PUT'
        }))
    }

    function deleteItem(item) {
        return window.$.post(`/api/v1/works/${item.work_id}/work-items/${item.id}`, {
            _method: 'DELETE'
        })
    }

    export default {
        components: { PriceCard, WorkitemForm },

        props: [
            'workId',
            'unitLabel',
            'costTypeLabel',
            'orderLabel',
            'nameLabel',
            'amountLabel',
            'createLabel',
            'clearLabel',
            'updateLabel',
            'cancelLabel',
            'editText',
            'deleteText',
            'amountText',
            'unitPriceText',
            'totalPriceLabel'
        ],

        computed: {
            labels() {
                return {
                    unit: this.unitLabel,
                    costType: this.costTypeLabel,
                    order: this.orderLabel,
                    name: this.nameLabel,
                    amount: this.amountLabel,
                    unitPrice: this.unitPriceText,
                    create: this.createLabel,
                    update: this.updateLabel,
                    cancel: this.cancelLabel,
                    clear: this.clearLabel
                }
            },
            total() {
                let sum = 0

                pluck(this.items, 'total_price').forEach((price) => {
                    sum += price
                })

                return sum
            },
            typeTotals() {
                let sum = {
                    1: 0,
                    2: 0,
                    3: 0,
                    4: 0
                }

                this.items.forEach(item => {
                    sum[item.cost_type_id] += item.total_price
                })

                return sum
            }
        },

        methods: {},

        events: {
            edit(item) {
                this.$refs.form.$emit('edit', item)
            },
            create(item) {
                createItem(this.workId, item).then(response => {
                    this.items.push(response.work_item)

                    this.$refs.form.$emit('created', response.work_item)
                })
            },
            update(item) {
                updateItem(this.workId, item).then(response => {
                    const item = response.work_item

                    let items = this.items.map(candidate => {
                        if (candidate.id == item.id) {
                            return item
                        }

                        return candidate
                    })

                    this.items = items

                    this.$refs.form.$emit('updated', response.work_item)
                })
            },
            delete(item) {
                deleteItem(item).then(response => {
                    this.items = this.items.filter(candidate => {
                        return candidate.id != item.id
                    })
                })
            }
        },

        data() {
            return {
                items: [],
                costTypes: {}
            }
        },

        ready() {
            getItems(this.workId).then(response => {
                this.items = response.work_items

                this.$nextTick(() => {
                    window.$(`#vue-workitem-form-${this._uid}`).sticky({
                        offset: 20,
                        bottomOffset: 20
                    })
                })
            })

            getTypes().then(response => {
                this.costTypes = zipObject(
                    pluck(response.cost_types, 'id'),
                    pluck(response.cost_types, 'name')
                )
            })
        }
    }
</script>
