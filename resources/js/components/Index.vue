<template>
    <div class="col-sm-12 col-sm-6">
        <h2>Index page</h2>
        <div class="row">
            <div class="col-sm-6 col-sm-6">
                <div v-if="user">
                    <p>Current user is: {{ user.email }}</p>
                </div>
            </div>
            <div class="col-sm-6 col-sm-6">
                <a href="#" @click.prevent="logout">Logout</a>
            </div>
        </div>

        <div class="row" v-if="animals.length > 0">
            <div class="col-sm-6 col-sm-6">
                <select class="form-control" v-model="attachId">
                    <option v-for="animal in animals"
                            :value="animal.id">{{ animal.title }}</option>
                </select>
            </div>
            <div class="col-sm-6 col-sm-6">
                <button class="btn btn-sm btn-primary" @click.prevent="attachAnimal">Get animal</button>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-6 col-sm-6">
                <ul id="used_animals" class="list-group">
                    <li class="list-group-item" v-for="(animal, index) in usedAnimals" :key="index">
                        <b>{{ animal.title }}</b>:
                        sleep = {{ animal.data.sleep }}
                        <button class="btn btn-sm btn-primary-outline sleep"
                                :disabled="!animal.data.alive"
                              @click="incrementProperty(animal.data.animal_id, 'sleep')">&uarr;</button>,
                        hunger = {{ animal.data.hunger }}
                        <button class="btn btn-sm btn-primary-outline hunger"
                                :disabled="!animal.data.alive"
                              @click="incrementProperty(animal.data.animal_id, 'hunger')">&uarr;</button>,
                        care = {{ animal.data.care }}
                        <button class="btn btn-sm btn-primary-outline care"
                                :disabled="!animal.data.alive"
                              @click="incrementProperty(animal.data.animal_id, 'care')">&uarr;</button>
                    </li>
                </ul>
            </div>
            <button class="btn btn-block btn-primary-outline" @click="canInc">Check increment</button>
        </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            user: {},
            animals: [],
            usedAnimals: {},
            attachId: null,
            canIncrement: [
                /*{"can_inc_sleep":false,"can_inc_hunger":false,"can_inc_care":false},
                {"can_inc_sleep":false,"can_inc_hunger":false,"can_inc_care":false},
                {"can_inc_sleep":false,"can_inc_hunger":false,"can_inc_care":false},
                {"can_inc_sleep":false,"can_inc_hunger":false,"can_inc_care":false}*/
            ]
        }
    },
    mounted() {
        this.getCurrentUser();
        this.getFreeAnimals();

        let liAnimals = document.querySelectorAll('#used_animals li');
        if (liAnimals.length === 0) {
            this.getUserData();
        }

        Echo.channel('animals')
        .listen('Tamagotchi', (e) => {
            this.getUserData();
        });
    },
    methods: {
        async logout() {
            await axios.post('/api/logout');
            localStorage.removeItem('token');
            this.$router.push('login');
        },
        getFreeAnimals() {
            axios.get('/api/get-free-animals')
            .then(response => {
                this.animals = response.data;
            })
            .catch(error => {
                console.log(error.data);
            });
        },
        getCurrentUser() {
            axios.post('/api/user')
            .then(response => {
                this.user = response.data.data;
            })
            .catch(errors => {
                console.log(errors);
            });
        },
        getUserData() {
            axios.post('/api/current-user-data')
            .then(response => {
                this.usedAnimals = response.data.animals;
            })
        },
        attachAnimal(){
            axios.post('/api/assign-animal', {animal_id: this.attachId})
            .then(response => {
                this.getFreeAnimals();
                this.getUserData();
            })
            .catch(errors => {
                console.log(errors);
            });
        },
        incrementProperty(animal_id, property) {
            axios.post('/api/increase-property', {
                animal_id: animal_id,
                property: property
            })
            .then(response => {
                this.getUserData();
            })
            .catch(errors => {
                console.log(errors);
            });
        },
        canInc() {
            let increment = [];
            for (let key in this.usedAnimals) {
                increment.push(this.usedAnimals[key].id);
            }
            axios.post('/api/check-increment', { inc: increment })
            .then(response => {
                this.canIncrement = response.data;
            })
            .catch(errors => {
                console.log(errors);
            });
        }
    }
}
</script>
