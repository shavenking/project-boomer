<template>
    <div class="ui basic modal" v-el:modal>
        <div class="content">
            <form action="#" method="POST" class="ui inverted form" @submit="onSubmit" v-el:form>
                <div class="two fields">
                    <div class="field">
                        <div class="label">費用名稱</div>
                        <div class="ui search fluid selection dropdown" v-el:dropdown>
                            <input type="hidden" name="cost_estimation_bounce_id">
                            <i class="dropdown icon"></i>
                            <div class="default text"></div>
                            <div class="menu">
                                <div class="item" v-for="costEstimationBounce in costEstimationBounces" :data-value="costEstimationBounce.id">{{ costEstimationBounce.name }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">單位</div>
                        <unit-select v-ref:unit-dropdown></unit-select>
                    </div>
                    <div class="field">
                        <div class="label">單價</div>
                        <input type="text" name="unit_price">
                    </div>
                    <div class="field">
                        <div class="label">數量</div>
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
    import UnitSelect from './unit-select.vue'
    import pluck from 'lodash/collection/pluck'
    import zipObject from 'lodash/array/zipObject'
    import merge from 'lodash/object/merge'
    import omit from 'lodash/object/omit'
    import isEmpty from 'lodash/lang/isEmpty'

    export default {
        props: ['projectId', 'costEstimationId', 'onSuccess', 'onCancel'],

        components: { UnitSelect },

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

                window.$.post(`/api/v1/projects/${this.projectId}/cost-estimations/${this.costEstimationId}/bounces`, values).then(rep => {
                    if (values.name) {
                        window.$.getJSON(`/api/v1/cost-estimation-bounces`).then(rep => {
                            this.costEstimationBounces = rep.cost_estimation_bounces
                        })
                    }

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
            },
            onNoResults(val) {
                this.$refs.unitDropdown.clear()
                this.name = val

                window.$(this.$els.dropdown).dropdown('clear').dropdown('set text', val)
            },
            onChange(val) {
                this.$refs.unitDropdown.select(val)
                this.name = ''
            }
        },

        data() {
            return {
                'costEstimationBounces': []
            }
        },

        ready() {
            window.$.getJSON(`/api/v1/cost-estimation-bounces`).then(rep => {
                this.costEstimationBounces = rep.cost_estimation_bounces
            })

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