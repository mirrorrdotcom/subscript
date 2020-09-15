<template>
    <div class="flex items-center py-2">
        <input id="api_token" class="disabled appearance-none  w-full bg-gray-50 text-gray-700 text-sm border border-gray-200 py-2 px-3 leading-tight focus:outline-none focus:bg-white" readonly
               v-model="token"
        />
        <button class="text-sm text-gray-400 hover:text-green-500 hover:no-underline fastest-transition focus:outline-none"
                @click="performGenerate($event)">
            <i :class="[ generateIcon, 'mr-1/2' ]"></i>Generate
        </button>
    </div>
</template>

<script>
    export default {
        name: "generate-token",
        props: {
            generateIcon: {
                required: false,
                type: String,
                default: "uil uil-refresh"
            },
            value: {
                type: String
            }
        },
        data() {
            return {
                token: this.value,
                url: window.location.href
            };
        },
        methods: {
            performGenerate(event) {
                event.preventDefault();
                axios.put(this.url + "/token")
                    .then((response) => {
                        this.token = response.data['token'];
                }).catch(error => {
                    console.log(error.response);
                    console.log(error.response.data);
                });
            },
        }
    }
</script>
