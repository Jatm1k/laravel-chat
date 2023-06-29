import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import ChatMessages from "@/Components/ChatMessages.vue";
import ChatForm from "@/Components/ChatForm.vue";
import ChatAdd from "@/Components/ChatAdd.vue";
import ChatList from "@/Components/ChatList.vue";
import AuthHeader from "@/Components/AuthHeader.vue";

const app = createApp({
    components: {
        ChatMessages,
        ChatForm,
        ChatAdd,
        ChatList,
        AuthHeader,
    }
})

app.mount('#app')
