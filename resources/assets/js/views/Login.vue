<template lang="pug">
    v-container(fill-height  class="py-5")
        v-layout(align-center justify-center)
            v-flex(xs12 sm6 md5 lg4)
                v-card(class="elevation-6")
                    v-container
                        v-card-title(class="pa-0")
                            v-layout(justify-center align-center column)
                                div(class="title" class="pt-2") Авторизация
                        v-card-text(class="py-2")
                            v-form
                                v-text-field(
                                prepend-icon="email"
                                v-model="form.email"
                                label="Почта *"
                                type="email"
                                )
                                v-text-field(
                                prepend-icon="lock"
                                v-model="form.password"
                                type="password"
                                label="Пароль *"
                                )
                        v-card-actions(class="pa-3")
                            v-layout(align-center)
                                v-flex(xs12)
                                    div(class="pa-1")
                                        v-btn(color="primary" style="width: 100%" @click="login") Войти
</template>

<script>
    export default {
        data () {
            return {
                form: {
                    email: null,
                    password: null
                }
            }
        },
        methods: {
            login () {
                User.login(this.form)
            }
        }
    }
</script>

<style scoped>

</style>