export default {
    state: {
        logged: false,
        user: {}
    },
    mutations: {
        set_logged(state, value) {
            state.logged = value;
        },
        set_user(state, value) {
            state.user = value;
        }
    }
}
