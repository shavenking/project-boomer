<template>
    <div class="ui basic segment" :class="{ loading: loading }">
        <div class="ui fluid card">
            <div class="content">
                <div class="header">
                    {{* header }}
                    <div class="ui right floated blue label" style="cursor: pointer;" v-el:file-upload>上傳照片</div>
                </div>
            </div>
            <div class="image">
                <img :src="url" :alt.once="header" v-if="photoName">
            </div>
            <div class="extra content">
                <p v-show="notes">備註：{{ notes }}</p>
                <div class="ui fluid labeled action input" v-show="!notes">
                    <div class="ui label">備註：</div>
                    <input type="text" name="new_notes" v-model="newNotes">
                    <button class="ui primary button" @click="saveNotes">儲存</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import Dropzone from '../vendor/dropzone'

    export default {
        props: ['projectId', 'serializedFaultImprovement', 'header', 'step'],

        computed: {
            photoName() {
                return this.faultImprovement[`${this.step}_photo`]
            },
            notes() {
                return this.faultImprovement[`${this.step}_notes`]
            },
            url() {
                return `/images/${this.photoName}`
            }
        },

        data(){
            return {
                faultImprovement: JSON.parse(this.serializedFaultImprovement),
                loading: false,
                newNotes: null
            }
        },

        methods: {
            saveNotes() {
                window.$.post(`/api/v1/projects/${this.projectId}/fault-improvements/${this.faultImprovement.id}`, {
                    _method: 'PUT',
                    [`${this.step}_notes`]: this.newNotes
                }).then(() => {
                    this.faultImprovement[`${this.step}_notes`] = this.newNotes
                })
            }
        },

        ready() {
            new Dropzone(this.$els.fileUpload, {
                url: `/api/v1/projects/${this.projectId}/fault-improvements/${this.faultImprovement.id}/photos/${this.step}`,
                uploadMultiple: false,
                maxFiles: 1,
                createImageThumbnails: false,
                addedfile(file) {},
                success: (file, rep) => {
                    this.faultImprovement[`${this.step}_photo`] = rep.photo
                },
                sending: () => {
                    this.loading = true
                },
                complete: () => {
                    this.loading = false
                }
            })
        }
    }
</script>
