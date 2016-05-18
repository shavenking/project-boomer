<template>
    <table class="ui celled structured table">
        <thead>
            <tr>
                <th class="four wide center aligned">{{ titleLabel }}</th>
                <th class="twelve wide">{{ detailLabel }}</th>
            </tr>
        </thead>
        <tbody v-for="(title, items) in groupedItems">
            <tr v-for="(idx, item) in items">
                <td :rowspan="items.length" v-if="0 === idx" class="top aligned center aligned">{{ title }}</td>
                <td v-if="item.detail">
                    {{ item.detail }}
                    <a href="#" @click="deleteItem(item, $event)"><i class="ui red trash icon"></i></a>
                </td>
                <td v-if="!item.detail" >
                    <div class="ui fluid icon input">
                        <input type="text" @keypress.enter="onSubmit(title, $event)">
                        <i class="plus icon"></i>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script type="text/babel">
    import _ from 'lodash'

    function getChecklist(checklistId) {
        return window.$.getJSON(`/api/v1/checklists/${checklistId}`)
    }

    function createCheckitem(checklistId, title, detail) {
        return window.$.post(`/api/v1/checklists/${checklistId}/checkitems`, { title, detail })
    }

    function getNodes(workflowId) {
        return window.$.getJSON(`/api/v1/workflows/${workflowId}/nodes`)
    }

    export default {
        props: ['checklistId', 'titleLabel', 'detailLabel'],

        computed: {
            groupedItems() {
                return (_(this.items)
                .map(item => {
                    return {
                        id: item.id,
                        title: item.name,
                        detail: item.detail
                    }
                })
                .concat(
                    _(this.nodes).pluck('title').map(title => {
                        return { title }
                    }).value()
                )
                .groupBy('title')
                .value())
            }
        },

        methods: {
            deleteItem(item, e) {
                e.preventDefault()

                window.$.post(`/api/v1/checklists/${this.checklistId}/checkitems/${item.id}`, {
                    _method: 'DELETE'
                }).then(() => {
                    this.items = this.items.filter(candidate => {
                        return item.id !== candidate.id
                    })
                })
            },
            onSubmit(title, e) {
                e.preventDefault()

                const detail = e.target.value

                createCheckitem(this.checklistId, title, detail).then(response => {
                    this.items.push(response.checkitem)

                    e.target.value = ''
                })
            }
        },

        data() {
            return {
                items: [],
                nodes: []
            }
        },

        ready() {
            getChecklist(this.checklistId).then(response => {
                this.items = response.checkitems

                getNodes(response.checklist.workflow_id).then(response => {
                    this.nodes = response.nodes
                })
            })
        }
    }
</script>
