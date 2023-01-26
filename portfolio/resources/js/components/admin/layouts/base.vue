<script setup>
    import Header from "./header.vue";
    import Sidebar from "./sidebar.vue";

</script>

<template>
    <div class="base">
        <header></header>
        <sidebar></sidebar>
        <h1>Admin layout</h1>
    </div>
</template>

<script>
export default {
    name: "base"
}
</script>

<style>
@import './base.css';
</style>
