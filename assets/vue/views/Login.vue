<template>
    <v-layout justify-center>
        <v-flex xs12 sm8 md6 lg4>
            <app-login-form></app-login-form>
        </v-flex>
    </v-layout>
</template>

<script>
    import AppLoginForm from "../components/AppLoginForm";
    export default {
        name: "Login",
        components: {AppLoginForm},
    }
</script>

<style scoped>

</style>