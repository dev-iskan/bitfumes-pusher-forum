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
                                span(class="red--text" v-if="errors.title") {{errors.title[0]}}
                                v-text-field(label="Title" v-model="title" type="text" required)
                                span(class="red--text" v-if="errors.category_id") {{errors.category_id[0]}}
                                v-select(v-model="category_id" label="Category" :items="categories" item-text="title" item-value="id")
                                span(class="red--text" v-if="errors.body") {{errors.body[0]}}
                                markdown-editor(v-model="body")
                    v-card-actions
                        v-spacer
                        v-btn(color="blue" @click.prevent="create" :disabled="disabled" ) Submit
</template>

<script>
    export default {
        data () {
            return {
                title: null,
                category_id: null,
                categories: null,
                body: null,
                errors: {}
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
        },
        computed: {
            disabled () {
                return !(this.title && this.body && this.category_id)
            }
        }
    }
</script>

<style scoped>

</style>