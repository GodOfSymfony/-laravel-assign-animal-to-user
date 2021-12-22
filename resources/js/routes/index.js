import Index from '../components/Index.vue';
import Register from '../components/Register.vue';
import Login from '../components/Login.vue';

export default {
    mode: "history",
    base: '/',
    fallback: true,
    routes: [
        {
            path: '/register',
            component: Register,
            name: 'register'
        },
        {
            path: '/login',
            component: Login,
            name: 'login'
        },
        {
            path: '/',
            component: Index,
            name: 'index',
            meta: { requiresAuth: true }
        }
    ]
}
