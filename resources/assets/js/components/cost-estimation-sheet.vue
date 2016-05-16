<template>
    <table class="ui table">
        <thead>
            <tr>
                <th rowspan="2">工作項目</th>
                <th rowspan="2">單位</th>
                <th rowspan="2">單價</th>
                <th colspan="2">合約計數</th>
                <th colspan="2">以前完成</th>
                <th colspan="2">本期完成</th>
                <th colspan="2">合計完成</th>
            </tr>
            <tr>
                <th>數量</th>
                <th>價值</th>
                <th>數量</th>
                <th>價值</th>
                <th>數量</th>
                <th>價值</th>
                <th>數量</th>
                <th>價值</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="projectWork in projectWorks">
                <td>{{ projectWork.name }}</td>
                <td>{{ projectWork.unit.name }}</td>
                <td>{{ projectWork.unit_price }}</td>
                <td>{{ projectWork.amount }}</td>
                <td>{{ projectWork.amount * projectWork.unit_price }}</td>
                <td>{{ previousPassesAmount[$index] }}</td>
                <td>{{ previousPassesAmount[$index] * projectWork.unit_price }}</td>
                <td>{{ totalPassesAmount[$index] - previousPassesAmount[$index] }}</td>
                <td>{{ (totalPassesAmount[$index] - previousPassesAmount[$index]) * projectWork.unit_price }}</td>
                <td>{{ totalPassesAmount[$index] }}</td>
                <td>{{ totalPassesAmount[$index] * projectWork.unit_price }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import { getProjectWorks, getEstimations, getPreviousEstimations } from '../query-helpers/project-works'
    import _ from 'lodash'
    import moment from 'moment'

    export default {
        props: ['projectId', 'date'],

        data() {
            return {
                projectWorks: [],
                totalPassesAmount: [],
                previousPassesAmount: []
            }
        },

        ready() {
            getProjectWorks(this.projectId).then(rep => {
                this.projectWorks = rep.works

                rep.works.forEach((pWork, idx) => {
                    getEstimations(this.projectId, pWork.id, { date: this.date }).then(rep => {
                        let sum = 0

                        if (rep['project_checklists']) {

                            rep.project_checklists.forEach((pChecklist) => {
                                sum += pChecklist.passes_amount
                            })
                        }

                        this.totalPassesAmount.push(sum)
                    })

                    getPreviousEstimations(this.projectId, pWork.id, { date: this.date }).then(rep => {
                        let sum = 0

                        if (rep['project_checklists']) {

                            rep.project_checklists.forEach((pChecklist) => {
                                sum += pChecklist.passes_amount
                            })
                        }

                        this.previousPassesAmount.push(sum)
                    })
                })
            })
        }
    }
</script>
