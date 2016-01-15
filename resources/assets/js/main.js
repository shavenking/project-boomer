import Vue from 'vue'
import WorkSelect from './components/work-select.vue'
import WorkflowNodes from './components/workflow-nodes.vue'

Vue.config.debug = true

new Vue({
    el: 'body',
    components: { WorkSelect, WorkflowNodes }
})
