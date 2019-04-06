<template>
    <v-card flat>
        <v-card-title class="headline font-weight-black">Login</v-card-title>
        <v-card-text>
            <v-form>
                <v-text-field
                    v-model="username"
                    label="Username"
                    prepend-inner-icon="person"
                ></v-text-field>
                <v-text-field
                    v-model="password"
                    label="Password"
                    prepend-inner-icon="lock"
                    :append-icon="showPassword ? 'visibility' : 'visibility_off'"
                    :type="showPassword ? 'text' : 'password'"
                    @click:append="showPassword = !showPassword"
                ></v-text-field>
                <v-layout justify-space-between>
                    <v-btn depressed class="mx-0" router to="registration">Register</v-btn>
                    <v-btn class="primary mx-0" @click="login()" :loading="isLoading">Login</v-btn>
                </v-layout>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        name: "AppLoginForm",
        data() {
            return {
                username: '',
                password: '',
                showPassword: false
            };
        },
        computed: {
            isLoading() {
                return this.$store.state.auth.isLoading;
            },
            isAuthenticated() {
                return this.$store.getters['auth/isAuthenticated'];
            },
            hasError() {
                return this.$store.getters['auth/hasError'];
            }
        },
        methods: {
            login() {
                this.$store.dispatch('auth/login', {
                    username: this.username,
                    password: this.password,
                }).then(() => {
                    if (this.isAuthenticated) {
                        this.$router.push('/');
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>