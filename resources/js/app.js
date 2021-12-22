require('./bootstrap');

window.Vue = require('vue').default;

//axios.defaults.baseURL = "http://g325/api/";
//axios.defaults.withCredentials = true;

import VueRouter from 'vue-router';
import routes from './routes/index.js';
Vue.use(VueRouter);
const router = new VueRouter(routes);

import App from './components/App.vue';

// npm i --save v-toaster
import Toaster from 'v-toaster';
import 'v-toaster/dist/v-toaster.css';
Vue.use(Toaster, { timeout: 5000 });

function loggedIn() {
    return localStorage.getItem('token');
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!loggedIn()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.quest)) {
        if (loggedIn()) {
            next({
                path: '/',
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next();
    }
});

const app = new Vue({
    el: '#app',
    router,
    components: { App }
});
