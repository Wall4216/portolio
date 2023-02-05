<template>
    <Base/>

    <main class="main">
        <!-- Side Nav Dummy-->
        <div class="main__sideNav"></div>
        <!-- End Side Nav -->
        <!-- Main Content -->
        <div class="main__content">
            <section class="projects section" id="projects">
                <div class="skills_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Проекты </h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn__open--modal" @click="newProject()">
                                Новый проект
                            </div>
                        </div>
                    </div>

                    <div class="table">

                        <div class="table_filter">
                            <span class="table_filter-Btn ">
                                <i class="fas fa-ellipsis-h"></i>
                            </span>
                            <div>
                                <ul class="table_filter-list">
                                    <li>
                                        <p class="table_filter-link table_filter-link--active">
                                            Все
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="table_search">
                            <div class="table_search-wrapper">
                                <select class="table_search-select" name="" id="">
                                    <option value="">Фильтр</option>
                                </select>
                            </div>
                            <div class="relative">
                                <i class="table_search-input--icon fas fa-search "></i>
                                <input class="table_search--input" type="text" placeholder="Поиск">
                            </div>
                        </div>

                        <div class="project_table-heading">
                            <p>Фото</p>
                            <p>Заголовок</p>
                            <p>Описание</p>
                            <p>Ссылка</p>
                            <p>Возможности</p>
                        </div>
                        <!-- item 1 -->
                        <div class="project_table-items"  v-for="item in projects" :key="item.id" v-if="projects.length > 0">
                            <p>
                                <img :src="OurImage(item.avatar)" alt="" class="project_img-list">
                            </p>
                            <p>{{  item.title }}</p>
                            <p>{{  item.description }}</p>
                            <p>{{  item.link }}</p>
                            <div>
                                <button class="btn-icon success" @click="onEdit(item.id)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger" @click="deleteProject(item.id)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
            </section>

            <div class="main__content">
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "index"
}
</script>


<script setup>
import Base from "../layouts/base.vue";
import { onMounted, ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";
let projects  = ref([])
const router = useRouter()
onMounted(async () => {
    getProjects()
})
const  getProjects = async () => {
    let response = await  axios.get('/api/display_all_project')
    projects.value  = response.data.projects
    //console.log('response' ,response)
}
const OurImage = (img) => {
    return "/img/upload/"+img
}
const newProject = () => {
    router.push('/admin/projects/new')
}

const onEdit = (id) => {
    router.push('/admin/projects/edit/' + id)
}

const deleteProject = (id) => {
    Swal.fire({
        title:"Остановись...",
        text:"Остановись подумай",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, delete!",
    })
        .then((result) => {
            if(result.value) {
                axios.get('/api/delete_project'+id)
                    .then(()=>{
                        Swal.fire(
                            'Delete',
                            "Project delete successfully",
                            'success'
                        )
                        getProjects()
                    })
            }
    })
}
</script>

<style scoped>

</style>
