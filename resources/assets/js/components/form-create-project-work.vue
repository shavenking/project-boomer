<template>
    <div class="ui two column stackable grid container">
        <div class="column">
            <form method="POST" :action.once="action" class="ui form">
                <slot></slot>

                <flowtype-work-select
                    select-type-order-label="選擇工程類別與工作項目分類"
                    select-work-label="選擇施工流程"
                    @selected="onWorkSelected"
                ></flowtype-work-select>

                <div class="field">
                    <label>名稱</label>
                    <input type="text" name="name">
                </div>

                <button class="ui primary button" type="submit">新增</button>
                <a :href.once="backUrl" class="ui primary button">返回</a>
                <a :href.once="settingWorkUrl" class="ui primary button">新增標準工作項目</a>
            </form>
        </div>
        <div class="center aligned column">
            <h5>流程圖</h5>
            <workflow-chart v-ref:workflow-chart></workflow-chart>
        </div>
    </div>

</template>

<script type="text/babel">
    import FlowtypeWorkSelect from './flowtype-work-select.vue'
    import WorkflowChart from './workflow-chart.vue'

    export default
        props: ['projectId', 'action', 'backUrl', 'settingWorkUrl'],

        components: { FlowtypeWorkSelect, WorkflowChart },

        methods: {
            onWorkSelected(workId) {
                this.$refs.workflowChart.showByWorkId(workId)
            }
        }
    }
</script>
