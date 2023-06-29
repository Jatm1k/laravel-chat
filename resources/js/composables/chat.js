import {ref} from "vue";
import axios from "axios";

export default function useChat() {
    const messages = ref([])
    const errors = ref([])
    const chats = ref([])

    const getMessages = async (chatId) => {
        await axios.get(`/chats/${chatId}/messages`).then(res=>{
            messages.value = res.data
        })
    }

    const getChats = async () => {
        await axios.get('/chats/all').then(res=>{
            chats.value = res.data
        })
    }

    const addMessage = async (form, chatId) => {
        errors.value = []

        try {
            await axios.post(`/chats/${chatId}/send`, form).then(res => {
                messages.value.push(res.data)
            })
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const addChat = async (form) => {
        errors.value = []

        try {
            await axios.post('/chats', form).then(res => {
                chats.value.push(res.data)
            })
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const deleteChat = async (chatId) => {
        await axios.delete(`/chats/${chatId}`).then(res=>{
            getChats()
        })
    }

    return {
        messages,
        errors,
        chats,
        addChat,
        getChats,
        addMessage,
        getMessages,
        deleteChat,
    }
}
