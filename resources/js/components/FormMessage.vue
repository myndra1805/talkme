<template>
    <v-row style="">
        <v-col cols="9">
            <v-text-field
                solo
                full-width
                label="Kirim Pesan"
                @keydown.enter="submit"
                v-model="message"
            >
            </v-text-field>
        </v-col>
        <v-col cols="3">
            <v-btn width="100%" @click="submit" style="margin-top: 2px;" x-large color="primary">
                KIRIM
            </v-btn>
        </v-col>
    </v-row>
</template>

<script>
export default {
    props: ["user"],
    data: () => ({
        message: ''
    }),
    methods: {
        submit(){
            this.$emit("sent", {
                user_id: (JSON.parse(this.user)).id,
                message: this.message
            })
            this.message = ""
        },
    }
}
</script>

<style>

</style>