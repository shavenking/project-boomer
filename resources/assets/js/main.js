import Vue from 'vue'
import WorkSelect from './components/work-select.vue'
import FlowtypeSelect from './components/flowtype-select.vue'
import UnitSelect from './components/unit-select.vue'
import WorkflowSelect from './components/workflow-select.vue'
import SubcontractorSelect from './components/subcontractor-select.vue'
import WorkflowNodes from './components/workflow-nodes.vue'
import WorkitemList from './components/workitem-list.vue'
import Checklist from './components/checklist.vue'
import FlowtypeWorkSelect from './components/flowtype-work-select.vue'
import TableProjectWorks from './components/table-project-works.vue'
import TableWorkitems from './components/table-workitems.vue'
import StatisticsWorkitems from './components/statistics-workitems.vue'
import ProjectWorkitemList from './components/project-workitem-list.vue'
import ProjectFlowtypeWorkSelect from './components/project-flowtype-work-select.vue'
import ConstructionDaily from './components/construction-daily.vue'
import CostEstimationSheet from './components/cost-estimation-sheet.vue'
import FormCreateProjectWork from './components/form-create-project-work.vue'
import ModalProjectMenu from './presentation-layer/modal-project-menu.vue'
import CardFaultImprovementPhoto from './components/card-fault-improvement-photo.vue'
import ButtonsFaultImprovementResult from './components/buttons-fault-improvement-result.vue'
import InputDate from './components/input-date.vue'

new Vue({
    el: 'body',
    components: {
        WorkSelect,
        WorkflowNodes,
        FlowtypeSelect,
        UnitSelect,
        WorkflowSelect,
        SubcontractorSelect,
        WorkitemList,
        Checklist,
        FlowtypeWorkSelect,
        TableProjectWorks,
        TableWorkitems,
        StatisticsWorkitems,
        ProjectWorkitemList,
        ProjectFlowtypeWorkSelect,
        ConstructionDaily,
        CostEstimationSheet,
        FormCreateProjectWork,
        ModalProjectMenu,
        CardFaultImprovementPhoto,
        ButtonsFaultImprovementResult,
        InputDate
    }
})
