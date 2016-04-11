<template>
    <modal-create-project-checklist :project-id.once="projectId" :on-success.once="onSuccess"></modal-create-project-checklist>
    <table class="ui table">
        <thead>
            <tr>
                <th>施工項目</th>
                <th>施工位置</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="checklist in checklists">
                <td>{{ checklist.name }}</td>
                <td>{{ checklist.seat }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import ModalCreateProjectChecklist from './modal-create-project-checklist.vue'
    import { get } from '../query-helpers/project-checklists'

    export default {
        props: ['projectId', 'date'],

        components: { ModalCreateProjectChecklist },

        methods: {
            onSuccess() {
                get(this.projectId, {
                    date: this.date
                }).then(rep => {
                    this.checklists = rep.checklists
                })
            }
        },

        data() {
            return {
                checklists: []
            }
        },

        ready() {
            get(this.projectId, {
                date: this.date
            }).then(rep => {
                this.checklists = rep.checklists
            })
        }
    }
</script>
