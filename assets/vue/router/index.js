import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../views/Home';
import Login from '../views/Login';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: Home },
        { path: '/login', component: Login },
        { path: '*', redirect: '/home' }
    ],
});
