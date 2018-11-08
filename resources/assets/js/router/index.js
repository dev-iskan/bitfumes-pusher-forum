import Vue from 'vue'
import VueRouter from  'vue-router'
import Forum from '../views/Forum'
import Category from '../views/CreateCategory'
import Login from '../views/Login'
import Signup from '../views/Signup'
import Logout from '../views/Logout'
import AuthExist from './AuthExist'
import AuthLogged from "./AuthLogged";
import Read from "../views/Read";
import Create from "../views/Create";
Vue.use(VueRouter);

export default new VueRouter ({
    routes: [
        {
            path: '/',
            redirect: '/forum'
        },
        {
            path: '/forum',
            name: 'Forum',
            component: Forum
        },
        {
            path: '/question/:slug',
            name: 'Read',
            component: Read
        },
        {
            path: '/ask',
            name: 'Create',
            component: Create
        },
        {
            path: '/category',
            name: 'Category',
            component: Category,
            beforeEnter: AuthLogged
        },
        {
            path: '/login',
            name: 'Login',
            component: Login,
            beforeEnter: AuthExist
        },

        {
            path: '/logout',
            name: 'Logout',
            component: Logout,
            beforeEnter: AuthLogged
        },
        {
            path: '/signup',
            name: 'Signup',
            component: Signup,
            beforeEnter: AuthExist
        }
    ],
    mode: 'history'
})