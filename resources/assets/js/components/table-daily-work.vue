<template>
    <div>
        <table class="ui table">
            <thead>
                <th>工作項目</th>
                <th>施工位置</th>
                <th>協力廠商</th>
                <th>查核與否</th>
                <th>查核數量</th>
            </thead>
            <tbody>
                <tr v-for="dailyWork in dailyWorks">
                    <td>{{ dailyWork.attributes.name }}</td>
                    <td>{{ dailyWork.attributes.seat }}</td>
                    <td>{{ getSubcontractor(dailyWork).attributes.name }}</td>
                    <td>{{ getChecklist(dailyWork).attributes.is_checked_finished ? '查核完畢' : '未查核完畢' }}</td>
                    <td>{{ getChecklist(dailyWork).attributes.passes_amount }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">
                        <button class="ui right floated primary button" :class="{disabled: isLocked}" @click="openModal">新增施工項目</button>
                    </th>
                </tr>
            </tfoot>
        </table>

        <modal-create-daily-work :project-id="projectId" :date="date" :on-success="onCreated" v-ref:modal></modal-create-daily-work>
    </div>
</template>

<script>
    import ModalCreateDailyWork from './modal-create-daily-work.vue'

    export default {
        props: ['projectId', 'date', 'isLocked'],
        components: { ModalCreateDailyWork },
        data() {
            return {
                dailyWorkStore: {}
            }
        },
        computed: {
            dailyWorks() {
                return this.$get('dailyWorkStore.data')
            },
            included() {
                return this.$get('dailyWorkStore.included')
            }
        },
        methods: {
            getSubcontractor(dailyWork) {
                const subcontractor = dailyWork.relationships.subcontractor.data

                return this.included.find(candidate => {
                    return (
                        'subcontractor' === candidate.type
                        && subcontractor.id === candidate.id
                    )
                })
            },
            getChecklist(dailyWork) {
                const checklist = dailyWork.relationships.projectChecklist.data

                return this.included.find(candidate => {
                    return (
                        'project_checklist' === candidate.type
                        && checklist.id === candidate.id
                    )
                })
            },
            onCreated() {
                this.fetchDailyWorks()
            },
            fetchDailyWorks() {
                const projectId = this.projectId
                const date = this.date

                window.$.getJSON(
                        '/api/v1' +
                        `/projects/${projectId}` +
                        `/construction-dailies/${date}` +
                        '/works'
                ).then(response => {
                    this.dailyWorkStore = response
                })
            },
            openModal() {
                this.$refs.modal.openModal()
            }
        },
        ready() {
            this.fetchDailyWorks()
        }
    }
</script>
