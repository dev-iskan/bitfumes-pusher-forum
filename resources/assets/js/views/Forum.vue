<template lang="pug">
    v-container(fluid grid-list-md)
        v-layout(row wrap)
            v-flex(xs8)
                question(v-for="(question, index) in questions" :key="index" :question="question")
            v-flex(xs4)
                app-sidebar
</template>

<script>
    import Question from '../components/Question'
    import AppSidebar from '../components/AppSidebar'
    export default {
        data () {
            return {
                questions : null
            }
        },
        components: {
            Question,
            AppSidebar
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