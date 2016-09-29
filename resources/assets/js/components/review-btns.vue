<template>
    <div>
        <a href="#" class="ui green button" v-show="submit" @click.prevent="createSubmission">送出審核</a>
        <a href="#" class="ui button disabled" v-show="!latestReview && !submit">送出審核</a>
        <a href="#" class="ui button disabled" v-show="latestReview.status === 'submitted' && !accept && !reject">等待審核</a>
        <a href="#" class="ui button disabled" v-show="latestReview.status === 'accepted' && !cancel && !accept && !reject && !submit">等待審核</a>
        <a href="#" class="ui green button" v-show="accept" @click.prevent="acceptSubmission">審核通過</a>
        <a href="#" class="ui red button" v-show="reject" @click.prevent="rejectSubmission">審核失敗</a>
        <a href="#" class="ui disabled green button" v-show="latestReview.status === 'finished'">審核完成</a>
        <a href="#" class="ui red button" v-show="cancel" @click.prevent="cancelSubmission">取消審核</a>
    </div>
</template>

<script>
    function getStatus(projectId, resourceType, resourceId) {
        return window.$.get(`/api/v1/projects/${projectId}/review?resource_type=${resourceType}&resource_id=${resourceId}`)
    }

    export default {
        props: ['projectId', 'resourceType', 'resourceId'],
        data() {
            return {
                latestReview: null,
                submit: false,
                accept: false,
                reject: false,
                cancel: false
            }
        },
        methods: {
            createSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/reviews?resource_type=${this.resourceType}&resource_id=${this.resourceId}`).then(() => {
                    this.updateReviewStatus()
                })
            },
            acceptSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/review?resource_type=${this.resourceType}&resource_id=${this.resourceId}&accepted=true`, {_method: 'PUT'}).then(() => {
                    this.updateReviewStatus()
                })
            },
            rejectSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/review?resource_type=${this.resourceType}&resource_id=${this.resourceId}`, {_method: 'PUT'}).then(() => {
                    this.updateReviewStatus()
                })
            },
            cancelSubmission() {
                window.$.post(`/api/v1/projects/${this.projectId}/review?resource_type=${this.resourceType}&resource_id=${this.resourceId}`, {_method: 'DELETE'}).then(() => {
                    this.updateReviewStatus()
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
            }
        },
        ready() {
            this.updateReviewStatus()
        }
    }
</script>
