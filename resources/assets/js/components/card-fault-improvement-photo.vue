<template>
    <div class="ui basic segment" :class="{ loading: loading }">
        <div class="ui fluid card">
            <div class="content">
                <div class="header">
                    {{* header }}
                    <a href="#" class="ui right floated" v-el:file-upload>上傳照片</a>
                </div>
            </div>
            <div class="image">
                <img :src="url" :alt.once="header" v-if="photoName">
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
            url() {
                return `/images/${this.photoName}`
            }
        },

        data(){
            return {
                faultImprovement: JSON.parse(this.serializedFaultImprovement),
                loading: false
            }
        },

        ready() {
            new Dropzone(this.$els.fileUpload, {
                url: `/api/v1/projects/${this.projectId}/fault-improvements/${this.faultImprovement.id}/photos/${this.step}`,
                uploadMultiple: false,
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