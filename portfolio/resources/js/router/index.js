import {createRouter, createWebHistory} from "vue-router";

import homeAdminIndex from '../components/admin/home/index.vue'

import homePageIndex from '../components/pages/home/index.vue'

import notFound from "../components/notFound.vue";
import login from "../components/auth/login.vue";
const routes  = [
    {
        path: '/admin/home',
        name: 'adminHome',
        component: homeAdminIndex,
        meta: {
            requires: true
        }
    },
    {
        path: '/',
        name: 'Hone',
        component: homePageIndex,
        meta: {
            requires: false
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: login,
        meta: {
            requires: false
        }

    },
    {
        path: '/:pathMath(.*)*',
        component: notFound,
        name: notFound,
        meta: {
            requires: true
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from) =>{
    if (to.meta.requiresAuth && !localStorage.getItem('token')){
        return {name: ''}
    }
    if(to.meta.requiresAuth == false && localStorage.getItem('token'))
    {
        return {name: 'adminHome'}
    }
})
export default router
