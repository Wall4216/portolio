import {createRouter, createWebHistory} from "vue-router";

import homeAdminIndex from '../components/admin/home/index.vue'

import homePageIndex from '../components/pages/home/index.vue'

import notFound from "../components/notFound.vue";
const routes  = [
    {
        path: '/admin/home',
        component: homeAdminIndex,
    },
    {
        path: '/',
        component: homePageIndex,
    },

    {
        path: '/:pathMath(.*)*',
        component: notFound,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})


export default router
