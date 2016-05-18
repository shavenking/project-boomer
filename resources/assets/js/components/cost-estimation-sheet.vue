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
                <td>{{ previousPassesAmount[projectWork.id] }}</td>
                <td>{{ previousPassesAmount[projectWork.id] * projectWork.unit_price }}</td>
                <td>{{ totalPassesAmount[projectWork.id] - previousPassesAmount[projectWork.id] }}</td>
                <td>{{ (totalPassesAmount[projectWork.id] - previousPassesAmount[projectWork.id]) * projectWork.unit_price }}</td>
                <td>{{ totalPassesAmount[projectWork.id] }}</td>
                <td>{{ totalPassesAmount[projectWork.id] * projectWork.unit_price }}</td>
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="11">其它費用</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="bounce in allBounces">
                <td>{{ bounce.name }}</td>
                <td>{{ bounce.unit.name }}</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>{{ previousPrices[bounce.id] }}</td>
                <td>-</td>
                <td>{{ currentPrices[bounce.id] }}</td>
                <td>-</td>
                <td>{{ previousPrices[bounce.id] + currentPrices[bounce.id] }}</td>
            </tr>
        </tbody>
        <tfoot v-if="costEstimationId">
            <tr>
                <th colspan="11">
                    <button class="ui primary button" @click="openModal()">其它費用</button>
                </th>
            </tr>
        </tfoot>
    </table>

    <modal-create-cost-estimation-bounce
            :project-id.once="projectId"
            :cost-estimation-id.once="costEstimationId"
            :on-success.once="onCostEstimationBounceCreated"
            v-ref:modal
    ></modal-create-cost-estimation-bounce>
</template>

<script type="text/babel">
    import { getProjectWorks, getEstimations, getPreviousEstimations } from '../query-helpers/project-works'
    import _ from 'lodash'
    import ModalCreateCostEstimationBounce from './modal-create-cost-estimation-bounce.vue'

    export default {
        props: ['projectId', 'costEstimationId', 'date'],

        components: { ModalCreateCostEstimationBounce },

        methods: {
            openModal() {
                this.$refs.modal.openModal()
            },
            onCostEstimationBounceCreated() {
                window.$.getJSON(`/api/v1/cost-estimation-bounces`).then(rep => {
                    const allBounces = rep.cost_estimation_bounces
                    this.allBounces = rep.cost_estimation_bounces

                    window.$.getJSON(`/api/v1/projects/${this.projectId}/bounces/`, { cost_estimation_id: this.costEstimationId }).then(rep => {
                        // 抓出本期的額外費用
                        const currentBounces = _.filter(rep.cost_estimation_bounces, bounce => {
                            return bounce.cost_estimation_id == this.costEstimationId
                        })
                        let currentPrices = _.zipObject(_.pluck(allBounces, 'id'), new Array(allBounces.length).fill(0))
                        _.each(_.groupBy(currentBounces, 'cost_estimation_bounce_id'), (bounces, bounceId) => {
                            let sum = 0
                            _.each(bounces, bounce => {
                                sum += (bounce.amount) * (bounce.unit_price)
                            })
                            currentPrices[bounceId] = sum
                        })
                        this.currentPrices = currentPrices
                        // 抓出本期以外的額外費用
                        let previousPrices = _.zipObject(_.pluck(allBounces, 'id'), new Array(allBounces.length).fill(0))
                        const previousBounces = _.filter(rep.cost_estimation_bounces, bounce => {
                            return bounce.cost_estimation_id != this.costEstimationId
                        })
                        _.each(_.groupBy(previousBounces, 'cost_estimation_bounce_id'), (bounces, bounceId) => {
                            let sum = 0
                            _.each(bounces, bounce => {
                                sum += (bounce.amount) * (bounce.unit_price)
                            })
                            previousPrices[bounceId] = sum
                        })
                        this.previousPrices = previousPrices
                    })
                })
            }
        },

        data() {
            return {
                projectWorks: [],
                totalPassesAmount: {},
                previousPassesAmount: {},
                bounceCostEstimations: [],
                previousBounceCostEstimations: {},
                allBounces: [],
                currentPrices: {},
                previousPrices: {}
            }
        },

        ready() {
            window.$.getJSON(`/api/v1/cost-estimation-bounces`).then(rep => {
                const allBounces = rep.cost_estimation_bounces
                this.allBounces = rep.cost_estimation_bounces

                window.$.getJSON(`/api/v1/projects/${this.projectId}/bounces/`, { cost_estimation_id: this.costEstimationId }).then(rep => {
                    // 抓出本期的額外費用
                    const currentBounces = _.filter(rep.cost_estimation_bounces, bounce => {
                        return bounce.cost_estimation_id == this.costEstimationId
                    })
                    let currentPrices = _.zipObject(_.pluck(allBounces, 'id'), new Array(allBounces.length).fill(0))
                    _.each(_.groupBy(currentBounces, 'cost_estimation_bounce_id'), (bounces, bounceId) => {
                        let sum = 0
                        _.each(bounces, bounce => {
                            sum += (bounce.amount) * (bounce.unit_price)
                        })
                        currentPrices[bounceId] = sum
                    })
                    this.currentPrices = currentPrices
                    // 抓出本期以外的額外費用
                    let previousPrices = _.zipObject(_.pluck(allBounces, 'id'), new Array(allBounces.length).fill(0))
                    const previousBounces = _.filter(rep.cost_estimation_bounces, bounce => {
                        return bounce.cost_estimation_id != this.costEstimationId
                    })
                    _.each(_.groupBy(previousBounces, 'cost_estimation_bounce_id'), (bounces, bounceId) => {
                        let sum = 0
                        _.each(bounces, bounce => {
                            sum += (bounce.amount) * (bounce.unit_price)
                        })
                        previousPrices[bounceId] = sum
                    })
                    this.previousPrices = previousPrices
                })
            })

            getProjectWorks(this.projectId).then(rep => {
                this.projectWorks = rep.works
                this.totalPassesAmount = _.zipObject(_.pluck(rep.works, 'id'), new Array(rep.works.length).fill(0))
                this.previousPassesAmount = _.zipObject(_.pluck(rep.works, 'id'), new Array(rep.works.length).fill(0))

                rep.works.forEach((pWork, idx) => {
                    getEstimations(this.projectId, pWork.id, { date: this.date }).then(rep => {
                        let sum = 0

                        if (rep['project_checklists']) {

                            rep.project_checklists.forEach((pChecklist) => {
                                sum += pChecklist.passes_amount
                            })
                        }

                        this.totalPassesAmount[pWork.id] = sum
                    })

                    getPreviousEstimations(this.projectId, pWork.id, { date: this.date }).then(rep => {
                        let sum = 0

                        if (rep['project_checklists']) {

                            rep.project_checklists.forEach((pChecklist) => {
                                sum += pChecklist.passes_amount
                            })
                        }

                        this.previousPassesAmount[pWork.id] = sum
                    })
                })
            })
        }
    }
</script>
