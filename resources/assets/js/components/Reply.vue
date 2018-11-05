<template lang="pug">
    v-card(class="mb-3")
        v-card-title
            div.headline {{data.user}}
            div(class="ml-2") said {{data.created_at}}
        v-divider
        div(v-if="editing")
            markdown-editor(v-model="updateReply")
        v-card-text(v-html="reply" v-else)
        v-divider
        v-card-actions(v-if="own")
            v-layout(v-if="this.editing")
                v-spacer
                v-btn(icon)
                    v-icon(color="green" @click="update") save
                v-btn(icon)
                    v-icon(color="red" @click="cancel") cancel
            v-layout(v-else)
                v-spacer
                v-btn(icon)
                    v-icon(color="orange" @click="edit") edit
                v-btn(icon)
                    v-icon(color="red" @click="destroy") delete
</template>

<script>
    import User from '../helpers/User'
    export default {
        props: ['data', 'index', 'slug'],
        data () {
            return {
                editing: null,
                updateReply: ''
            }
        },
        computed: {
            own () {
               return User.own(this.data.user_id)
            },
            reply () {
                return md.parse(this.data.body)
            }
        },
        methods: {
            destroy () {
                EventBus.$emit('deleteReply', this.index)
            },
            edit () {
                this.updateReply = this.data.body
                this.editing = true
            },
            cancel () {
                this.editing = false
            },
            update () {
                axios.patch(`/api/question/${this.slug}/reply/${this.data.id}`, {
                    body: this.updateReply
                })
                    .then(res => {
                        this.data.body = this.updateReply
                        this.cancel();
                        this.updateReply = ''
                    })
                    .catch(err => console.log(err))
            }
        }
    }
</script>

<style scoped>

</style>