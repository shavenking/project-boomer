<template>
    <table class="ui eight column table">
        <thead>
            <tr>
                <th class="four wide center aligned">{{ typeOrderLabel }}</th>
                <th>{{ nameLabel }}</th>
                <th>{{ unitLabel }}</th>
                <th>{{ unitPriceLabel }}</th>
                <th>{{ amountLabel }}</th>
                <th>{{ totalPriceLabel }}</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody v-for="(detailingflowTypeId, works) in groupedWorks">
            <tr v-for="(idx, work) in works">
                <td :rowspan="works.length" v-if="0 === idx" class="top aligned center aligned">
                    {{ work.detailingflow_type.mainflow_type.name }}
                    <br>
                    {{ work.detailingflow_type.name }}
                </td>
                <td>{{ work.name }}</td>
                <td>{{ work.unit.name }}</td>
                <td>{{ work.unit_price | currency}}</td>
                <td>
                    <div class="ui input">
                        <input type="text" name="work_amount[]" v-model="work.amount" @keyup="updateWork(work)">
                    </div>
                </td>
                <td>{{ work.unit_price * work.amount | currency }}</td>
                <td><a href="{{ '/projects/' + projectId + '/works/' + work.id }}">{{ workitemsLabel }}</a></td>
                <td>
                    <button class="ui icon red button" @click="deleteWork(work.id)"><i class="ui trash icon"></i></button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8">
                    <div class="ui mini five statistics">
                        <div class="statistic">
                            <div class="label">總價</div>
                            <div class="value">{{ totalWorkPrice | currency }}</div>
                        </div>
                        <div class="statistic" v-for="costTypeName in costTypes">
                            <div class="label">{{ costTypeName }}</div>
                            <div class="value">{{ statistics[costTypeName] || 0 | currency }}</div>
                        </div>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</template>

<script type="text/babel">
    import _ from 'lodash'

    function getProjectWorks(projectId, queries) {
        let queryArray = []

        if (queries.mainflow_type_id) {
            queryArray.push(`mainflow_type_id=${queries.mainflow_type_id}`)
        }

        if (queries.detailingflow_type_id) {
            queryArray.push(`detailingflow_type_id=${queries.detailingflow_type_id}`)
        }

        const queryString = queryArray.join('&')

        return window.$.getJSON(`/api/v1/projects/${projectId}/works?${queryString}`)
    }

    function getTypes() {
        return window.$.getJSON('/api/v1/cost-types')
    }

    function updateWork(work) {
        return window.$.post(`/api/v1/projects/${work.project_id}/works/${work.id}`, {
            _method: 'PUT',
            amount: work.amount
        })
    }

    export default {
        props: ['projectId', 'query', 'unitLabel', 'nameLabel', 'amountLabel', 'workitemsLabel', 'unitPriceLabel', 'totalPriceLabel', 'typeOrderLabel'],

        computed: {
            queries() {
                return JSON.parse(this.query)
            },

            totalWorkPrice() {
                let sum = 0
                _.forEach(this.works, work => {
                    sum += work.amount * work.unit_price
                })

                return sum
            },

            groupedWorks() {
                return _.groupBy(this.works, 'detailingflow_type_id')
            },

            statistics() {
                let statistics = _.zipObject(_.values(this.costTypes), _.fill(new Array(4), 0))

                _.each(this.works, work => {
                    _.each(work.workitems, workitem => {
                        statistics[workitem.cost_type_name] += work.amount * workitem.amount * workitem.unit_price
                    })
                })

                return statistics
            }
        },

        data() {
            return {
                works: [],
                costTypes: []
            }
        },

        methods: {
            updateWork(work) {
                updateWork(work)
            },

            deleteWork(workId) {
                window.$.post(`/api/v1/projects/${this.projectId}/works/${workId}`, {
                    _method: 'DELETE'
                }).then(rep => {
                    this.works = this.works.filter(work => {
                        return work.id !== workId
                    })
                })
            }
        },

        ready() {
            getProjectWorks(this.projectId, this.queries).then(response => {
                this.works = response.works
            })

            getTypes().then(response => {
                this.costTypes = _.zipObject(
                    _.pluck(response.cost_types, 'id'),
                    _.pluck(response.cost_types, 'name')
                )
            })
        }
    }
</script>
