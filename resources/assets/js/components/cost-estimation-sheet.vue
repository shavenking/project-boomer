<template>
    <table class="ui table">
        <thead>
            <tr>
                <th rowspan="2">工作項目</th>
                <th rowspan="2">單位</th>
                <th colspan="2">合約計數</th>
            </tr>
            <tr>
                <th>數量</th>
                <th>價值</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="projectWork in projectWorks">
                <td>{{ projectWork.name }}</td>
                <td>{{ projectWork.unit.name }}</td>
                <td>{{ projectWork.amount }}</td>
                <td>{{ projectWork.unit_price }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import { getProjectWorks } from '../query-helpers/project-works'

    export default {
        props: ['projectId', 'date'],

        data() {
            return {
                projectWorks: []
            }
        },

        ready() {
            getProjectWorks(this.projectId).then(rep => {
                this.projectWorks = rep.works
            })
        }
    }
</script>
