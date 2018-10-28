<template lang="pug">
    v-container(fluid grid-list-md)
        v-layout(row wrap)
            v-flex(x8)
                question(v-for="(question, index) in questions" :key="index" :question="question")
            v-flex(xs4)

</template>

<script>
    import Question from '../components/Question'
    export default {
        data () {
            return {
                questions : null
            }
        },
        components: {
            Question
        },
        created () {
            axios.get('/api/question')
                .then((response) => {
                this.questions = response.data.data
            })
        }
    }
</script>

<style scoped>

</style>