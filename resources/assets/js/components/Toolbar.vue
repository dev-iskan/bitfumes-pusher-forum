<template lang="pug">
    v-toolbar(color="indigo" dark)
        v-toolbar-title
            router-link(tag="span" to="/" style="cursor: pointer;") Pusher
        v-spacer
        app-notification
        v-toolbar-items(class="hidden-sm-and-down")
            v-btn(:to="item.to" flat v-for="(item, index) in items" :key="index" v-if="item.show") {{item.title}}
</template>

<script>
    import User from "../helpers/User";
    import AppNotification from './AppNotification'
    export default {
        data () {
            return {
                items: [
                    {
                        title:'Forum',
                        to: '/forum',
                        show: true
                    },
                    {
                        title:'Ask question',
                        to: '/ask',
                        show: User.loggedIn()
                    },
                    {
                        title:'Category',
                        to: '/category',
                        show: User.admin()
                    },
                    {
                        title:'Signup',
                        to: '/signup',
                        show: !User.loggedIn()
                    },
                    {
                        title:'Login',
                        to: '/login',
                        show: !User.loggedIn(),
                    },
                    {
                        title:'Logout',
                        to: '/logout',
                        show: User.loggedIn()
                    }
                ]
            }
        },
        components: {
            AppNotification
        },
        created () {
            EventBus.$on('logout', () => {
                User.logout()
            })
        }
    }
</script>

<style scoped>

</style>