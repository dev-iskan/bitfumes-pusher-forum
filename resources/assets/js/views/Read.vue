<template lang="pug">
    v-container(fluid grid-list-md)
        v-layout(row wrap)
            v-flex(x8)
                show-question(:question="question" v-if="question")
</template>

<script>
    import ShowQuestion from '../components/ShowQuestion'
    export default {
        data () {
            return {
                question : null
            }
        },
        created () {
            axios.get(`/api/question/${this.$route.params.slug}`)
                .then(response => {
                    this.question = response.data.data
                })
        },
        components: {
            ShowQuestion
        }
    }
</script>

<style scoped>

</style>