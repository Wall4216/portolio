<template>
    <Base/>
    <!--==================== MAIN ====================-->
    <main class="main">
        <!-- Side Nav Dummy-->
        <div class="main__sideNav"></div>
        <!-- End Side Nav -->
        <!-- Main Content -->
        <div class="main__content">
            <!--==================== SERVICES ====================-->
            <section class="services section" id="services">
                <div class="services_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Сервисы</h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn__open--modal" @click="openModal()">
                                Новый сервис
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

                        <div class="service_table-heading">
                            <p>Заголовок</p>
                            <p>Иконка</p>
                            <p>Описание</p>
                            <p>Возможности</p>
                        </div>
                        <!-- item 1 -->
                        <div class="service_table-items"
                             v-for="service in services "
                             :key="service.id"
                             v-if="services.length > 0">

                            <p>{{ service.name }}</p>
                            <button class="service_table-icon">
                                <i class="{{ service.icon }}"></i>
                            </button>
                            <p>{{ service.description }}</p>
                            <div>
                                <button class="btn-icon success" @click="editModal(service)">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="btn-icon danger"  @click="deleteService(service.id)">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                </div>
                <!-------------- SERVICES MODAL --------------->
                <div class="modal main__modal " :class="{show: showModal}" >
                    <div class="modal__content">
                        <span class="modal__close btn__close--modal" @click="closeModal()" >×</span>
                        <h3 class="modal__title" v-show="editMode === false ">Add Service</h3>
                        <h3 class="modal__title" v-show="editMode === true ">Update Service</h3>
                        <hr class="modal_line"><br>

                        <form  @submit.prevent="!editMode ? ServiceUpdate() : ServiceCreate() ">
                            <div>
                                <p>Название</p>
                                <input type="text" class="input" v-model="form.name" />

                                <p>Иконка</p>
                                <input type="text" class="input"  v-model="form.icon"/>
                                <span style="color:#006fbb;">Find your suitable icon: Font Awesome/Icon</span>

                                <p>Описание</p>
                                <textarea cols="10" rows="5"  v-model="form.description" ></textarea>
                            </div>
                            <br><hr class="modal_line">
                            <div class="model__footer">
                                <button class="btn mr-2 btn__close--modal" @click="closeModal()">
                                    Закрыть
                                </button>
                                <button class="btn btn-secondary " v-show="editMode === false">Сохранить</button>
                                <button class="btn btn-secondary " v-show="editMode === true">Редактировать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
</template>

<script setup>
import  Base from "../layouts/base.vue"
import {onMounted, ref} from "vue";
import axios from "axios";

let services  = ref({})

let showModal = ref(false)
let hideModal = ref(true)
let editMode = ref(true)


let form = ref({
    name: "",
    icon: "",
    description: ""
})

onMounted(async () => {
    getServices()
})

let getServices = async () =>{
    let response = await  axios.get('/api/display_all_service')
    services.value = response.data.services
    //console.log('response', response)
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

const  ServiceCreate = async () => {
    await  axios.post('/api/create_service',form.value)
        .then(response => {
            getServices();
            closeModal();
            toast.fire({
                icon: "success",
                title:"Service added Successfully"
            })

        })
}

const  editModal = (service) => {
    editMode.value = true
    showModal.value = !showModal.value
    form.value  = service
}

const  ServiceUpdate = async ()=>{
    await  axios.post('/api/update_service/'+form.value.id, form.value)
        .then(() =>{
            getServices()
            closeModal()
            toast.fire({
                icon: "success",
                title:"Service Updated Successfully"
            })

        })
}

const  deleteService = (id) =>{
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
                axios.get('/api/delete_service/'+id)
                    .then(() => {
                        Swal.fire(
                            'Delete',
                            'Service deleted successfully',
                            'success'
                        )

                        getServices()
                    })
            }
        })
}

</script>

<style scoped>

</style>
