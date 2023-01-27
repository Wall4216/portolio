<script setup>
    import Header from "./header.vue";
    import Sidebar from "./sidebar.vue";

</script>

<template>
    <div class="base">
        <Header></Header>
        <sidebar></sidebar>
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
