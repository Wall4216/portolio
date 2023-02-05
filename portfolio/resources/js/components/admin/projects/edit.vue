<script setup>
import Base from "../layouts/base.vue";
import {onMounted, ref} from "vue";
import {useRouter} from "vue-router";

const router = useRouter()
onMounted(async () => {
    getsingleProject()
})
let form = ref({
    id: '',
    title: '',
    description: '',
    link: '',
    photo: ''
})
const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})
 const  getsingleProject = async () =>
 {
     let response = await axios.get(`api/get_edit_project/${props.id}`)
     console.log('response', response)
     form.value = response.data.project
 }
const getPhoto = () => {
    let photo  = "/img/upload/avatar.png"
    if (form.value.photo){
        if (form.value.photo.indexOf('base64') != -1 ){
            photo = form.value.photo
        }else{
            photo = '/img/upload/' + form.value.photo;
        }
    }
    return  photo;
}
const  changePhoto = (e) => {
    let file = e.target.files[0];
    let reader  = new FileReader();
    let limit  = 1024*1024*2
    if (file['size'] > limit){
        Swal({
            icon:'n new error',
            title:'Ooops...',
            text:'You are uploading a large file'
        })
        return false;
    }
    reader.onloadend = () => {
        form.value.photo   = reader.result
    }
    reader.readAsDataURL(file)
}
const saveProject = async () => {
    await axios.post('/api/add_project', form.value)
        .then((response) => {
            router.push('/admin/projects')
            toast.fire({
                icon: "success",
                title: "Success boyyyyyyyyy...."
            })
        })
}
const updateProject = async () => {
    await axios.get(`/api/update_project/${form.value.id}`, form.value)
        .then(response => {
            router.push('/admin/projects')
        toast.fire({
            icon: "success",
            title: "Update boy.........."
        })
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
            <section class="about section" id="project">
                <div class="about_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Добавить проект</h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn-secondary" @click="updateProject()">
                                Редактировать проект
                            </div>
                        </div>
                    </div>
                    <div class="card_wrapper">
                        <div class="wrapper_left">
                            <div class="card">

                                <p>Заголовок</p>
                                <input type="text" class="input" v-model="form.title"/>

                                <p>Описание</p>
                                <textarea cols="10" rows="5" v-model="form.description" ></textarea>

                                <p>Ссылка</p>
                                <input type="text" class="input" v-model="form.link"/>

                            </div>
                        </div>

                        <div class="wrapper_right ">
                            <div class="card">
                                <div class="project_img-container">
                                    <img :src="getPhoto()" alt="" class="project_img">
                                </div>
                                <br>
                                <input type="file" id="fileimg" @change="changePhoto"/>
                                <br><br><br>
                            </div>
                        </div>

                    </div>
                    <div class="titlebar">
                        <div class="titlebar_item">

                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn-secondary" @click="updateProject()">
                                Редактировать
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>
</template>

<script>
export default {
    name: "edit.vue"
}
</script>

<style scoped>

</style>
