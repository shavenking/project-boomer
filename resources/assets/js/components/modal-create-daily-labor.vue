<template>
    <div class="ui basic modal" v-el:modal>
        <div class="content">
            <form action="#" method="POST" class="ui inverted form" @submit="onSubmit" v-el:form>
                <div class="two fields">
                    <div class="field">
                        <div class="label">工別</div>
                        <div class="ui search fluid selection dropdown" v-el:dropdown>
                            <input type="hidden" name="labor_id">
                            <i class="dropdown icon"></i>
                            <div class="default text"></div>
                            <div class="menu">
                                <div class="item" v-for="labor in labors" :data-value="labor.id">{{ labor.name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">人數</div>
                        <input type="text" name="amount">
                    </div>
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

<script type="text/babel">
    import { getAll, create as createDailyLabor } from '../query-helpers/daily-labors'
    import pluck from 'lodash/collection/pluck'
    import zipObject from 'lodash/array/zipObject'
    import merge from 'lodash/object/merge'
    import omit from 'lodash/object/omit'
    import isEmpty from 'lodash/lang/isEmpty'

    export default {
        props: ['projectId', 'date', 'onSuccess', 'onCancel'],

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
                const projectId = this.projectId
                const date = this.date

                const values = omit(merge(
                    zipObject(pluck(inputs, 'name'), pluck(inputs, 'value')),
                    { name: this.name }
                ), isEmpty);

                // Create new material
                if (values.name) {
                    window.$.post('/api/v1/labors', values).then(response => {
                        this.fetchLabors()
                        window.$.post(
                            '/api/v1' +
                            `/projects/${projectId}` +
                            `/construction-dailies/${date}` +
                            '/labors',
                            {
                                labor_id: response.labor.id,
                                amount: values.amount
                            }
                        ).then(() => {
                            this.onSuccess()
                        })
                    })
                } else {
                    window.$.post(
                        '/api/v1' +
                        `/projects/${projectId}` +
                        `/construction-dailies/${date}` +
                        '/labors',
                        {
                            labor_id: values.labor_id,
                            amount: values.amount
                        }
                    ).then(() => {
                        this.onSuccess()
                    })
                }
            },
            onDeny() {
                this.$els.form.reset()

                if (this.onCancel) {
                    this.onCancel()
                }
            },
            onNoResults(val) {
                this.name = val

                window.$(this.$els.dropdown).dropdown('clear').dropdown('set text', val)
            },
            onChange(val) {
                this.name = ''
            },
            fetchLabors() {
                return (
                    window.$.getJSON('/api/v1/labors').then(rep => {
                        this.labors = rep.labors
                    })
                )
            }
        },

        data() {
            return {
                'labors': []
            }
        },

        ready() {
            this.fetchLabors()

            this.$modal = window.$(this.$els.modal).modal({
                closable: false,
                onApprove: this.onApprove,
                onDeny: this.onDeny
            })

            window.$(this.$els.dropdown).dropdown({
                fullTextSearch: true,
                forceSelection: true,
                onChange: this.onChange,
                onNoResults: this.onNoResults,
                message: {
                    noResults: '新增 {term}'
                }
            })
        }
    }
</script>
