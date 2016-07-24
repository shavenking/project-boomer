<template>
    <div>
        <table class="ui table">
            <thead>
                <tr>
                    <th>材料名稱</th>
                    <th>本日使用數量</th>
                    <th>累積使用數量</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="amountAndName in statistics">
                    <td>{{ amountAndName.name }}</td>
                    <td>{{ getDailyMaterial(amountAndName.name) ? getDailyMaterial(amountAndName.name).attributes.amount : 0 }}</td>
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

        <modal-create-daily-material
            :project-id="projectId"
            :date="date"
            :on-success="onCreated"
            v-ref:modal
        ></modal-create-daily-material>
    </div>
</template>

<script>
    import ModalCreateDailyMaterial from './modal-create-daily-material.vue'
    export default {
        props: ['projectId', 'date'],
        components: { ModalCreateDailyMaterial },
        data() {
            return {
                store: null,
                statistics: null
            }
        },
        computed: {
            dailyMaterials() {
                return this.$get('store.data')
            }
        },
        methods: {
            openModal() { this.$refs.modal.openModal() },
            onCreated() {
                this.fetchDailyMaterials().then(() => {
                    this.fetchStatistics()
                })
            },
            getDailyMaterial(name) {
                return this.dailyMaterials.find(candidate => {
                    return candidate.attributes.name === name
                })
            },
            fetchDailyMaterials() {
                const projectId = this.projectId
                const date = this.date

                return window.$.getJSON(
                        '/api/v1' +
                        `/projects/${projectId}` +
                        `/construction-dailies/${date}` +
                        '/materials'
                ).then(response => {
                    this.store = response
                })
            },
            fetchStatistics() {
                const projectId = this.projectId

                return window.$.getJSON(
                    '/api/v1/statistics' +
                    `/projects/${projectId}` +
                    '/daily-materials'
                ).then(({materials}) => {
                    this.statistics = materials
                })
            }
        },
        ready() {
            this.fetchDailyMaterials().then(() => {
                this.fetchStatistics()
            })
        }
    }
</script>
