<template>
    <div>
        <table class="ui table">
            <thead>
                <tr>
                    <th>機具</th>
                    <th>數量</th>
                    <th>累積數量</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="amountAndName in statistics">
                    <td>{{ amountAndName.name }}</td>
                    <td>{{ getDailyAppliance(amountAndName.name) ? getDailyAppliance(amountAndName.name).attributes.amount : 0 }}</td>
                    <td>{{ amountAndName.total_amount }}</td>
                </tr>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="5">
                    <button class="ui right floated primary button" :class="{disabled: isLocked}" @click="openModal">新增</button>
                </th>
            </tr>
            </tfoot>
        </table>

        <modal-create-daily-appliance
            :project-id="projectId"
            :date="date"
            :on-success="onCreated"
            v-ref:modal
        ></modal-create-daily-appliance>
    </div>
</template>

<script>
    import ModalCreateDailyAppliance from './modal-create-daily-appliance.vue'

    export default {
        props: ['projectId', 'date', 'isLocked'],
        components: { ModalCreateDailyAppliance },
        data() {
            return {
                store: null,
                statistics: null
            }
        },
        computed: {
            dailyAppliances() {
                return this.$get('store.data')
            }
        },
        methods: {
            openModal() { this.$refs.modal.openModal() },
            onCreated() {
                this.fetchDailyAppliances().then(() => {
                    this.fetchStatistics()
                })
            },
            getDailyAppliance(name) {
                return this.dailyAppliances.find(candidate => {
                    return candidate.attributes.name === name
                })
            },
            fetchDailyAppliances() {
                const projectId = this.projectId
                const date = this.date

                return window.$.getJSON(
                        '/api/v1' +
                        `/projects/${projectId}` +
                        `/construction-dailies/${date}` +
                        '/appliances'
                ).then(response => {
                    this.store = response
                })
            },
            fetchStatistics() {
                const projectId = this.projectId

                return window.$.getJSON(
                    '/api/v1/statistics' +
                    `/projects/${projectId}` +
                    '/daily-appliances'
                ).then(({appliances}) => {
                    this.statistics = appliances
                })
            }
        },
        ready() {
            this.fetchDailyAppliances().then(() => {
                this.fetchStatistics()
            })
        }
    }
</script>
