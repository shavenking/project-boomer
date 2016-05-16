<template>
    <workflow-node-list :nodes.sync="nodes" read-only="true"></workflow-node-list>
</template>

<script>
    import WorkflowNodeList from './workflow-node-list.vue'

    export default {
        components: { WorkflowNodeList },

        props: [],

        methods: {
            showByWorkId(workId) {
                window.$.getJSON(`/api/v1/works/${workId}`).then(rep => {
                    const workflowId = rep.work.workflow_id

                    window.$.getJSON(`/api/v1/workflows/${workflowId}/nodes`).then(rep => {
                        this.nodes = rep.nodes
                    })
                })
            }
        },

        data() {
            return {
                nodes: []
            }
        }
    }
</script>
