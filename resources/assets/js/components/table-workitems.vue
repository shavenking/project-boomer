<template>
    <table class="ui seven column table">
        <thead>
            <tr>
                <th>名稱</th>
                <th>單位</th>
                <th>數量</th>
                <th>單價</th>
                <th>總價</th>
                <th>費用類別</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items">
                <td>{{ item.name }}</td>
                <td>{{ item.unit.name }}</td>
                <td>{{ item.amount }}</td>
                <td>{{ item.unit_price | currency }}</td>
                <td class="collapsing">{{ item.unit_price * item.amount | currency }}</td>
                <td>
                    {{ item.cost_type.name }}
                </td>
                <td class="collapsing">
                    <div class="ui tiny compact right floated icon buttons">
                        <button class="ui button" @click="editItem(item)">
                            <i class="pencil icon"></i>
                        </button>
                        <button class="ui button" @click="deleteItem(item)">
                            <i class="trash icon"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>{{ totalPrice | currency }}</th>
            <th></th>
            <th></th>
        </tfoot>
    </table>
</template>

<script type="text/babel">
    import _ from 'lodash'

    export default {
        props: ['items'],

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

        methods: {
            editItem(item) {
                this.$parent.$emit('edit', item)
            },
            deleteItem(item) {
                this.$parent.$emit('delete', item)
            }
        }
    }
</script>
