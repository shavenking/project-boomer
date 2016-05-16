<template>
    <div class="ui grid">
        <div class="nine wide center aligned column">
            <workflow-node-list :nodes.sync="nodes"></workflow-node-list>
        </div>

        <div class="seven wide column">
            <div class="ui sticky form" id="vue-order-title-input-{{ _uid }}">
                <div class="field">
                    <label>{{ labelText }}</label>
                    <order-title-input v-on:valid="onValid" v-on:invalid="onInvalid"></order-title-input>
                </div>
                <a href="{{ '/workflows/' + workflowId + '/works' }}" class="ui primary button"><i class="plus icon"></i>設定工作項目</a>
                <a href="{{ '/workflows/' + workflowId + '/checklist' }}" class="ui primary button"><i class="plus icon"></i>設定自主檢查表</a>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import OrderTitleInput from './order-title-input.vue'
    import WorkflowNodeList from './workflow-node-list.vue'

    function getNodes(workflowId) {
        return window.$.getJSON(`/api/v1/workflows/${workflowId}/nodes`)
    }

    function createNode(workflowId, order, title) {
        return window.$.post(`/api/v1/workflows/${workflowId}/nodes`, {order, title})
    }

    function deleteNode(node) {
        return window.$.post(`/api/v1/workflows/${node.workflow_id}/nodes/${node.id}`, {
            _method: 'DELETE'
        })
    }

    export default {
        components: { OrderTitleInput, WorkflowNodeList },

        props: ['workflowId', 'labelText'],

        events: {
            delete(node) {
                deleteNode(node).then(response => {
                    this.nodes = this.nodes.filter(candidate => {
                        return candidate.id !== node.id
                    })
                })
            }
        },

        methods: {
            onValid(dataBag) {
                createNode(this.workflowId, dataBag.order, dataBag.title).then((response) => {
                    this.nodes.push(response.node)

                    this.$nextTick(() => {
                        this._input.sticky('refresh')
                    })

                    this.$broadcast('nodeCreated')
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

                this.$nextTick(() => {
                    this._input = window.$(`#vue-order-title-input-${this._uid}`)

                    this._input.sticky({
                        offset: 20,
                        bottomOffset: 20
                    })
                })
            })
        }
    }
</script>
