<template lang="pug">
    v-toolbar
        v-toolbar-title
            router-link(tag="span" to="/" style="cursor: pointer;") Pusher
        v-spacer
        v-toolbar-items(class="hidden-sm-and-down")
            v-btn(to="/forum" flat) Forum
            v-btn(flat) Ask Question
            v-btn(flat) Category
            v-btn(to="/login" flat) Login
</template>

<script>
    export default {

    }
</script>

<style scoped>

</style>