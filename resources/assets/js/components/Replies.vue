<template lang="pug">
    div
        reply(v-for="(reply, index) in content" :data="reply" :index="index" :slug="slug" :key="reply.id" v-if="replies")
</template>

<script>
    import Reply from './Reply'
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
            }
        }
    }
</script>

<style scoped>

</style>