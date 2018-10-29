<template lang="pug">
    v-container(fluid grid-list-md)
        v-layout(row wrap)
            v-flex(x12)
                v-card
                    v-card-title
                        div
                            div.headline Create new question
                    v-card-text
                        v-form
                            v-container
                                v-text-field(label="Title" v-model="title" type="text" required)
                                v-select(v-model="category_id" label="Category" :items="categories" item-text="title" item-value="id")
                                markdown-editor(v-model="body")
                    v-card-actions
                        v-spacer
                        v-btn(color="green" dark @click.prevent="update") Submit
                        v-btn(color="red" dark @click.prevent="edit") Cancel
</template>

<script>
    export default {
        props: ['question'],
        data () {
            return {
                title: null,
                category_id: null,
                categories: null,
                body: null,
                errors: null
            }
        },
        created () {
            axios.get(`/api/category`)
                .then(res => {
                    this.categories = res.data.data
                })
        },
        mounted () {
            this.title = this.question.title
            this.category_id = this.question.category_id
            this.body = this.question.body
        },
        methods: {
            edit () {
                EventBus.$emit('stopEditing')
            },
            update () {
                axios.patch(`/api/question/${this.question.slug}`, {
                    title: this.title,
                    category_id: this.category_id,
                    body: this.body
                })
                    .then(res => {
                        this.edit()
                    })
            }
        }
    }
</script>

<style scoped>

</style>