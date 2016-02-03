<template>
    <table class="ui table">
        <thead>
            <tr>
                <th class="four wide center aligned">{{ typeOrderLabel }}</th>
                <th>{{ nameLabel }}</th>
                <th>{{ unitLabel }}</th>
                <th>{{ unitPriceLabel }}</th>
                <th>{{ amountLabel }}</th>
                <th>{{ totalPriceLabel }}</th>
                <th>
                </th>
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
                <td>{{ work.amount }}</td>
                <td>{{ work.unit_price * work.amount | currency }}</td>
                <td><a href="{{ '/projects/' + projectId + '/works/' + work.id }}">{{ workitemsLabel }}</a></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>{{ totalWorkPrice | currency }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
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
            }
        },

        data() {
            return {
                works: []
            }
        },

        ready() {
            getProjectWorks(this.projectId, this.queries).then(response => {
                this.works = response.works
            })
        }
    }
</script>
