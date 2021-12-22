<template>
    <div class="mt-3">
        <form @submit.prevent="register" class="form-signin">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" v-model="user.name" title="Enter your name" class="form-control">
                <p class="text-danger" v-text="errors.name"></p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" v-model="user.email" title="Enter your email" class="form-control">
                <p class="text-danger" v-text="errors.email"></p>
            </div>
            <div class="form-group">
                <label for="Password">Password</label>
                <input id="password" type="password" v-model="user.password" title="Enter your password" class="form-control">
                <p class="text-danger" v-text="errors.password"></p>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirm password</label>
                <input id="password_confirm" type="password" v-model="user.password_confirm" title="Confirm your password" class="form-control">
                <p class="text-danger" v-text="errors.password_confirm"></p>
            </div>
            <input class="btn btn-block btn-primary" type="submit" value="Login">
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirm: ''
            },
            errors: []
        }
    },
    methods: {
        async register() {
            await axios.post('/api/register', this.user)
            .then(response => {
                this.user.name = this.user.email = this.user.password = this.user.password_confirm = '';
                this.errors = {};
                this.$router.push('/login');
                this.$toaster.success('You are registered');
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
</script>

<style>
html,
body {
    height: 100%;
}

body {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
}

.form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
}
.form-signin .checkbox {
    font-weight: 400;
}
.form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
}
.form-signin .form-control:focus {
    z-index: 2;
}
.form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
</style>
