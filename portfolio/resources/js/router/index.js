import {createRouter, createWebHistory} from "vue-router";

import homeAdminIndex from '../components/admin/home/index.vue';
import adminAboutIndex from "../components/admin/about/index.vue";
import adminServiceIndex from "../components/admin/services/index.vue";
import adminSkillIndex from "../components/admin/skills/index.vue";
import adminEducationIndex from "../components/admin/educations/index.vue";
import adminExperienceIndex from "../components/admin/experiences/index.vue";
import adminProjectIndex from "../components/admin/projects/index.vue"
import adminProjectNew from "../components/admin/projects/new.vue"
import adminProjectEdit from "../components/admin/projects/edit.vue"
import adminUserIndex from "../components/admin/users/index.vue";
import adminUserProfile from "../components/admin/users/profile.vue";
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
        path: '/admin/educations',
        name: 'adminEducation',
        component: adminEducationIndex,
        meta: {
            requiresAuth: true
        }

    },
    {
        path: '/admin/experiences',
        name: 'adminExperience',
        component: adminExperienceIndex,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admin/projects',
        name: 'adminProject',
        component: adminProjectIndex,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admin/projects/new',
        name: 'adminProjectNew',
        component: adminProjectNew,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admin/users',
        name: 'adminUserIndex',
        component: adminUserIndex,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admin/users/profile',
        name: 'adminUserProfile',
        component: adminUserProfile,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/admin/projects/edit/:id',
        name: 'adminProjectEdit',
        component: adminProjectEdit,
        meta: {
            requiresAuth: true
        },
        props: true
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
