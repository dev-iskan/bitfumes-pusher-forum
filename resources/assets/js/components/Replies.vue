<template lang="pug">
    div
        reply(v-for="(reply, index) in content" :data="reply" :index="index" :slug="slug" :key="reply.id" v-if="replies")
</template>

<script>
    import Reply from './Reply'
    import User from "../helpers/User";
    export default {
        props: ['replies', 'slug'],
        data () {
          return {
              content: this.replies
          }
        },
        components: {
            Reply
        },
        created() {
            this.listen()
        },
        methods: {
            listen () {
                EventBus.$on('newReply', (reply) => {
                    this.content.unshift (reply)
                })
                EventBus.$on('deleteReply', (index) => {
                    axios.delete(`/api/question/${this.slug}/reply/${this.content[index].id}`)
                        .then(res => {
                            this.content.splice(index, 1)
                        })
                        .catch(err => console.log(err))
                })
                Echo.private('App.User.' + User.id())
                    .notification((notification) => {
                        this.content.unshift(notification.reply)
                    });
                Echo.channel('deleteReplyChannel')
                    .listen('DeleteReplyEvent', (e) => {
                        for(let index = 0; index<this.content.length; index++) {
                            if(this.content[index].id == e.id) {
                                this.content.splice(index, 1)
                            }
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>