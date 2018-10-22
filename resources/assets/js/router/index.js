import Vue from 'vue'
import VueRouter from  'vue-router'
import Forum from '../views/Forum'
import Login from '../views/Login'

Vue.use(VueRouter);

export default new VueRouter ({
    routes: [
        {
            path: '/forum',
            component: Forum
        },
        {
            path: '/login',
            component: Login
        }
    ]
})