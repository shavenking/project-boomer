<template>
    <div class="ui fluid buttons" v-el:tabular-menu>
      <a href="#" class="ui button active" data-tab="project-checklists">當日工作項目、位置</a>
      <a href="#" class="ui button" data-tab="daily-materials">當日材料使用數量</a>
      <a href="#" class="ui button" data-tab="daily-labors">當日出工人數</a>
      <a href="#" class="ui button" data-tab="daily-appliances">當日機具使用情形</a>
      <a href="#" class="ui button" data-tab="daily-records">備註</a>
    </div>

    <div class="ui hidden divider"></div>

    <div class="ui tab active" data-tab="project-checklists">
        <table class="ui table">
            <thead>
                <tr>
                    <th>工作項目</th>
                    <th>施工位置</th>
                    <th>協力廠商</th>
                    <th>查核與否</th>
                    <th>查核數量</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!checklists.length">
                    <td colspan="5">
                        <empty-message></empty-message>
                    </td>
                </tr>
                <tr v-for="checklist in checklists">
                    <td><a href="/projects/{{ projectId }}/checklists/{{ checklist.project_work.id }}">{{ checklist.project_work.name }}</a></td>
                    <td>{{ checklist.seat }}</td>
                    <td>{{ checklist.subcontractor.name }}</td>
                    <td>{{ checklist.passes ? '查核完畢' : '未查核完畢' }}</td>
                    <td>{{ checklist.passes_amount }}</td>
                </tr>
            </tbody>
            <tfoot v-if="!disabled">
                <tr>
                    <th colspan="5">
                        <button class="ui right floated primary button" @click="openModal('checklistModal')">
                            <i class="plus icon"></i>新增
                        </button>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="ui tab" data-tab="daily-materials">
        <table class="ui table">
            <thead>
                <tr>
                    <th>材料名稱</th>
                    <th>本日使用數量</th>
                    <th>累積使用數量</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!dailyMaterials.length">
                    <td colspan="3">
                        <empty-message></empty-message>
                    </td>
                </tr>
                <tr v-for="dailyMaterial in dailyMaterials">
                    <td>{{ dailyMaterial.name }}</td>
                    <td>{{ dailyMaterial.amount }}</td>
                    <td>{{ totalAmount[dailyMaterial.material_id] }}</td>
                </tr>
            </tbody>
            <tfoot v-if="!disabled">
                <tr>
                    <th colspan="3">
                        <button class="ui right floated primary button" @click="openModal('dailyMaterialModal')">
                            <i class="plus icon"></i>新增
                        </button>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="ui tab" data-tab="daily-labors">
        <table class="ui table">
            <thead>
                <tr>
                    <th>工別</th>
                    <th>人數</th>
                    <th>累積人數</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!dailyLabors.length">
                    <td colspan="3">
                        <empty-message></empty-message>
                    </td>
                </tr>
                <tr v-for="dailyLabor in dailyLabors">
                    <td>{{ dailyLabor.name }}</td>
                    <td>{{ dailyLabor.amount }}</td>
                    <td>{{ laborTotalAmount[dailyLabor.labor_id] }}</td>
                </tr>
            </tbody>
            <tfoot v-if="!disabled">
                <tr>
                    <th colspan="3">
                        <button class="ui right floated primary button" @click="openModal('dailyLaborModal')">
                            <i class="plus icon"></i>新增
                        </button>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="ui tab" data-tab="daily-appliances">
        <table class="ui table">
            <thead>
                <tr>
                    <th>機具</th>
                    <th>數量</th>
                    <th>累積數量</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!dailyAppliances.length">
                    <td colspan="3">
                        <empty-message></empty-message>
                    </td>
                </tr>
                <tr v-for="dailyAppliance in dailyAppliances">
                    <td>{{ dailyAppliance.name }}</td>
                    <td>{{ dailyAppliance.amount }}</td>
                    <td>{{ applianceTotalAmount[dailyAppliance.appliance_id] }}</td>
                </tr>
            </tbody>
            <tfoot v-if="!disabled">
                <tr>
                    <th colspan="3">
                        <button class="ui right floated primary button" @click="openModal('dailyApplianceModal')">
                            <i class="plus icon"></i>新增
                        </button>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="ui tab" data-tab="daily-records">
        <table class="ui table">
            <thead>
                <tr>
                    <th>主辦單位、監造單位指示</th>
                    <th>重要事項紀錄</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!dailyRecords">
                    <td colspan="2">
                        <empty-message></empty-message>
                    </td>
                </tr>
                <tr v-if="dailyRecords">
                    <td>{{ dailyRecords['inspection_record'] }}</td>
                    <td>{{ dailyRecords['important_record'] }}</td>
                </tr>
            </tbody>
            <tfoot v-if="!disabled">
                <tr>
                    <th colspan="2">
                        <button class="ui right floated primary button" @click="openModal('dailyRecordModal')">
                            <i class="plus icon"></i>新增
                        </button>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    <modal-create-project-checklist :project-id.once="projectId" :on-success.once="onSuccess" v-ref:checklist-modal></modal-create-project-checklist>
    <modal-create-daily-material :project-id.once="projectId" :on-success.once="onSuccess" v-ref:daily-material-modal></modal-create-daily-material>
    <modal-create-daily-labor :project-id.once="projectId" :on-success.once="onSuccess" v-ref:daily-labor-modal></modal-create-daily-labor>
    <modal-create-daily-appliance :project-id.once="projectId" :on-success.once="onSuccess" v-ref:daily-appliance-modal></modal-create-daily-appliance>
    <modal-create-daily-record :project-id.once="projectId" :on-success.once="onSuccess" v-ref:daily-record-modal></modal-create-daily-record>
</template>

<style>
    .pm-visibility-hidden {
        position: absolute;
        tabindex: -1;
        left: -999999px;
    }
</style>

<script type="text/babel">
    import ModalCreateProjectChecklist from './modal-create-project-checklist.vue'
    import ModalCreateDailyMaterial from './modal-create-daily-material.vue'
    import ModalCreateDailyLabor from './modal-create-daily-labor.vue'
    import ModalCreateDailyAppliance from './modal-create-daily-appliance.vue'
    import ModalCreateDailyRecord from './modal-create-daily-record.vue'
    import { get as getDailyMaterialsByDate, getTotalAmount } from '../query-helpers/daily-materials'
    import { get as getDailyLaborsByDate, getTotalAmount as getLaborTotalAmount } from '../query-helpers/daily-labors'
    import { get as getDailyAppliancesByDate, getTotalAmount as getApplianceTotalAmount } from '../query-helpers/daily-appliances'
    import { get as getDailyRecords } from '../query-helpers/daily-records'
    import { get } from '../query-helpers/project-checklists'
    import EmptyMessage from '../presentation-layer/empty-message.vue'
    import _ from 'lodash'
    import moment from 'moment'

    export default {
        props: ['projectId', 'date'],

        components: { EmptyMessage, ModalCreateProjectChecklist, ModalCreateDailyMaterial, ModalCreateDailyLabor, ModalCreateDailyAppliance, ModalCreateDailyRecord },

        computed: {
            disabled() {
                if (
                    'today' === this.date
                    || moment().isSame(moment(this.date), 'day')
                ) {
                    return false
                }

                return true
            }
        },

        methods: {
            openModal(target) {
                this.$refs[target].openModal()
            },
            onSuccess() {
                get(this.projectId, {
                    date: this.date
                }).then(rep => {
                    this.checklists = rep.checklists
                })

                getDailyMaterialsByDate(this.projectId, {
                    date: this.date
                }).then(rep => {
                    this.dailyMaterials = rep.daily_materials
                })

                getTotalAmount(this.projectId).then(rep => {
                    this.totalAmount = rep.total_amount
                })

                getDailyLaborsByDate(this.projectId, {
                    date: this.date
                }).then(rep => {
                    this.dailyLabors = rep.daily_labors
                })

                getLaborTotalAmount(this.projectId).then(rep => {
                    this.laborTotalAmount = rep.total_amount
                })

                getDailyAppliancesByDate(this.projectId, {
                    date: this.date
                }).then(rep => {
                    this.dailyAppliances = rep.daily_appliances
                })

                getApplianceTotalAmount(this.projectId).then(rep => {
                    this.applianceTotalAmount = rep.total_amount
                })

                getDailyRecords(this.projectId, {
                    date: this.date
                }).then(rep => {
                    this.dailyRecords = rep.daily_records
                })
            }
        },

        data() {
            return {
                checklists: [],
                dailyMaterials: [],
                dailyLabors: [],
                dailyAppliances: [],
                totalAmount: {},
                laborTotalAmount: {},
                applianceTotalAmount: {},
                dailyRecords: {}
            }
        },

        ready() {
            window.$(this.$els.tabularMenu).children('.button').tab()

            get(this.projectId, {
                date: this.date
            }).then(rep => {
                this.checklists = rep.checklists
            })

            getDailyMaterialsByDate(this.projectId, {
                date: this.date
            }).then(rep => {
                this.dailyMaterials = rep.daily_materials
            })

            getTotalAmount(this.projectId).then(rep => {
                this.totalAmount = rep.total_amount
            })

            getDailyLaborsByDate(this.projectId, {
                date: this.date
            }).then(rep => {
                this.dailyLabors = rep.daily_labors
            })

            getLaborTotalAmount(this.projectId).then(rep => {
                this.laborTotalAmount = rep.total_amount
            })

            getDailyAppliancesByDate(this.projectId, {
                date: this.date
            }).then(rep => {
                this.dailyAppliances = rep.daily_appliances
            })

            getApplianceTotalAmount(this.projectId).then(rep => {
                this.applianceTotalAmount = rep.total_amount
            })

            getDailyRecords(this.projectId, {
                date: this.date
            }).then(rep => {
                this.dailyRecords = rep.daily_records
            })
        }
    }
</script>
