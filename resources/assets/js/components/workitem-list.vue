<template>
    <div class="ui grid">
        <div class="eight wide column">
            <workitem-form :labels.once="labels" v-ref:form class="ui sticky form" id="vue-workitem-form-{{ _uid }}"></workitem-form>
        </div>
        <div class="eight wide column">
            <div class="ui cards">
                <price-card
                    v-for="item in items"
                    :item.once="item"
                    :amount-text.once="amountText"
                    :unit-price-text.once="unitPriceText"
                ></price-card>
            </div>
        </div>
    </div>
</template>

<script>
    import PriceCard from './price-card.vue'
    import WorkitemForm from './workitem-form.vue'
    import merge from 'lodash/object/merge'

    function getItems(workId) {
        return window.$.getJSON(`/api/v1/works/${workId}/work-items`)
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
            'editText',
            'deleteText',
            'amountText',
            'unitPriceText'
        ],

        computed: {
            labels() {
                return {
                    unit: this.unitLabel,
                    costType: this.costTypeLabel,
                    order: this.orderLabel,
                    name: this.nameLabel,
                    amount: this.amountLabel,
                    unitPrice: this.unitPriceText
                }
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
                items: []
            }
        },

        ready() {
            getItems(this.workId).then(response => {
                this.items = response.work_items

                this.$nextTick(() => {
                    window.$(`#vue-workitem-form-${this._uid}`).sticky({})
                })
            })
        }
    }
</script>
