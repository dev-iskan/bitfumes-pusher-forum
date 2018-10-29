<template lang="pug">
    v-container(fluid grid-list-md)
        v-layout(row wrap)
            v-flex(x8)
                div(v-if="question")
                    edit-question(v-if="editing" :question="question")
                    show-question(:question="question" v-else)
</template>

<script>
    import ShowQuestion from '../components/ShowQuestion'
    import EditQuestion from '../components/EditQuestion'
    export default {
        data () {
            return {
                question : null,
                editing: null
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
            EditQuestion
        }
    }
</script>

<style scoped>

</style>