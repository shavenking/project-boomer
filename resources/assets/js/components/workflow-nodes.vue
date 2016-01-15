<template>
    <div class="ui grid">

        <div class="eight wide column">
            <div class="ui sticky form" id="vue-order-title-input-{{ _uid }}">
                <div class="field">
                    <label>{{ labelText }}</label>
                    <order-title-input v-on:valid="onValid" v-on:invalid="onInvalid"></order-title-input>
                </div>
            </div>
        </div>

        <div class="eight wide column" id="vue-workflow-node-list-{{ _uid }}">
            <workflow-node-list v-bind:nodes.sync="nodes"></workflow-node-list>
        </div>

    </div>
</template>

<script>
    import Vue from 'vue'
    import OrderTitleInput from './order-title-input.vue'
    import WorkflowNodeList from './workflow-node-list.vue'

    function getNodes(workflowId) {
        return window.$.getJSON(`/api/v1/workflows/${workflowId}/nodes`)
    }

    function createNode(workflowId, order, title) {
        return window.$.post(`/api/v1/workflows/${workflowId}/nodes`, {order, title})
    }

    export default {
        components: { OrderTitleInput, WorkflowNodeList },

        props: ['workflowId', 'labelText'],

        methods: {
            onValid(dataBag) {
                createNode(this.workflowId, dataBag.order, dataBag.title).then((response) => {
                    this.nodes.push(response.node)

                    this.$broadcast('nodeCreated')

                    Vue.nextTick(() => {
                        this.$broadcast('listUpdated')
                    })
                })
            },

            onInvalid() {
                console.log('failed')
            }
        },

        data() {
            return {
                nodes: []
            }
        },

        ready() {
            getNodes(this.workflowId).then(response => {
                this.nodes = response.nodes

                Vue.nextTick(() => {
                    this.$broadcast('listUpdated')
                })
            })

            window.$(`#vue-order-title-input-${this._uid}`).sticky({
                context: `#vue-workflow-node-list-${this._uid}`
            })
        }
    }
</script>
