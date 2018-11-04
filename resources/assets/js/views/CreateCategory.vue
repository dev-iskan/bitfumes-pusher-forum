<template lang="pug">
    v-container(fluid)
        v-layout(row wrap)
            v-flex(xs12)
                v-card
                    v-card-title
                        div
                            div.headline Create new category
                    v-card-text
                        v-form
                            v-container
                                v-text-field(label="Category Name" v-model="title" type="text" required)
                    v-card-actions
                        v-spacer
                        v-btn(color="pink" v-if="editing" dark @click.prevent="update") Update
                        v-btn(color="green" v-else dark @click.prevent="create") Submit
            v-flex(xs12)
                v-card
                    v-toolbar(color="indigo" dark dense)
                        v-toolbar-title Categories
                    v-list
                        template(v-for="(category, index) in categories" )
                            v-list-tile(:key="category.id")
                                v-list-tile-content
                                    v-list-tile-title {{category.title}}
                                v-list-tile-action
                                    v-btn(icon small)
                                        v-icon(color="orange" @click="edit(index)") edit
                                v-list-tile-action
                                    v-btn(icon small)
                                        v-icon(color="red" @click="destroy(category.slug, index)") delete
                            v-divider
</template>

<script>
    import User from "../helpers/User";

    export default {
        data () {
            return {
                title: null,
                errors: null,
                categories: null,
                editing : null
            }
        },
        created () {
            if(!User.admin()){
                this.$router.push('/forum');
            } else {
                axios.get(`/api/category`)
                    .then(res => this.categories = res.data.data)
            }
        },
        methods: {
            create () {
                axios.post(`/api/category`, {
                    title: this.title
                })
                    .then(res => {
                        this.categories.unshift(res.data);
                        this.title = null
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors
                    })
            },

            destroy (slug, index) {
                axios.delete(`/api/category/${slug}`)
                    .then(res => {
                        this.categories.splice(index, 1)
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors
                    })
            },

            edit (index) {
                this.title = this.categories[index].title;
                this.editing = this.categories[index].slug;
                this.categories.splice(index, 1);
            },
            update () {
                axios.patch(`/api/category/${this.editing}`, {
                    title: this.title
                })
                    .then(res => {
                        this.categories.unshift(res.data);
                        this.title = null
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