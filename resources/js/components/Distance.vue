<template>
    <div>
        <v-row>
            <v-col cols="12" md="8">
                <div style="position: relative;">
                    <v-row style="position: absolute; top: 10px; left: 10px; right: 0; z-index: 2;">
                        <v-col cols="12" md="4">
                            <v-select
                                id="start"
                                disabled
                                solo
                                :label="me"
                            ></v-select>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-select
                                :items="users"
                                id="end"
                                label="Tujuan"
                                @change="onChangeHandler"
                                solo
                            ></v-select>
                        </v-col>
                        <v-col cols="12" md="4">
                            <v-btn style="margin-top: 8px;" color="primary" dark @click="getRute">Search</v-btn>
                        </v-col>
                    </v-row>
                    <div class="google-map" ref="googleMap"></div>
                </div>
            </v-col>
            <v-col sm="12" md="4">
                <v-card min-height="81vh">
                    <v-card-text id="right-panel" style="overflow: auto;"></v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader'

    export default {
        props: {
            id: String
        },
        data() {
            return {
                dialog: false,
                google: null,
                map: null,
                data: "",
                users: [],
                start: "",
                me: "Lokasi Saya",
                directionsService: "",
                directionsRenderer: "",
                end: ""
            }
        },
        async mounted() {
            const googleMapApi = await GoogleMapsApiLoader({
                apiKey: "AIzaSyD1oZt3zQJPzmzRf4hnGYPpdRjUNVUyBaY"
            })
            this.google = googleMapApi
            this.directionsService = new google.maps.DirectionsService();
            this.directionsRenderer = new google.maps.DirectionsRenderer();
            this.initializeMap()
            this.directionsRenderer.setMap(this.map);
            this.location(this.id)
            this.data = await this.fetchMessages();
            this.users = this.data.users.filter(user => user.id != this.id)
            let users = []
            this.users.map(user => {
                users.push(user.email)
            })
            this.users = users
            setInterval(() => {
                this.location(this.id)
            }, 3000)
        },
        methods: {
            calculateAndDisplayRoute(directionsService, directionsRenderer, data) {
                directionsService.route(
                {
                    origin: {
                        query: data.start,
                    },
                    destination: {
                        query: data.end,
                    },
                    travelMode: google.maps.TravelMode.DRIVING,
                }, (response, status) => {
                    if (status === "OK") {
                        directionsRenderer.setDirections(response);
                    } else {
                        window.alert("Directions request failed due to " + status);
                    }
                });
            },
            onChangeHandler(value){
                const user = this.data.users.filter(user => user.email == value)[0]
                let end = this.data.locations.filter(location => location.user_id == user.id)[0]
                let start = this.data.locations.filter(location => location.user_id == this.id)[0]
                this.end = end.lat + ", " + end.lang
                this.start = start.lat + ", " + start.lang  
            },
            getRute(){
                const data = {
                    start: this.start,
                    end: this.end
                }
                this.calculateAndDisplayRoute(this.directionsService, this.directionsRenderer, data);
                this.directionsRenderer.setPanel(document.querySelector("#right-panel"));
            },
            initializeMap() {
                const mapContainer = this.$refs.googleMap
                this.map = new this.google.maps.Map(mapContainer, {
                    zoom: 12,
                    center: { lat: 0.525082, lng: 101.448745 },
                })
            },
            fetchMessages() {
                //MENGGUNAKAN AXIOS UNTUK MELAKUKAN AJAX REQUEST
                return axios.get('/api/location').then(response => response.data);
            },
            location(id){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        }
                        axios.post('/api/location', {
                            lat: pos.lat,
                            lng: pos.lng,
                            id: id
                        }).then(async (response) => {
                            this.data = await this.fetchMessages()
                        })
                    }, () => {
                        console.log("Error: Your browser doesn't support geolocation")
                    });
                } else {
                    // Browser doesn't support Geolocation
                    console.log("Error: The Geolocation service failed.")
                }
            }
        },
    }
</script>

<style scoped>
    .google-map{
        height: 81vh;
        width: 100%;
    }
</style>