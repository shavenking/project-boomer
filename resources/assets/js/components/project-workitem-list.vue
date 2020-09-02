<template>
    <div class="ui grid">
        <div class="row">
            <div class="sixteen wide column">
                <div class="ui raised segment">
                    <div class="ui mini five statistics">
                        <div class="statistic">
                            <div class="label">總價</div>
                            <div class="value">{{ total | currency }}</div>
                        </div>
                        <div class="statistic" v-for="(key, typeTotal) in typeTotals">
                            <div class="label">{{ costTypes[key] }}</div>
                            <div class="value">{{ typeTotal | currency }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sixteen wide column">
                <table-workitems
                    :items="items"
                    :is-locked="isLocked"
                ></table-workitems>
            </div>
        </div>
        <div class="row">
            <div class="sixteen wide column">
                <workitem-form v-ref:form v-show="!isLocked">
                    <a href="{{ '/projects/' + projectId + '/bid' + '/works'}}" class="ui primary button">返回</a>
                </workitem-form>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import WorkitemForm from './workitem-form.vue'
    import TableWorkitems from './table-workitems.vue'
    import zipObject from 'lodash/array/zipObject'
    import pluck from 'lodash/collection/pluck'
    import merge from 'lodash/object/merge'

    function getItems(projectId, workId) {
        return window.$.getJSON(`/api/v1/projects/${projectId}/works/${workId}/workitems`)
    }

    function getTypes() {
        return window.$.getJSON('/api/v1/cost-types')
    }

    function createItem(projectId, workId, item) {
        return window.$.post(`/api/v1/projects/${projectId}/works/${workId}/workitems`, item)
    }

    function updateItem(projectId, workId, item) {
        return window.$.post(`/api/v1/projects/${projectId}/works/${workId}/workitems/${item.id}`, merge(item, {
            _method: 'PUT'
        }))
    }

    function deleteItem(projectId, workId, item) {
        return window.$.post(`/api/v1/projects/${projectId}/works/${workId}/workitems/${item.id}`, {
            _method: 'DELETE'
        })
    }

    export default {
        components: { WorkitemForm, TableWorkitems },

        props: [
            'projectId',
            'workId',
            'isLocked'
        ],

        computed: {
            total() {
                let sum = 0

                pluck(this.items, 'total_price').forEach((price) => {
                    sum += price
                })

                return sum
            },
            typeTotals() {
                let sum = {
                    1: 0,
                    2: 0,
                    3: 0,
                    4: 0
                }

                this.items.forEach(item => {
                    sum[item.cost_type_id] += item.total_price
                })

                return sum
            }
        },

        methods: {},

        events: {
            edit(item) {
                this.$refs.form.$emit('edit', item)
            },
            create(item) {
                createItem(this.projectId, this.workId, item).then(response => {
                    this.items.push(response.workitem)

                    this.$refs.form.$emit('created', response.workitem)
                })
            },
            update(item) {
                updateItem(this.projectId, this.workId, item).then(response => {
                    const item = response.workitem

                    let items = this.items.map(candidate => {
                        if (candidate.id == item.id) {
                            return item
                        }

                        return candidate
                    })

                    this.items = items

                    this.$refs.form.$emit('updated', response.workitem)
                })
            },
            delete(item) {
                deleteItem(this.projectId, this.workId, item).then(response => {
                    this.items = this.items.filter(candidate => {
                        return candidate.id != item.id
                    })
                })
            }
        },

        data() {
            return {
                items: [],
                costTypes: {}
            }
        },

        ready() {
            getItems(this.projectId, this.workId).then(response => {
                this.items = response.workitems
            })

            getTypes().then(response => {
                this.costTypes = zipObject(
                    pluck(response.cost_types, 'id'),
                    pluck(response.cost_types, 'name')
                )
            })
        }
    }
</script>
