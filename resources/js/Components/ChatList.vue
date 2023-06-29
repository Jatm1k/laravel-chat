<script>
import {defineComponent, onMounted} from 'vue'
import useChat from "@/composables/chat.js";
import Avatar from "@/UI/Avatar.vue";

export default defineComponent({
    components: {Avatar},
    props: {
        user: Object,
    },
    setup() {
        const {chats, getChats, deleteChat} = useChat()

        onMounted(getChats)

        Echo.private('chat')
            .listen('AddedChat', e => {
                chats.value.push({
                    first_user: e.first_user,
                    second_user: e.second_user,
                    id: e.chat.id
                })
            })

        return {chats, deleteChat}
    },
    methods: {
        companion(chat) {
            return this.user.id !== chat.first_user?.id ? chat.first_user : chat.second_user
        },
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
    <a :href="`/chats/${chat.id}/`" class="chat flex gap-8 items-center p-4 rounded-2xl hover:bg-base-300" v-for="chat in chats" :key="chat.id">
        <Avatar :user="companion(chat)"/>
        <span class="chat-content flex flex-col">
            <span class="name font-bold">{{ companion(chat).name }}</span>
            <span class="message">
                <span class="name font-bold">
                {{ user.id === chat.messages[0]?.user_id ? 'Вы: ' : '' }}
                </span>
                {{ chat.messages[0]?.message ?? '...' }} {{ getTime(chat.messages[0]) }}
            </span>
        </span>
        <div class="dropdown ml-auto" @click.prevent>
            <label tabindex="0" class="btn m-1 bg-inherit border-none"><i class='bx bx-dots-vertical-rounded'></i></label>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                <li><a @click.prevent="deleteChat(chat.id)">Удалить</a></li>
            </ul>
        </div>
    </a>
</template>

<style scoped>

</style>
