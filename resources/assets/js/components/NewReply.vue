<template lang="pug">
    div
        markdown-editor(v-model="body")
        v-btn(color="green" dark @click.prevent="submit") Done
</template>

<script>
    export default {
        props: ['slug'],
        data () {
            return {
                body: null
            }
        },
        methods: {
            submit () {
                axios.post(`/api/question/${this.slug}/reply`, {
                    body: this.body
                })
                    .then(res => {
                        this.body = '';
                        EventBus.$emit('newReply',  res.data.reply)
                        window.scroll(0,0)
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped>

</style>