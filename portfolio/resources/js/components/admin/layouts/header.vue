<script setup>
import {ref} from 'vue'
import {useRouter} from "vue-router";

const showNavHeader = ref(false)

const openNavheader = () => {
    showNavHeader.value = !showNavHeader.value
}
const router = useRouter()
const logout = () => {
    localStorage.removeItem('token')
    router.push('/login');
}
</script>

<template>
<div>
    <header class="header" id="header">
        <div class="header_logo " >
            <i class="header_collapse-btn fas fa-align-left"></i>
            <img class="logo_img" src="public/img/upload/avatar.png"
            />
        </div>
        <div class="header_search">
            <i class="header_search-icon fas fa-search"></i>
            <input class="header_search-input" type="text" placeholder="Search"/>
        </div>
        <div class="header_profile " @click="openNavheader">
            <div class="header_profile-imgWrapper " >
                <img class="header_profile-img" src="public/img/upload/avatar.png" alt=""/>
            </div>
            <p class="header_profile-name">
                Профиль
            </p>

        </div>
        <div class="nav__btns" >
            <!--====== THEME CHANGE BUTTON ======-->
            <i class="uil uil-moon change-theme" id="theme-button"></i>

            <div class="nav__toggle" id="nav-toggle">
                <i class="uil uil-apps "></i>
            </div>
        </div>
    </header>
    <!-- End Header -->

    <!-- Header Profile -->
    <div>
            <span class="header_profile-name--nav" v-bind:class={show:showNavHeader}>
                <span class="header_profile-name--nav--pointer">
                    <i class="fas fa-sort-up"></i>
                </span>
                <ul class="header_profile-name--nav--list">
                    <li class="header_profile-name--nav--item">
                        <router-link to="/admin/users/profile" class="header_profile-name--nav--link" >
                            Профиль
                        </router-link>
                    </li>
                    <li class="header_profile-name--nav--item">
                        <a class="header_profile-name--nav--link" href="#">
                            Сообщения
                        </a>
                    </li>
                    <li class="header_profile-name--nav--item">
                        <a class="header_profile-name--nav--link" href="#" @click="logout">
                            Выйти
                        </a>
                    </li>
                </ul>
            </span>
    </div>
    <!-- End Profile Header -->

</div>
</template>

<script>
export default {
    name: "header"
}
</script>

<style scoped>

</style>
