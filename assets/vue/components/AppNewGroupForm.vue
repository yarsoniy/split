<template>
    <v-card>
        <v-card-title>New group</v-card-title>
        <v-card-text>
            <v-form>
                <v-text-field
                        v-model="name"
                        label="Name"
                        prepend-inner-icon="group"
                ></v-text-field>
                <v-layout justify-end>
                    <v-btn
                            class="primary mx-0"
                            :loading="isLoading"
                            @click="submit()"
                    >Submit</v-btn>
                </v-layout>
            </v-form>
        </v-card-text>
    </v-card>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "AppNewGroupForm",
        data() {
            return {
                name: "",
                isLoading: false
            }
        },
        methods: {
            reset() {
                this.name = "";
            },
            submit() {
                let self = this;

                self.isLoading = true;

                //TODO implement
                axios.post('/api/groups', {
                    name: this.name,
                }).then(res => {
                    console.log(res.data);
                    self.isLoading = false;
                    self.$emit('group-created', res.data);
                }).catch(e => {
                    self.isLoading = false;
                    console.log(e);
                });
            }
        },
    }
</script>

<style scoped>

</style>