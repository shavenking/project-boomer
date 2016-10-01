<template>
    <div class="ui basic segment" :class="{ loading: loading }">
        <div class="ui fluid buttons">
            <button class="ui button" :class="{ grey: null === result, disabled: isLocked }" @click="updateResult('null')">未審核</button>
            <button class="ui button" :class="{ green: true === result, disabled: isLocked }" @click="updateResult(1)">通過</button>
            <button class="ui button" :class="{ red: false === result, disabled: isLocked }" @click="updateResult(0)">缺失</button>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['projectId', 'serializedFaultImprovement', 'isLocked'],

        computed: {
            result() {
                return this.faultImprovement.passes
            }
        },

        data(){
            return {
                faultImprovement: JSON.parse(this.serializedFaultImprovement),
                loading: false
            }
        },

        methods: {
            updateResult(result) {
                this.loading = true

                window.$.post(`/api/v1/projects/${this.projectId}/fault-improvements/${this.faultImprovement.id}`, {
                    _method: 'PUT',
                    passes: result
                }).then(rep => {
                    this.faultImprovement.passes = rep.fault_improvement.passes
                    this.loading = false
                })
            }
        }
    }
</script>
