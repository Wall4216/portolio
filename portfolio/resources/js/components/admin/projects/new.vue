<script setup>
import Base from "../layouts/base.vue";
import {ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";
const router = useRouter()

let form = ref({
    title: '',
    description: '',
    link: '',
    photo: '',
})
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
</script>

<template>
        <Base/>

        <main class="main">
            <!-- Side Nav Dummy-->
            <div class="main__sideNav"></div>
            <div class="main__content">
            <section class="about section" id="project">
                <div class="about_container">
                    <div class="titlebar">
                        <div class="titlebar_item">
                            <h1>Добавить проект</h1>
                        </div>
                        <div class="titlebar_item">
                            <div class="btn btn-secondary" @click="saveProject()">
                                Сохранить проект
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
                                <input type="text" class="input" v-model="form.link" />

                            </div>
                        </div>

                        <div class="wrapper_right ">
                            <div class="card">
                                <div class="project_img-container">
                                    <img :src="getPhoto()" class="project_img" alt="">
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
                            <div class="btn btn-secondary" @click="saveProject()">
                                Сохранить
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
    name: "new"
}
</script>

<style scoped>

</style>
