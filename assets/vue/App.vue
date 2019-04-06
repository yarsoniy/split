<template>
    <v-app class="grey lighten-4">
        <app-toolbar @side-icon-click="navigationVisible = !navigationVisible"></app-toolbar>
        <app-navigation v-if="isAuthenticated" v-model="navigationVisible"></app-navigation>
        <v-content>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-content>
        <v-footer app></v-footer>
    </v-app>
</template>

<script>
    import AppToolbar from './components/AppToolbar'
    import AppNavigation from './components/AppNavigation'

    export default {
        name: "App",
        components: {
            AppToolbar,
            AppNavigation
        },
        data() {
            return {
                navigationVisible: undefined
            }
        },
        computed: {
            isAuthenticated() {
                return this.$store.getters['auth/isAuthenticated'];
            },
        },
        mounted() {
            this.$store.dispatch('auth/init');
        },
    }
</script>

<style scoped>

</style>