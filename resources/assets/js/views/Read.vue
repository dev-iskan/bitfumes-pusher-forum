<template lang="pug">
    v-container(fluid grid-list-md)
        v-layout(row wrap)
            v-flex(x8)
                div(v-if="question")
                    edit-question(v-if="editing" :question="question")
                    show-question(:question="question" v-else)
                    v-container
                        replies(:replies="question.replies" :slug="question.slug")
                        new-reply(:slug="question.slug" v-if="loggedIn")
                        router-link(to="/login") Login to Reply
</template>

<script>
    import ShowQuestion from '../components/ShowQuestion'
    import Replies from '../components/Replies'
    import EditQuestion from '../components/EditQuestion'
    import NewReply from '../components/NewReply'
    import User from "../helpers/User";
    export default {
        data () {
            return {
                question : null,
                editing: null,
                // loggedIn: User.loggedIn()
            }
        },
        computed: {
            loggedIn () {
                return User.loggedIn()
            }
        },
        created () {
            this.listen()
            this.getQuestion()
        },
        methods: {
            listen () {
                EventBus.$on('startEditing', () => {
                    this.editing = true
                })
                EventBus.$on('stopEditing', () => {
                    this.editing = false
                })
            },

            getQuestion () {
                axios.get(`/api/question/${this.$route.params.slug}`)
                    .then(response => {
                        this.question = response.data.data
                    })
            }
        },
        components: {
            ShowQuestion,
            EditQuestion,
            Replies,
            NewReply
        }
    }
</script>

<style scoped>

</style>