<template lang="pug">
    v-toolbar
        v-toolbar-title
            router-link(tag="span" to="/" style="cursor: pointer;") Pusher
        v-spacer
        v-toolbar-items(class="hidden-sm-and-down")
            v-btn(:to="item.to" flat v-for="(item, index) in items" :key="index" v-if="item.show") {{item.title}}
</template>

<script>
    import User from "../helpers/User";

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
                        to: null,
                        show: User.loggedIn()
                    },
                    {
                        title:'Category',
                        to: '/category',
                        show: User.loggedIn()
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
        created () {
            EventBus.$on('logout', () => {
                User.logout()
            })
        }
    }
</script>

<style scoped>

</style>