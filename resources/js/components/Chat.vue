<template>
    <v-row>
        <v-col cols="12" md="3" v-for="(item, i) in data" :key="i">
            <v-card>
                <v-card-text class="text-center">
                    <v-avatar class="white--text mb-3" color="blue" size="80">
                        <v-img :src="item.user.foto"></v-img>
                    </v-avatar>
                    <div>
                        <h3>{{item.user.name}}</h3>
                        <p class="mb-0">{{item.user.email}}</p>
                        <div>
                            <small>
                                <v-icon small>mdi-map-marker</v-icon>
                                {{item.location.lat + ", " + item.location.lang}}
                            </small>
                        </div>
                        <v-btn class="mt-5" link :href="'/chat/' + item.user.id" color="primary">
                            Kirim Pesan
                        </v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
    export default {
        props: {
            id: String
        },
        data() {
            return {
                data: ""
            }
        },
        async mounted() {
            this.data = await this.getData("/api/users")
            this.data = this.data.filter(item => item.user.id != this.id)
            console.log(this.data)
        },

        methods: {
            getData(url){
                return fetch(url).then(response => response.json())
            }
        }
    }
</script>

<style scoped>
    .google-map{
        height: 80vh;
        width: 100%;
    }
</style>