<template>
    <div>
        <h1>Welcome!</h1>
        <router-link to="/home">Home</router-link>
        <router-link to="/login">Login</router-link>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>