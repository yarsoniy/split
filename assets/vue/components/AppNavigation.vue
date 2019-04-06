<template>
    <nav>
        <v-navigation-drawer v-model="drawer" app>
            <v-list>
                <v-list-tile router to="/">
                    <v-list-tile-action>
                        <v-icon>dashboard</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Home</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile router to="/groups">
                    <v-list-tile-action>
                        <v-icon>group</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Groups</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile @click="confirmLogout = !confirmLogout">
                    <v-list-tile-action>
                        <v-icon>exit_to_app</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>Log out</v-list-tile-title>
                    </v-list-tile-content>

                    <!-- Log out confirm -->
                    <v-dialog v-model="confirmLogout" max-width="300">
                        <v-card>
                            <v-card-text>Do you really want to exit?</v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn flat class="primary--text" @click="confirmLogout = false">No</v-btn>
                                <v-btn flat class="primary--text" @click="logout()">Yes</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-list-tile>
            </v-list>
        </v-navigation-drawer>
    </nav>
</template>

<script>
    export default {
        props: ['value'],
        name: "AppNavigation",
        data() {
            return {
                confirmLogout: false
            }
        },
        computed: {
            drawer: {
                get() {
                    return this.value;
                },
                set(newValue) {
                    this.$emit('input', newValue)
                }
            }
        },
        methods: {
            logout() {
                this.confirmLogout = false;
                this.$store.dispatch('auth/logout');
                this.$router.push('login');
            }
        }
    }
</script>

<style scoped>

</style>