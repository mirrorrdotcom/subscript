<template>
    <button class="text-sm text-gray-400 hover:text-orange-900 hover:no-underline fastest-transition focus:outline-none"
            @click="performDelete($event)"
            @blur="blur()">
        <template v-if="!isConfirming"><i :class="[ deleteIcon, 'mr-1/2' ]"></i>Delete</template>
        <template v-else><i :class="[ confirmIcon, 'mr-1/2' ]"></i>Sure?</template>
    </button>
</template>

<script>
    export default {
        name: "delete-button",
        props: {
            deleteIcon: {
                required: false,
                type: String,
                default: "uil uil-trash"
            },
            confirmIcon: {
                required: false,
                type: String,
                default: "uil uil-question-circle"
            }
        },
        data() {
            return {
                isConfirming: false
            };
        },
        methods: {
            performDelete(event) {
                if (!this.isConfirming) {
                    event.preventDefault();
                    this.isConfirming = true;
                    return;
                }

                this.isConfirming = !this.isConfirming;
            },
            blur() {
                if (this.isConfirming)
                    this.isConfirming = false;
            }
        }
    }
</script>
