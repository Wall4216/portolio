<script setup>
import {useRouter} from "vue-router";
const router = useRouter()
const logout = () => {
localStorage.removeItem('token')
router.push('/login');
}
</script>
<template>
    <router-view></router-view>
</template>

<script>
export default {
    name: "app"
}
</script>

<style scoped>

</style>
