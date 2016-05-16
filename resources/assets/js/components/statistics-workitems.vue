<template>
    <div class="ui mini five statistics">
        <div class="statistic">
            <div class="label">{{ totalPriceLabel }}</div>
            <div class="value">{{ totalPrice | currency }}</div>
        </div>
        <div class="statistic" v-for="(costTypeId, totalPrice) in totalPriceByTypes">
            <div class="label">{{ costTypes[costTypeId] }}</div>
            <div class="value">{{ totalPrice | currency }}</div>
        </div>
    </div>
</template>

<script type="text/babel">
    import _ from 'lodash'

    function getItems(workId) {
        return window.$.getJSON(`/api/v1/works/${workId}/work-items`)
    }

    function getTypes() {
        return window.$.getJSON('/api/v1/cost-types')
    }

    export default {
        props: ['workId', 'totalPriceLabel'],

        computed: {
            totalPrice() {
                let sum = 0
                _.forEach(this.items, item => {
                    sum += item.amount * item.unit_price
                })

                return sum
            },

            totalPriceByTypes() {
                let totals = {}

                _.forEach(this.costTypes, (name, typeId) => {
                    totals[typeId] = 0
                })

                _.forEach(_.groupBy(this.items, 'cost_type_id'), (items, costTypeId) => {
                    _.forEach(items, item => {
                        totals[costTypeId] += item.amount * item.unit_price
                    })
                })

                return totals
            },

            groupedItems() {
                return _.groupBy(this.items, 'cost_type_id')
            }
        },

        data() {
            return {
                items: [],
                costTypes: []
            }
        },

        ready() {
            getItems(this.workId).then(response => {
                this.items = response.work_items
            })

            getTypes().then(response => {
                this.costTypes = _.zipObject(
                    _.pluck(response.cost_types, 'id'),
                    _.pluck(response.cost_types, 'name')
                )
            })
        }
    }
</script>
