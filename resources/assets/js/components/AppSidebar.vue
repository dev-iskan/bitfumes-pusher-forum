<template lang="pug">
   v-card
        v-toolbar(dark color="cyan" dense)
            v-toolbar-title Categories
        v-list
            v-list-tile(v-for="category in categories" :key="category.id" @click="")
                v-list-tile-content
                    v-list-tile-title {{category.title}}
</template>

<script>
    export default {
        data () {
            return {
                categories: null
            }
        },
        created () {
            axios.get(`/api/category`)
                .then(res => this.categories = res.data.data)
        }
    }
</script>

<style scoped>

</style>