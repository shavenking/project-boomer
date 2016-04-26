<template>
    <div class="ui basic modal" v-el:modal>
        <div class="content">
            <form action="#" method="POST" class="ui inverted form" @submit="onSubmit" v-el:form>
                <h4 class="ui inverted dividing header">選擇施工工項</h4>
                <project-flowtype-work-select :project-id.once="projectId"></project-flowtype-work-select>

                <h4 class="ui inverted dividing header">自定檢查表名稱</h4>
                <div class="field">
                    <input type="text" name="name">
                </div>

                <h4 class="ui inverted dividing header">施工部位</h4>
                <div class="field">
                    <input type="text" name="seat">
                </div>

                <h4 class="ui inverted dividing header">選擇協力廠商</h4>
                <div class="field">
                    <subcontractor-select></subcontractor-select>
                </div>

                <button type="submit" class="pm-visibility-hidden"></button>
            </form>
        </div>
        <div class="actions">
            <div class="ui green inverted ok button">
                <i class="checkmark icon"></i>
                送出
            </div>
            <div class="ui inverted cancel button">
                <i class="remove icon"></i>
                取消
            </div>
        </div>
    </div>
</template>

<script>
    import { create as createChecklist } from '../query-helpers/project-checklists'
    import ProjectFlowtypeWorkSelect from './project-flowtype-work-select.vue'
    import SubcontractorSelect from './subcontractor-select.vue'
    import pluck from 'lodash/collection/pluck'
    import zipObject from 'lodash/array/zipObject'

    export default {
        props: ['projectId', 'onSuccess', 'onCancel'],

        components: { ProjectFlowtypeWorkSelect, SubcontractorSelect },

        methods: {
            openModal() {
                this.$modal.modal('show')
            },
            onSubmit(e) {
                e.preventDefault()

                this.onApprove()

                window.$(this.$els.modal).modal('hide')
            },
            onApprove() {
                const inputs = window.$(this.$els.form).serializeArray()

                const values = zipObject(pluck(inputs, 'name'), pluck(inputs, 'value'))

                createChecklist(this.projectId, values).then(response => {
                    this.$els.form.reset()

                    if (this.onSuccess) {
                        this.onSuccess()
                    }
                })
            },
            onDeny() {
                this.$els.form.reset()

                if (this.onCancel) {
                    this.onCancel()
                }
            }
        },

        ready() {
            this.$modal = window.$(this.$els.modal).modal({
                closable: false,
                onApprove: this.onApprove,
                onDeny: this.onDeny
            })
        }
    }
</script>
