import {createRouter, createWebHistory} from "vue-router";

import homeAdminIndex from '../components/admin/home/index.vue';
import adminAboutIndex from "../components/admin/about/index.vue";
import adminServiceIndex from "../components/admin/services/index.vue";
import adminSkillIndex from "../components/admin/skills/index.vue";
import homePageIndex from '../components/pages/home/index.vue';
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
        path: '/admin/about',
        name: 'adminAbout',
        component: adminAboutIndex,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admin/services',
        name: 'adminService',
        component: adminServiceIndex,
        meta: {
            requiresAuth: true
        }

    },
    {
        path: '/admin/skills',
        name: 'adminSkill',
        component: adminSkillIndex,
        meta: {
            requiresAuth: true
        }

    },
    {
        path: '/',
        name: 'Hone',
        component: homePageIndex,
        meta: {
            requiresAuth: false
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
