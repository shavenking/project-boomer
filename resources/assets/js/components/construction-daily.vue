<template>
    <div>
        <h3 class="header">當日工作項目、位置</h3>
        <table-daily-work
            :project-id="projectId"
            :date="date"
        ></table-daily-work>

        <h3 class="header">當日材料使用情形</h3>
        <table-daily-material
            :project-id="projectId"
            :date="date"
        ></table-daily-material>

        <h3 class="header">當日出工人數情形</h3>
        <table-daily-labor
            :project-id="projectId"
            :date="date"
        ></table-daily-labor>

        <h3 class="header">當日機具使用情形</h3>
        <table-daily-appliance
            :project-id="projectId"
            :date="date"
        ></table-daily-appliance>

        <table class="ui table">
            <thead>
                <tr>
                    <th>主辦單位、監造單位指示</th>
                    <th>重要事項紀錄</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ constructionDaily.inspection_record }}</td>
                    <td>{{ constructionDaily.important_record }}</td>
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

        <modal-create-daily-record
            :project-id="projectId"
            :date="date"
            :on-success="onCreated"
            v-ref:modal
        ></modal-create-daily-record>
    </div>
</template>

<style>
    .pm-visibility-hidden {
        position: absolute;
        tabindex: -1;
        left: -999999px;
    }
</style>

<script type="text/babel">
    import TableDailyWork from './table-daily-work.vue'
    import TableDailyMaterial from './table-daily-material.vue'
    import TableDailyLabor from './table-daily-labor.vue'
    import TableDailyAppliance from './table-daily-appliance.vue'
    import ModalCreateDailyRecord from './modal-create-daily-record.vue'

    export default {
        props: ['projectId', 'date'],
        components: { TableDailyWork, TableDailyMaterial, TableDailyLabor, TableDailyAppliance, ModalCreateDailyRecord },
        data() {
            return {
                constructionDaily: null
            }
        },
        methods: {
            openModal() { this.$refs.modal.openModal() },
            fetchConstructionDaily() {
                const projectId = this.projectId
                const date = this.date

                return window.$.getJSON(
                    '/api/v1' +
                    `/projects/${projectId}` +
                    `/construction-dailies/${date}`
                ).then(rep => {
                    this.constructionDaily = rep.constructionDaily
                })
            },
            onCreated() {
                this.fetchConstructionDaily()
            }
        },
        ready() {
            this.fetchConstructionDaily()
        }
    }
</script>
