<template>
    <b-container>
        <b-input-group size="lg" prepend="$" append=".00">
            <b-form-input />
        </b-input-group>
        <router-view></router-view>
    </b-container>
</template>

<script>
    export default {
        name: "App"
    }
</script>

<style scoped>

</style>