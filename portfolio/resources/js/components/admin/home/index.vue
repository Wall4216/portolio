<script setup>

import {useRouter} from "vue-router";
import Base from "../layouts/base.vue";
const router = useRouter()
const logout = () => {
    localStorage.removeItem('token')
    router.push('/login');
}
</script>

<template>
    <Base></Base>
    <h1>Welcome to admin</h1>
    <div>
    <router-link to="/">Welcome</router-link>
    </div>
    <br>
    <button @click="logout">Выйти</button>
</template>

<script>
export default {
    name: "index"
}
</script>

<style scoped>

</style>
