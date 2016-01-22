<template>
    <div class="ui fluid card">
        <div class="content">
            <div class="header">
                <div class="right floated">
                    {{ item.amount * item.unit_price | currency }}
                </div>
                {{ item.order }}.&nbsp;{{ item.name }}
            </div>
            <div class="meta">
                <span>{{ item.cost_type_name }}</span>
                <span>{{ item.unit_name }}</span>
            </div>
        </div>
        <div class="extra content middle aligned">
            <div class="ui tiny compact right floated icon buttons">
                <button class="ui button" @click="editItem">
                    <i class="pencil icon"></i>
                </button>
                <button class="ui button" @click="deleteItem">
                    <i class="trash icon"></i>
                </button>
            </div>
            <div class="ui labels">
                <div class="ui label">{{ unitPriceText }}&nbsp;{{ item.unit_price | currency }}</div>
                <div class="ui label">{{ amountText }}&nbsp;{{ item.amount }}</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        props: [
            'item',
            'amountText',
            'unitPriceText'
        ],

        computed: {},

        methods: {
            editItem() {
                this.$parent.$emit('edit', this.item)
            },
            deleteItem() {
                this.$parent.$emit('delete', this.item)
            }
        },

        data() {},

        ready() {}
    }
</script>
