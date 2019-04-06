<template>
    <v-card flat>
        <v-card-title class="headline font-weight-black">Registration</v-card-title>
        <v-card-text>
            <v-form>
                <v-text-field
                        v-model="username"
                        label="Username"
                        prepend-inner-icon="person"
                ></v-text-field>
                <v-text-field
                        v-model="name"
                        label="Full name"
                        prepend-inner-icon="sentiment_satisfied_alt"
                ></v-text-field>
                <v-text-field
                        v-model="password"
                        label="Password"
                        prepend-inner-icon="lock"
                        type="password"
                ></v-text-field>
                <v-text-field
                        v-model="passwordRepeat"
                        label="Repeat password"
                        prepend-inner-icon="lock"
                        type="password"
                ></v-text-field>
                <v-layout justify-space-between>
                    <v-btn depressed class="mx-0" router to="login">Login</v-btn>
                    <v-btn class="primary mx-0" :loading="isLoading" @click="register()">Register</v-btn>
                </v-layout>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AppRegistrationForm",
        data() {
            return {
                username: '',
                name: '',
                password: '',
                passwordRepeat: '',

                isLoading: false
            }
        },
        methods: {
            register() {
                let self = this;

                self.isLoading = true;
                axios.post('/api/profiles', {
                    username: self.username,
                    name: self.name,
                    password: self.password,
                }).then(res => {
                    console.log(res.data);
                    self.isLoading = false;
                    this.$store.dispatch('auth/logout');
                    this.$router.push('login');
                }).catch(err => {
                    self.isLoading = false;
                    console.log(err);
                })
            }
        }
    }
</script>

<style scoped>

</style>