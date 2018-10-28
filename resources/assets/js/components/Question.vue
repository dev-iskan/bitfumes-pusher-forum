<template lang="pug">
    v-card
        v-card-title(primary-title)
            div
                h3(class="headline mb-0")
                    router-link(tag="a" :to="question.path") {{question.title}}
                div(class="grey--text") {{question.user}} said {{question.created_at}}
        v-card-text {{question.body}}
</template>

<script>
    export default {
        props: ['question']
    }
</script>

<style scoped>

</style>