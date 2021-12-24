<template>
     <v-row>
        <v-col cols="12" md="8">
            <v-card height="80vh" style="position: relative;" elevation="10">
                <v-card-title>
                    <v-list style="width: 100%;">
                        <v-list-item style="width: 100%;">
                            <v-list-item-avatar size="50">
                                <v-img :src="image"></v-img>
                            </v-list-item-avatar>
                            <v-list-item-content>
                                <v-list-item-title>{{name}}</v-list-item-title>
                                <v-list-item-subtitle>{{email}}</v-list-item-subtitle>
                            </v-list-item-content>
                            <v-spacer></v-spacer>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <v-icon>mdi-map-marker</v-icon>
                                    {{lat + ", " + lng}}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text style="height: 52vh; overflow: auto;" v-chat-scroll>
                    <list-message :messages="messages" :iduser="auth"></list-message>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <form-message v-on:sent="addMessage" :user="auth"></form-message>
                </v-card-actions>
            </v-card>
        </v-col>
        <v-col cols="12" md="4">
            <div class="google-map" ref="googleMap" style="height: 100%; width: 100%;"></div>
        </v-col>
    </v-row>
</template>

<script>
import ListMessage from "./ListMessage.vue"
import FormMessage from "./FormMessage.vue"
import GoogleMapsApiLoader from 'google-maps-api-loader'
export default {
    props: [ "user", "auth", "to" ],
    data: () => ({
        messages: [],
        email: "",
        name: "",
        lat: "",
        lng: "",
        image: "",
        google: "",
        map: ""
    }),
    components: {
        "list-message": ListMessage,
        "form-message": FormMessage
    },
    mounted: async function(){
        this.messages = await this.fetchMessages();
        this.name = (JSON.parse(this.user)).user.name
        this.image = (JSON.parse(this.user)).user.foto
        this.email = (JSON.parse(this.user)).user.email
        this.lat = parseFloat((JSON.parse(this.user)).location.lat)
        this.lng = parseFloat((JSON.parse(this.user)).location.lang)

        const googleMapApi = await GoogleMapsApiLoader({
            apiKey: "AIzaSyD1oZt3zQJPzmzRf4hnGYPpdRjUNVUyBaY"
        })
        this.google = googleMapApi
        this.initializeMap()

        const marker = new google.maps.Marker({
            position: {lat: parseFloat(this.lat), lng: parseFloat(this.lng)},
            map: this.map,
        });
        const infoWindow = this.infoWindow({name: this.name, email: this.email, foto: this.image})
        marker.addListener("click", event => {
            infoWindow.open(this.map, marker)
        })

        //MAKA AKAN MENJALANKAN FUNGSI fetchMessage()
      
        //DAN MENGGUNAKAN LARAVEL ECHO, KITA AKSES PRIVATE CHANNEL BERNAMA CHAT YANG NNTINYA AKAN DIBUAT
        //KEMUDIAN EVENTNYA KITA LISTEN ATAU PANTAU JIKA ADA DATA YANG DIKIRIM 
        Echo.private('chat')
        .listen('MessageSent', (e) => {
            //DATA YANG DITERIMA AKAN DITAMBAHKAN KE DALAM VARIABLE MESSAGES SEBELUMNYA
            this.messages.push(e.message)
        })
    },
    methods: {
        initializeMap() {
            const mapContainer = this.$refs.googleMap
            this.map = new this.google.maps.Map(mapContainer, {
                zoom: 16,
                center: { lat: parseFloat(this.lat), lng: parseFloat(this.lng ) },
                disableDefaultUI: true,
            })
        },
        addMessage(message){
            const data = {
                message: message.message,
                to: this.to,
                user_id: this.auth
            }
            this.messages.push(message);

            axios.post('/api/messages', data).then(response => {
              console.log(response.data);
            });
        },
        fetchMessages() {
            //MENGGUNAKAN AXIOS UNTUK MELAKUKAN AJAX REQUEST
            // return axios.get(`http://localhost:8000/api/messages/${(JSON.parse(this.user)).user.id}/${this.to}`).then(response => {
            //     //SETIAP DATA YANG DITERIMA AKAN DITAMBAHKAN KE VARIABLE MESSAGES
            //     return response.data;
            // });
            return fetch(`/api/messages/${this.auth}/${this.to}`).then(response => response.json())
        },
        infoWindow(data){
            const content = `
                <div>
                    <div style="width: 70px; height: 70px; border-radius: 50%; overflow: hidden; margin: auto;">
                        <img src="${data.foto}" alt="" height="100%" width="100%">
                    </div>
                    <div style="margin-top: 10px; text-align: center;">
                        <h3>${data.name}</h3>
                        <p class='mb-0'>${data.email}</p>
                    </div>
                </div>
            `
            return new google.maps.InfoWindow({
                content: content,
            });
        },
    },
}
</script>