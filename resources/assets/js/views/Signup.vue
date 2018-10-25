<template lang="pug">
    v-container(fill-height  class="py-5")
        v-layout(align-center justify-center)
            v-flex(xs12 sm6 md5 lg4)
                v-card(class="elevation-6")
                    v-container
                        v-card-title(class="pa-0")
                            v-layout(justify-center align-center column)
                                div(class="title" class="pt-2") Регистрация
                        v-card-text(class="py-2")
                            v-form
                                v-text-field(
                                prepend-icon="face"
                                v-model="name"
                                label="Имя *"
                                type="text"
                                :error-messages="errs.name[0]"
                                )
                                v-text-field(
                                prepend-icon="email"
                                v-model="email"
                                label="Почта *"
                                type="email"
                                :error-messages="errs.email[0]"
                                )
                                v-text-field(
                                prepend-icon="lock"
                                v-model="password"
                                type="password"
                                label="Пароль *"
                                :error-messages="errs.password[0]"
                                )
                                v-text-field(
                                prepend-icon="lock_open"
                                v-model="password_confirmation"
                                type="password"
                                label="Подтверждение пароля *"
                                )
                        v-card-actions(class="pa-3")
                            v-layout(align-center row wrap)
                                v-flex(xs12)
                                    div(class="pa-1")
                                        v-btn(color="primary" style="width: 100%" @click="signup") Зарегистрироваться
                                v-flex(xs12)
                                    div(class="pa-1")
                                        v-btn(flat style="width: 100%" to="/login") Войти
</template>

<script>
    import User from "../helpers/User";

    export default {
        data () {
            return {
                name: null,
                email: null,
                password: null,
                password_confirmation : null,
                errors: {
                    name: [],
                    email:[],
                    password: []
                }
            }
        },
        computed : {
            errs () {
                return this.errors
            },
            form () {
                return {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }
            }
        },
        watch: {
            name () {
                this.errors.name = ''
            },
            email () {
                this.errors.email = ''
            },
            password () {
                this.errors.password = ''
            }
        },
        methods: {
            signup () {
               User.signup(this.form)
                   .then(()=> {
                       this.$router.push('Forum');
                   })
                   .catch(errors => {
                   this.errors = errors
                   })
            }
        }
    }
</script>

<style scoped>

</style>