<template>
    <modal-create-project-checklist :project-id.once="projectId" :on-success.once="onSuccess"></modal-create-project-checklist>
    <modal-create-daily-material :project-id.once="projectId" :on-success.once="onSuccess"></modal-create-daily-material>

    <table class="ui table" v-if="checklists.length">
        <thead>
            <tr>
                <th>施工項目</th>
                <th>施工位置</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="checklist in checklists">
                <td><a href="/projects/{{ projectId }}/works/{{ checklist.project_work.id }}">{{ checklist.project_work.name }}</a></td>
                <td>{{ checklist.seat }}</td>
            </tr>
        </tbody>
    </table>

    <table class="ui table" v-if="dailyMaterials.length">
        <thead>
            <tr>
                <th>材料名稱</th>
                <th>本日使用數量</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dailyMaterial in dailyMaterials">
                <td>{{ dailyMaterial.name }}</td>
                <td>{{ dailyMaterial.amount }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    import ModalCreateProjectChecklist from './modal-create-project-checklist.vue'
    import ModalCreateDailyMaterial from './modal-create-daily-material.vue'
    import { get as getDailyMaterialsByDate } from '../query-helpers/daily-materials'
    import { get } from '../query-helpers/project-checklists'
    import _ from 'lodash'

    export default {
        props: ['projectId', 'date'],

        components: { ModalCreateProjectChecklist, ModalCreateDailyMaterial },

        methods: {
            onSuccess() {
                get(this.projectId, {
                    date: this.date
                }).then(rep => {
                    this.checklists = rep.checklists
                })

                getDailyMaterialsByDate(this.projectId, {
                    date: 'today'
                }).then(rep => {
                    this.dailyMaterials = rep.daily_materials
                })
            }
        },

        data() {
            return {
                checklists: [],
                dailyMaterials: []
            }
        },

        ready() {
            get(this.projectId, {
                date: this.date
            }).then(rep => {
                this.checklists = rep.checklists
            })

            getDailyMaterialsByDate(this.projectId, {
                date: 'today'
            }).then(rep => {
                this.dailyMaterials = rep.daily_materials
            })
        }
    }
</script>
