<script>
import {defineComponent, onMounted} from 'vue'
import useChat from "@/composables/chat.js";

export default defineComponent({
    props: {
        user: Object,
        chat: Object,
    },
    setup(props) {
        const {messages, getMessages} = useChat()

        function allMessages() {
            getMessages(props.chat.id)
        }

        onMounted(allMessages)

        Echo.private('chat')
            .listen('MessageSent', e => {
                messages.value.push({
                    message: e.message.message,
                    user: e.user,
                    created_at: Date.now()
                })
            })

        return {messages}
    },
    methods: {
        getTime(m) {
            const time = new Date(m.created_at)

            const hours = time.getHours().toString().padStart(2, "0"); // Получение часов и форматирование с добавлением ведущего нуля
            const minutes = time.getMinutes().toString().padStart(2, "0"); // Получение минут и форматирование с добавлением ведущего нуля
            return hours + ":" + minutes;
        }
    }
})
</script>

<template>
    <div v-for="message in messages" class="chat" :class="{'chat-start': message.user.id !== user.id, 'chat-end': message.user.id === user.id}">
        <div class="chat-bubble flex flex-col min-w-fit">
            <span class="">{{ message.message }}</span>
            <span class="self-end text-xs ml-8">{{ getTime(message) }}</span>
        </div>
    </div>
</template>

<style scoped>

</style>
