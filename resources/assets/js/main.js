import Vue from 'vue'
import WorkSelect from './components/work-select.vue'
import FlowtypeSelect from './components/flowtype-select.vue'
import UnitSelect from './components/unit-select.vue'
import WorkflowSelect from './components/workflow-select.vue'
import WorkflowNodes from './components/workflow-nodes.vue'
import WorkitemList from './components/workitem-list.vue'
import Checklist from './components/checklist.vue'
import FlowtypeWorkSelect from './components/flowtype-work-select.vue'
import TableProjectWorks from './components/table-project-works.vue'
import TableWorkitems from './components/table-workitems.vue'
import StatisticsWorkitems from './components/statistics-workitems.vue'
import ProjectWorkitemList from './components/project-workitem-list.vue'
import ProjectFlowtypeWorkSelect from './components/project-flowtype-work-select.vue'
import ModalCreateProjectChecklist from './components/modal-create-project-checklist.vue'
import ConstructionDaily from './components/construction-daily.vue'

new Vue({
    el: 'body',
    components: {
        WorkSelect,
        WorkflowNodes,
        FlowtypeSelect,
        UnitSelect,
        WorkflowSelect,
        WorkitemList,
        Checklist,
        FlowtypeWorkSelect,
        TableProjectWorks,
        TableWorkitems,
        StatisticsWorkitems,
        ProjectWorkitemList,
        ProjectFlowtypeWorkSelect,
        ModalCreateProjectChecklist,
        ConstructionDaily
    }
})
