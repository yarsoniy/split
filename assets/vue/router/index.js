import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../views/Home';
import Contacts from '../views/Contacts';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/home', component: Home },
        { path: '/contacts', component: Contacts },
        { path: '*', redirect: '/home' }
    ],
});
