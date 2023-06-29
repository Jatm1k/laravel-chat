<script>
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        user: Object
    }
})
</script>

<template>
    <div class="avatar placeholder">
        <div class="bg-neutral-focus text-neutral-content rounded-full w-12">
            <span>{{ user.name[0] }}</span>
        </div>
    </div>
</template>

<style scoped>

</style>
