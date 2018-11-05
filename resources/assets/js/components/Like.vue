<template lang="pug">
    div
        v-btn(icon @click="likeIt")
            v-icon(:color="color") favorite
        span {{count}}
</template>

<script>
    import User from "../helpers/User";

    export default {
        props: ['reply'],
        data () {
            return {
                liked: this.reply.liked,
                count: this.reply.like_count
            }
        },
        computed : {
            color () {
                return this.liked? 'red' : 'red lighten-4'
            }
        },
        methods: {
            likeIt () {
                if(User.loggedIn()) {
                    this. liked ? this.decrement() : this.increment()
                    this.liked = ! this.liked
                }
            },
            increment () {
                axios.post(`/api/reply/${this.reply.id}/like`)
                    .then(res =>this.count ++)
                    .catch(err => console.log(err))

            },
            decrement () {
                axios.delete(`/api/reply/${this.reply.id}/dislike`)
                    .then(res =>this.count --)
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped>

</style>