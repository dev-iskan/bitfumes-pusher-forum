<template lang="pug">
    v-card
        v-card-title
            div
                div.headline {{question.title}}
                span.grey--text {{question.user}} said {{question.created_at}}
            v-spacer
            v-btn(color="teal" dark) {{question.reply_count}} replies
        v-card-text(v-html="body")
        v-card-actions
            v-spacer
            v-btn(icon small @click="edit")
                v-icon(color="orange") edit
            v-btn(icon small @click="destroy")
                v-icon(color="red") delete
</template>

<script>
    export default {
        props: ['question'],
        computed: {
            body () {
                return md.parse(this.question.body)
            }
        },
        methods: {
            destroy () {
                axios.delete(`/api/question/${this.question.slug}`)
                    .then(response => {
                        this.$router.push('/forum')
                    })
                    .catch(err => {
                        console.log(err.response.data)
                    })
            },
            edit () {
                EventBus.$emit('startEditing')
            }
        }
    }
</script>

<style scoped>

</style>