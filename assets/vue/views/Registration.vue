<template>
    <v-layout justify-center>
        <v-flex xs12 sm8 md6 lg4>
            <app-registration-form></app-registration-form>
        </v-flex>
    </v-layout>
</template>

<script>
    import AppRegistrationForm from "../components/AppRegistrationForm";
    export default {
        name: "Registration",
        components: {AppRegistrationForm}
    }
</script>

<style scoped>

</style>