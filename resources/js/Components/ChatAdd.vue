<script>
import {defineComponent, reactive} from 'vue'
import useChat from "@/composables/chat.js";

export default defineComponent({
    setup() {
        const form = reactive({
            email: ''
        })

        const {errors, addChat} = useChat()

        const storeChat = async () => {
            await addChat(form)

            form.email = ''
        }

        return {errors, form, storeChat}
    }
})
</script>

<template>
    <div class="form-control mb-8 content-end mt-8">
        <div class="input-group flex">
            <input v-model="form.email" @keyup.enter="storeChat" type="text" placeholder="Введите email…" class="input input-bordered flex-1" />
            <button class="btn btn-square w-max px-8" @click.prevent="storeChat">
                Добавить
            </button>
        </div>
        <span class="text-error" v-if="errors">{{ errors?.email?.[0] }}</span>
    </div>
</template>

<style scoped>

</style>
