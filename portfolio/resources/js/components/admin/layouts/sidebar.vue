<template>
    <nav class="nav">
        <div class="nav_wrapper">
                <span class="nav_close">
                    <i class="fas fa-window-close"></i>
                </span>
            <ul class="nav_list">
                <li class="nav_item">
                    <router-link class="nav_link nav__active" to="/admin/home">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Главная страница
                            </span>
                    </router-link>
                </li>
                <li class="nav_item">
                    <router-link class="nav_link " to="/admin/about">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                О мне
                            </span>
                    </router-link>
                </li>
                <li class="nav_item">
                    <router-link  class="nav_link " to="/admin/services">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Сервисы
                            </span>
                    </router-link>
                </li>
                <li class="nav_item">
                    <router-link class="nav_link " to="/admin/skills">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Умения
                            </span>
                    </router-link>
                </li>
                <li class="nav_item">
                    <router-link class="nav_link " to="/admin/educations">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Образование
                            </span>
                    </router-link>
                </li>
                <li class="nav_item">
                    <router-link class="nav_link " to="/admin/experiences">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Опыт
                            </span>
                    </router-link>
                </li>
                <li class="nav_item">
                    <router-link class="nav_link " to="/admin/projects">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Проекты
                            </span>
                    </router-link>
                </li>
                <li class="nav_item">
                    <a class="nav_link " href="#">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Свидетельство
                            </span>
                    </a>
                </li>

                <li class="nav_item">
                    <router-link class="nav_link " to="/admin/users">
                            <span class="nav_link--span--icon">
                                <i class="fas fa-home nav__link--icon"> </i>
                            </span>
                        <span class="nav_link--span--navname">
                                Пользователи
                            </span>
                    </router-link>
                </li>


            </ul>
        </div>
    </nav>

</template>

<script>
export default {
    name: "sidebar"
}
</script>

<style scoped>

</style>
