<template>
    <div>
        <v-layout class="text-xs-center mb-3">
            <h2>
                <v-icon left>group</v-icon>
                <span>Your groups</span>
            </h2>
            <v-spacer></v-spacer>
            <v-btn fab class="primary mt-0" @click="dialogNewGroup = true">
                <v-icon>group_add</v-icon>
            </v-btn>
        </v-layout>
        <v-layout v-for="group in groups" :key="group.id">
            <v-flex>
                <v-card flat hover class="mb-2" @click="changeGroup(group)">
                    <v-container>
                        <v-layout align-center>
                            <div class="subheading">{{ group.name }}</div>
                            <v-spacer></v-spacer>
                            <v-icon>chevron_right</v-icon>
                        </v-layout>
                    </v-container>
                </v-card>
            </v-flex>
        </v-layout>
        <v-dialog  v-model="dialogNewGroup" max-width="300">
            <app-new-group-form ref="newGroupForm"></app-new-group-form>
        </v-dialog>
    </div>
</template>

<script>
    import AppNewGroupForm from "../components/AppNewGroupForm";
    export default {
        name: "Groups",
        components: {AppNewGroupForm},
        data() {
            return {
                dialogNewGroup: false,
                groups: [
                    {
                        id: '1',
                        name: 'Lalala',
                    },
                    {
                        id: '2',
                        name: 'Ololo'
                    },
                    {
                        id: '3',
                        name: 'WeWeWe'
                    },
                ]
            }
        },
        watch: {
            dialogNewGroup(newValue) {
                if (newValue) {
                    this.$refs.newGroupForm.reset();
                }
            }
        },
        methods: {
            changeGroup(group) {
                this.$store.dispatch('changeCurrentGroup', group);
                this.$router.push('/');
            }
        }
    }
</script>

<style scoped>

</style>