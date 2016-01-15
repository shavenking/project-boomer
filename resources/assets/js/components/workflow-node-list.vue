<template>
    <div class="ui small image" id="vue-diagram-{{ _uid }}"></div>
</template>

<script>
    import sortBy from 'lodash/collection/sortBy'
    import pluck from 'lodash/collection/pluck'

    export default {
        props: ['workflowId', 'nodes'],

        methods: {
            drawFlow() {
                window.$(`#vue-diagram-${this._uid}`).empty()

                let operations = []

                operations.push({
                    id: 'st',
                    content: 'st=>start: Start'
                })

                sortBy(this.nodes, 'order').forEach(node => {
                    operations.push({
                        id: `op${node.id}`,
                        content: `op${node.id}=>operation: ${node.order}. ${node.title}`
                    })
                })

                operations.push({
                    id: 'end',
                    content: 'end=>end: End'
                })

                let contents = pluck(operations, 'content').join('\n')
                let flow = pluck(operations, 'id').join('->')

                window.flowchart.parse(`${contents}\n\n${flow}`).drawSVG(`vue-diagram-${this._uid}`, {})

                this.$dispatch('drawn')
            }
        },

        events: {
            listUpdated() {
                this.drawFlow()
            }
        }
    }
</script>
