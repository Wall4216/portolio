<script setup>
import Base from "../layouts/base.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
let skills    = ref([]);
let services = ref([]);
let showModal = ref(false)
let hideModal = ref(true)
let editMode   = ref(false)
let form = ref({
    'name' : '',
    'proficiency': '',
    'service_id': '',
})
onMounted(async () =>{
    getSkills()
    getServices()
})
const  getSkills = async () => {
    let response = await  axios.get('/api/get_all_skill')
    skills.value  = response.data.skills
    //console.log('response' ,response)
}
const  getServices =  async () => {
    let response = await  axios.get('/api/display_all_service')
    services.value = response.data.services
}
const openModal = () => {
    showModal.value = !showModal.value
}
const closeModal = () =>{
    showModal.value = !hideModal.value
    form.value = ({})
    editMode.value = false
}
const  createSkill  = async () =>{
    await  axios.post('/api/create_skill', form.value)
        .then(response =>{
            getSkills()
            closeModal()
            toast.fire({
                icon: 'success',
                title: 'Skill added successfully'
            })
        })
}
const editModal = (item) => {
    editMode.value = true
    showModal.value = !showModal.value
    form.value = item
}

const updateSkill = async () => {
    await axios.post('/api/update_skill/' + form.value.id, form.value)
        .then(() => {
            getSkills()
            closeModal()
            toast.fire({
                icon: "success",
                title: "Success boyyyyyyyyyy..."
            })
        })
}
const  deleteSkill = (id) =>{
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
                axios.get('/api/delete_skill/'+id)
                    .then(() => {
                        Swal.fire(
                            'Delete',
                            'Skill deleted successfully',
                            'success'
                        )
                        getSkills()
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
            <section class="skills section" id="skills">
                <div class="skills_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Умение </h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn__open--modal" @click="openModal()">
                                Добавить умение
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

                        <div class="skill_table-heading">
                            <p>Название</p>
                            <p>Процент умения</p>
                            <p>Сервис</p>
                            <p>Возможности</p>
                        </div>
                        <!-- item 1 -->
                        <div class="skill_table-items" v-for="item in skills" :key="item.id" v-if="skills.length>0">
                            <p>{{ item.name }}</p>
                            <div class="table_skills-bar">
                                <span class="table_skills-percentage" :style="{'width': `${item.proficiency}%`}"></span>
                                <strong>{{item.proficiency}}</strong>
                            </div>
                            <p v-if="item.service"> {{item.service.name}}</p>
                            <div>
                                <button class="btn-icon success" @click="editModal(item)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger" @click="deleteSkill(item.id)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
                <!-------------- SERVICES MODAL --------------->
                <div class="modal main__modal " :class="{show: showModal}">
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal" @click="closeModal()">×</span>
                        <h3 class="modal__title" v-show="editMode == false">Добавить</h3>
                        <h3 class="modal__title" v-show="editMode == false">Редактировать</h3>
                        <hr class="modal_line"><br>
                        <form @submit.prevent="editMode ? updateSkill() : createSkill()">
                        <div>
                            <p>Name</p>
                            <input type="text" class="input" v-model="form.name"/>

                            <p>Proficiency</p>
                            <input type="text" class="input" v-model="form.proficiency"/>

                            <p>Service</p>
                            <select class="inputSelect" name="" id="" v-model="form.service_id">
                                <option disabled>Select service</option>
                                <option :value="service.id" v-for="service in services" :key="service.id">
                                    {{service.name}}
                                </option>
                            </select>
                        </div>
                        <br><hr class="modal_line">
                        <div class="model__footer">
                            <button class="btn mr-2 btn__close--modal" @click="closeModal()">
                                Cancel
                            </button>
                            <button class="btn btn-secondary btn__close--modal " v-show="editMode == false">Сохранить</button>
                            <button class="btn btn-secondary btn__close--modal " v-show="editMode == true">Редактировать</button>
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
