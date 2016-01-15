<template>
    <div class="ui multiple selection dropdown" id="vue-dropdown-{{ _uid }}">
        <input type="hidden" name="work_ids">
        <i class="dropdown icon"></i>
        <div class="default text">{{ isEmpty ? emptyText : defaultText }}</div>
        <div class="menu">
            <div
                v-for="work in works"
                class="item"
                v-bind:data-value.once="work.id"
            >
                {{ work.name }}
            </div>
        </div>
    </div>
</template>

<script>
    let getWorks = () => {
        return window.$.getJSON('/api/v1/works')
    }

    export default {
        props: {
            defaultText: {
                required: true
            },
            emptyText: {
                required: true
            }
        },

        computed: {
            isEmpty() {
                return !this.works.length
            }
        },

        data() {
            return {
                default: '',
                works: []
            }
        },

        ready() {
            getWorks().then((response) => {
                this.works = response.works
            })

            window.$(`#vue-dropdown-${this._uid}`).dropdown()
        }
    }
</script>
