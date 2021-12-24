<template>
    <v-list>
        <v-list-item v-for="(message ,i) in messages" :key="i" :class="message.user_id != iduser ? 'grey mt-3': 'blue darken-2 mt-3'">
            <v-list-item-content :class="message.user_id == iduser ? 'text-right white--text' : 'text-left white--text'">
                <v-list-item-title>
                    {{message.message}}
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</template>

<script>
export default {
    props: {
        messages: Array,
        iduser: String
    },
    mounted(){
        console.log(this.messages)
        console.log(this.iduser)
    },
}
</script>