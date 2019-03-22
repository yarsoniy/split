/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)

import Vue from 'vue';

import Vuetify from 'vuetify'
import 'vuetify/src/stylus/main.styl'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

Vue.use(Vuetify);

import App from '../vue/App';
import router from '../vue/router'

new Vue({
    template: '<App/>',
    components: { App },
    router,
}).$mount('#app');
