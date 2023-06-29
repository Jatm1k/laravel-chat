<script>
import {defineComponent, reactive} from 'vue'
import useChat from "@/composables/chat.js";

export default defineComponent({
    props: {
        chat: Object,
    },
    setup(props) {
        const form = reactive({
            message: ''
        })

        const {errors, addMessage} = useChat()

        const sendMessage = async () => {
            await addMessage(form, props.chat.id)

            form.message = ''
        }

        return {errors, form, sendMessage}
    }
})
</script>

<template>
    <div class="form-control mb-8 content-end mt-auto">
        <div class="input-group flex">
            <input v-model="form.message" @keyup.enter="sendMessage" type="text" placeholder="Введите сообщение…" class="input input-bordered flex-1" />
            <button class="btn btn-square w-max px-8" @click.prevent="sendMessage">
                Отправить
            </button>
        </div>
        <span class="text-error" v-if="errors">{{ errors?.message?.[0] }}</span>
    </div>
</template>

<style scoped>

</style>
