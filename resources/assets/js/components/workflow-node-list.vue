<template>
    <div class="ui items">
        <div class="item" v-for="node in nodesExceptLast">
            <div class="middle aligned content">
                <div class="header">
                    {{ node.order }}.&nbsp;{{ node.title }}
                </div>
                <div class="vue-divider">
                    <i class="large grey long arrow down icon"></i>
                </div>
            </div>
        </div>
        <div class="item" v-if="lastNode">
            <div class="middle aligned content">
                <div class="header">{{ lastNode.order }}.&nbsp;{{ lastNode.title }}</div>
            </div>
        </div>
    </div>
</template>

<style>
    .item .vue-divider {
        margin-top: 1.5em;
        margin-bottom: 1em;
    }
</style>

<script>
    import sortBy from 'lodash/collection/sortBy'
    import last from 'lodash/array/last'
    import take from 'lodash/array/take'

    export default {
        props: ['workflowId', 'nodes'],

        computed: {
            sortedNodes() {
                return sortBy(this.nodes, 'order')
            },
            nodesExceptLast() {
                return take(this.sortedNodes, this.sortedNodes.length - 1)
            },
            lastNode() {
                return last(this.sortedNodes)
            }
        }
    }
</script>
