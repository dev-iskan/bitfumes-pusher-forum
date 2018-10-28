<template lang="pug">
    v-card
        v-card-title
            div
                div.headline {{question.title}}
                span.grey--text {{question.user}} said {{question.created_at}}
            v-spacer
            v-btn(color="teal" dark) 5 Replies
        v-card-text(v-html="body")
        v-card-actions(v-if="own")
            v-spacer
            v-btn(icon small )
                v-icon(color="orange") edit
            v-btn(icon small )
                v-icon(color="red") delete
</template>

<script>
    export default {
        props: ['question'],
        data () {
            return {
                own : User.own(this.question.user_id)
            }
        },
        computed: {
            body () {
                return md.parse(this.question.body)
            }
        }
    }
</script>

<style scoped>

</style>