<template>
    <div
        class="ui fluid selection dropdown"
        :class="{ 'multiple': multiple, 'disabled': isEmpty }"
        id="vue-dropdown-select-{{ _uid }}"
    >
        <input type="hidden" v-bind:name="inputName">
        <i class="dropdown icon"></i>
        <div class="default text"></div>
        <div class="menu">
            <div
                v-for="option in options"
                class="item"
                v-bind:data-value.once="option[optionValueName]"
            >
                {{ option[optionTextName] }}
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        props: {
            inputName: {
                required: true,
                type: String
            },
            options: {
                required: true,
                type: Array
            },
            optionValueName: {
                required: true,
                type: String
            },
            optionTextName: {
                required: true,
                type: String
            },
            multiple: {
                default: false,
                type: Boolean
            }
        },

        methods: {
            select(value) {
                this._dropdown.dropdown('refresh')
                this._dropdown.dropdown('set selected', [value])
            },
            clear() {
                this._dropdown.dropdown('clear')
            }
        },

        events: {
            optionsUpdated() {
                this._dropdown.dropdown('refresh')
                this._dropdown.dropdown('clear')
            }
        },

        computed: {
            isEmpty() {
                return !this.options.length
            }
        },

        ready() {
            this._dropdown = window.$(`#vue-dropdown-select-${this._uid}`).dropdown({
                onChange: (value) => {
                    this.$dispatch('selected', value)
                }
            })
        }
    }
</script>
