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
                        v-btn(color="green" dark @click.prevent="create") Submit
</template>

<script>
    export default {
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
        methods: {
            create () {
                axios.post(`/api/question`, {
                    title: this.title,
                    category_id: this.category_id,
                    body: this.body
                })
                    .then(res => {
                        this.$router.push(res.data.path)
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors
                    })
            }
        }
    }
</script>

<style scoped>

</style>