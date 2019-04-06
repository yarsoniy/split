<template>
    <div>
        <v-toolbar app flat>
            <v-toolbar-side-icon @click="$emit('side-icon-click')"></v-toolbar-side-icon>
            <v-toolbar-title>Split</v-toolbar-title>
            <v-toolbar-title v-if="currentGroup">{{ currentGroup.name }}</v-toolbar-title>
        </v-toolbar>
    </div>
</template>

<script>
    export default {
        name: "AppToolbar",
        computed: {
            isAuthenticated() {
                return this.$store.getters['auth/isAuthenticated'];
            },
            currentGroup() {
                return this.$store.state.currentGroup;
            },
        },
    }
</script>

<style scoped>

</style>