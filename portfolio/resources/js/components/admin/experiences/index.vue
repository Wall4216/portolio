<script setup>
import  Base from "../layouts/base.vue"
import {onMounted, ref} from "vue";
import axios from "axios";
let experiences  = ref([])
let showModal = ref(false)
let hideModal = ref(true)
let editMode = ref(false)


let form = ref({
    company: "",
    period: "",
    position: ""
})

onMounted(async () => {
    getExperience()
})

let getExperience = async () =>{
    let response = await  axios.get('/api/display_all_experience')
    experiences.value = response.data.experiences
}

const openModal = () =>{
    showModal.value  = !showModal.value
    //editMode.value = false
}

const  closeModal = () =>{
    showModal.value  = !hideModal.value
    form.value = ({})
    editMode.value = false
}

const  ExperienceCreate = async () => {
    await  axios.post('/api/create_experience',form.value)
        .then(response => {
            getExperience();
            closeModal();
            toast.fire({
                icon: "success",
                title:"Experience added Successfully"
            })

        })
}

const  editExperience  = (experience) => {
    editMode.value = true
    showModal.value  = !showModal.value
    form.value = experience
}
const  updateExperience = async  () =>{
    await axios.post('/api/update_experience/'+form.value.id, form.value)
        .then(() => {
            getExperience()
            closeModal()
            toast.fire({
                icon: 'success',
                title: 'Experience updated successfully'
            })
        })
}

const  deleteExperience = (id) =>{
    Swal.fire({
        title:"Are you sure ? ",
        text: "You can't go back",
        icon: "warning",
        showCancelButton:true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor:'#d33',
        confirmButtonText: 'Yes , delete it ! '
    })
        .then((result)=>{
            if (result.value){
                axios.get('/api/delete_experience/'+id)
                    .then(() => {
                        Swal.fire(
                            'Delete',
                            'Experience deleted successfully',
                            'success'
                        )

                        getExperience()
                    })
            }
        })
}

</script>

<template>
    <Base/>

    <main class="main">
        <!-- Side Nav Dummy-->
        <div class="main__sideNav"></div>
        <!-- End Side Nav -->
        <!-- Main Content -->
        <div class="main__content">
        <section class="experiences section" id="experiences">
            <div class="experiences_container">
                <div class="titlebar">
                    <div class="titlebar_item">
                        <h1>Опыт </h1>
                    </div>
                    <div class="titlebar_item">
                        <div class="btn btn__open--modal" @click="openModal()">
                           Добавить опыт
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
                                <option value="">Filter</option>
                            </select>
                        </div>
                        <div class="relative">
                            <i class="table_search-input--icon fas fa-search "></i>
                            <input class="table_search--input" type="text" placeholder="Поиск">
                        </div>
                    </div>

                    <div class="experience_table-heading">
                        <p>Компания</p>
                        <p>Период</p>
                        <p>Позиция</p>
                        <p>Возможности</p>
                    </div>
                    <!-- item 1 -->
                    <div class="experience_table-items"  v-for="experience in experiences" :key="experience.id" v-if="experiences.length > 0">
                        <p> {{experience.company}}</p>
                        <p> {{experience.period}}</p>
                        <p> {{experience.position}}</p>
                        <div>
                            <button class="btn-icon success"  @click="editExperience(experience)">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="btn-icon danger" @click="deleteExperience(experience.id)">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>

                </div>

            </div>
            <!-------------- EXPERIENCE MODAL --------------->
            <div class="modal main__modal " :class="{ show: showModal}">
                <div class="modal__content">
                    <span class="modal__close btn__close--modal" @click="closeModal()" >×</span>
                    <h3 class="modal__title" v-show="editExperience == false">Добавить</h3>
                    <h3 class="modal__title" v-show="editMode == true">Редактировать</h3>
                    <hr class="modal_line"><br>
                    <form @submit.prevent="editMode ? updateExperience() : ExperienceCreate()">
                        <div>
                            <p>Компания</p>
                            <input type="text" class="input" v-model="form.company" />
                            <p>Период</p>
                            <input type="text" class="input" v-model="form.period"/>
                            <p>Позиция</p>
                            <input type="text" class="input" v-model="form.position"/>
                        </div>
                        <br><hr class="modal_line">
                        <div class="model__footer">
                            <button class="btn mr-2 " @click="closeModal()">
                                Закрыть
                            </button>
                            <button class="btn btn-secondary btn__close--modal ">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        </div>
    </main>
</template>
<script>
export default {
    name: "index"
}
</script>

<style scoped>

</style>
