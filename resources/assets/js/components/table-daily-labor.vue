<template>
    <div>
        <table class="ui table">
            <thead>
                <tr>
                    <th>工別</th>
                    <th>人數</th>
                    <th>累積人數</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="amountAndName in statistics">
                    <td>{{ amountAndName.name }}</td>
                    <td>{{ getDailyLabor(amountAndName.name) ? getDailyLabor(amountAndName.name).attributes.amount : 0 }}</td>
                    <td>{{ amountAndName.total_amount }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">
                        <button class="ui right floated primary button" @click="openModal">新增</button>
                    </th>
                </tr>
            </tfoot>
        </table>

        <modal-create-daily-labor
            :project-id="projectId"
            :date="date"
            :on-success="onCreated"
            v-ref:modal
        ></modal-create-daily-labor>
    </div>
</template>

<script>
    import ModalCreateDailyLabor from './modal-create-daily-labor.vue'
    export default {
        props: ['projectId', 'date'],
        components: { ModalCreateDailyLabor },
        data() {
            return {
                store: null,
                statistics: null
            }
        },
        computed: {
            dailyLabors() {
                return this.$get('store.data')
            }
        },
        methods: {
            openModal() { this.$refs.modal.openModal() },
            onCreated() {
                this.fetchDailyLabors().then(() => {
                    this.fetchStatistics()
                })
            },
            getDailyLabor(name) {
                return this.dailyLabors.find(candidate => {
                    return candidate.attributes.name === name
                })
            },
            fetchDailyLabors() {
                const projectId = this.projectId
                const date = this.date

                return window.$.getJSON(
                    '/api/v1' +
                    `/projects/${projectId}` +
                    `/construction-dailies/${date}` +
                    '/labors'
                ).then(rep => {
                    this.store = rep
                })
            },
            fetchStatistics() {
                const projectId = this.projectId

                return window.$.getJSON(
                    '/api/v1/statistics' +
                    `/projects/${projectId}` +
                    '/daily-labors'
                ).then(({labors}) => {
                    this.statistics = labors
                })
            }
        },
        ready() {
            this.fetchDailyLabors().then(() => {
                this.fetchStatistics()
            })
        }
    }
</script>
