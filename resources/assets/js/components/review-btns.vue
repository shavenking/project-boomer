<template>
    <div>
        <div class="ui ordered stackable steps">
            <div class="step" :class="{completed: isComplete(step), active: isActive(step) || isNotStarted(step)}" v-for="step in progress">
                <div class="content">
                    <div class="title">{{ getStepName(step) }}</div>
                    <div class="description" v-if="isComplete(step)">審核完畢</div>
                    <div class="description" v-if="isActive(step)">審核中</div>
                    <div class="description" v-if="isNotStarted(step)">尚未送出審核</div>
                </div>
            </div>
        </div>
        <p>
            <a href="#" class="ui green button" v-show="submit" @click.prevent="createSubmission">送出審核</a>
            <a href="#" class="ui green button" v-show="accept" @click.prevent="acceptSubmission">審核通過</a>
            <a href="#" class="ui red button" v-show="reject" @click.prevent="rejectSubmission">審核失敗</a>
            <a href="#" class="ui red button" v-show="cancel" @click.prevent="cancelSubmission">取消審核</a>
        </p>
    </div>
</template>

<script>
    function getStatus(projectId, resourceType, resourceId) {
        return window.$.get(`/api/v1/projects/${projectId}/review?resource_type=${resourceType}&resource_id=${resourceId}`)
    }

    let progress = {
        'bid': ['cost_manager', 'project_manager'],
        'construction_daily': ['engineer', 'field_engineer', 'project_manager'],
        'project_checklist': ['quality_manager', 'field_engineer', 'project_manager'],
        'fault_improvement': ['quality_manager', 'field_engineer', 'project_manager'],
        'cost_estimation': ['estimation_manager', 'project_manager']
    }

    export default {
        props: ['projectId', 'resourceType', 'resourceId'],
        data() {
            return {
                latestReview: null,
                submit: false,
                accept: false,
                reject: false,
                cancel: false,
                progress: progress[this.resourceType]
            }
        },
        methods: {
            getStepName(stepId) {
                let stepNames = {
                    'general_manager': '總經理',
                    'project_manager': '專案經理',
                    'quality_manager': '品質管理人員',
                    'field_engineer': '工地主任',
                    'cost_manager': '成本控制人員',
                    'estimation_manager': '估驗計價人員',
                    'engineer': '現場工程師'
                }

                return stepNames[stepId]
            },
            isComplete(stepId) {
                if (!this.latestReview) { return false }

                let idxOfCurrentStep = this.progress.indexOf(this.latestReview.role_name),
                    idxOfCandidate = this.progress.indexOf(stepId)

                return (idxOfCandidate <= idxOfCurrentStep)
            },
            isActive(stepId) {
                if (!this.latestReview) { return false }

                let idxOfCurrentStep = this.progress.indexOf(this.latestReview.role_name),
                    idxOfCandidate = this.progress.indexOf(stepId)

                return (idxOfCandidate === idxOfCurrentStep + 1)
            },
            isNotStarted(stepId) {
                let idxOfCandidate = this.progress.indexOf(stepId)

                return (!this.latestReview && (idxOfCandidate === 0))
            },
            createSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/reviews?resource_type=${this.resourceType}&resource_id=${this.resourceId}`).then(() => {
                    this.refreshPage()
                })
            },
            acceptSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/review?resource_type=${this.resourceType}&resource_id=${this.resourceId}&accepted=true`, {_method: 'PUT'}).then(() => {
                    this.refreshPage()
                })
            },
            rejectSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/review?resource_type=${this.resourceType}&resource_id=${this.resourceId}`, {_method: 'PUT'}).then(() => {
                    this.refreshPage()
                })
            },
            cancelSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/review?resource_type=${this.resourceType}&resource_id=${this.resourceId}`, {_method: 'DELETE'}).then(() => {
                    this.refreshPage()
                })
            },
            updateReviewStatus() {
                getStatus(this.projectId, this.resourceType, this.resourceId).then(res => {
                    this.latestReview = res.latestReview
                    this.submit = res.nextSteps.submit
                    this.accept = res.nextSteps.accept
                    this.reject = res.nextSteps.reject
                    this.cancel = res.nextSteps.cancel
                })
            },
            refreshPage() {
                document.location.reload(true)
            }
        },
        ready() {
            this.updateReviewStatus()
        }
    }
</script>
