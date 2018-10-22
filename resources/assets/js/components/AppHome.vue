<template lang="pug">
    div
        toolbar
        router-view
        app-footer
</template>

<script>
    import Toolbar from './Toolbar'
    import Footer from './Footer'
    export default {
        components: {
            Toolbar,
            AppFooter: Footer
        }
    }
</script>

<style scoped>

</style>