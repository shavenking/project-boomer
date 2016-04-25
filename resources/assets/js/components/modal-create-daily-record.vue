<template>
    <div class="ui basic modal" v-el:modal>
        <div class="content">
            <form action="#" method="POST" class="ui inverted form" @submit="onSubmit" v-el:form>
                <div class="two fields">
                    <div class="field">
                        <div class="label">檢查紀錄</div>
                        <textarea name="check_record" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="field">
                        <div class="label">重要紀錄</div>
                        <textarea name="important_record" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <button type="submit" class="hidden"></button>
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
    import { create } from '../query-helpers/daily-records'
    import pluck from 'lodash/collection/pluck'
    import zipObject from 'lodash/array/zipObject'
    import merge from 'lodash/object/merge'
    import omit from 'lodash/object/omit'
    import isEmpty from 'lodash/lang/isEmpty'

    export default {
        props: ['projectId', 'onSuccess', 'onCancel'],

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

                const values = omit(merge(
                    zipObject(pluck(inputs, 'name'), pluck(inputs, 'value')),
                    { name: this.name }
                ), isEmpty);

                create(this.projectId, values).then(response => {
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

        data() {
            return {}
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
