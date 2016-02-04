<template>
    <table class="ui table">
        <thead>
            <tr>
                <th>{{ costTypeLabel }}</th>
                <th>{{ nameLabel }}</th>
                <th>{{ unitLabel }}</th>
                <th>{{ unitPriceLabel }}</th>
                <th>{{ amountLabel }}</th>
                <th>{{ totalPriceLabel }}</th>
            </tr>
        </thead>
        <tbody v-for="items in groupedItems">
            <tr v-for="(idx, item) in items">
                <td :rowspan="items.length" v-if="0 === idx" class="top aligned collapsing">
                    {{ item.cost_type.name }}
                </td>
                <td>{{ item.name }}</td>
                <td>{{ item.unit.name }}</td>
                <td>{{ item.unit_price | currency }}</td>
                <td>{{ item.amount }}</td>
                <td>{{ item.unit_price * item.amount | currency }}</td>
            </tr>
        </tbody>
        <tfoot>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>{{ totalPrice | currency }}</th>
        </tfoot>
    </table>
</template>

<script>
    import _ from 'lodash'
    function getItems(workId) {
        return window.$.getJSON(`/api/v1/works/${workId}/work-items`)
    }

    export default {
        props: ['workId', 'unitLabel', 'nameLabel', 'amountLabel', 'costTypeLabel', 'unitPriceLabel', 'totalPriceLabel'],

        computed: {
            totalPrice() {
                let sum = 0
                _.forEach(this.items, item => {
                    sum += item.amount * item.unit_price
                })

                return sum
            },

            groupedItems() {
                return _.groupBy(this.items, 'cost_type_id')
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
            })
        }
    }
</script>
