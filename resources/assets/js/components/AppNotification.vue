<template lang="pug">
    div(class="text-xs-center")
        v-menu(offset-y)
            v-btn(icon slot="activator")
                v-icon(:color="color") add_alert
                | {{unreadCount}}
            v-list
                v-list-tile(v-for="item in unread" :key="item.id")
                    router-link(:to="item.path")
                        v-list-tile-title(@click="readNotification(item)") {{item.question}}
                v-divider
                v-list-tile(v-for="item in read" :key="item.id")
                    v-list-tile-title() {{item.question}}
</template>

<script>
    import User from "../helpers/User";
    export default {
        data () {
            return {
                read: {},
                unread: {},
                unreadCount: 0
            }
        },
        created () {
            if(User.loggedIn()) {
                this.getNotifications()
            }
        },
        methods: {
            getNotifications () {
                axios.post(`/api/notifications`)
                    .then(data => {
                        this.read = data.data.read
                        this.unread = data.data.unread
                        this.unreadCount = data.data.unread.length
                    })
            },
            readNotification (notification) {
                axios.post(`/api/markAsRead/`, { id: notification.id})
                    .then(res => {
                        this.unread.splice(notification, 1)
                        this.read.push(notification)
                        this.unread.count--
                    })
            }
        },
        computed : {
            color () {
                return this.unreadCount > 0 ? 'red' : 'red lighten-4'
            }
        }
    }
</script>

<style scoped>

</style>