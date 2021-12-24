<template>
    <div style="position: relative;">
        <v-select
            :items="users"
            label="Location"
            solo
            @change="getLocation"
            style="position: absolute; left: 10px; top: 10px; right: 0; z-index: 2; width: 300px;"
        ></v-select>
        <div class="google-map" ref="googleMap"></div>
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
                markers: [],
                users: [],
            }
        },
        async mounted() {
            await this.location(this.id)
            const googleMapApi = await GoogleMapsApiLoader({
                apiKey: "AIzaSyD1oZt3zQJPzmzRf4hnGYPpdRjUNVUyBaY"
            })
            this.google = googleMapApi
            this.initializeMap()
            this.data = await this.fetchMessages();
            this.data.locations.map(location => {
                const marker = this.addMarker({ lat: parseFloat(location.lat), lng: parseFloat(location.lang) }, this.map);
                const user = this.data.users.filter(u => u.id == location.user_id)[0]
                if(user.name != undefined || user.name != ''){
                    const infoWindow = this.infoWindow({name: user.name, email: user.email, foto: user.foto})
                    marker.addListener("click", event => {
                        infoWindow.open(this.map, marker)
                    })
                    this.markers.push(marker)
                }
            })
            this.data.users.map(user => {
                this.users.push(user.email)
            })
            setInterval(() => {
                this.location(this.id)
                this.data.locations.map((location, i) => {
                    this.markers[i].setPosition({ lat: parseFloat(location.lat), lng: parseFloat(location.lang) }, this.map);
                    const user = this.data.users.filter(u => u.id == location.user_id)[0]
                    const infoWindow = this.infoWindow({name: user.name, email: user.email, foto: user.foto})
                    this.markers[i].addListener("click", event => {
                        infoWindow.open(this.map, this.markers[i])
                    })
                })
            }, 5000)
        },
        methods: {
            initializeMap() {
                const mapContainer = this.$refs.googleMap
                this.map = new this.google.maps.Map(mapContainer, {
                    zoom: 5,
                    center: { lat: 0.525082, lng: 101.448745 },
                    disableDefaultUI: true,
                })
            },
            addMarker(location, map) {
                return new google.maps.Marker({
                    position: location,
                    map: map,
                });
            },
            infoWindow(data){
                const content = `
                <div>
                    <div style="width: 70px; height: 70px; border-radius: 50%; overflow: hidden; margin: auto;">
                        <img src="${data.foto}" alt="" height="100%" width="100%">
                    </div>
                    <div style="margin-top: 10px; text-align: center;">
                        <h3>${data.name}</h3>
                        <p>${data.email}</p>
                    </div>
                </div>
            `
                return new google.maps.InfoWindow({
                    content: content,
                });
            },
            fetchMessages() {
                //MENGGUNAKAN AXIOS UNTUK MELAKUKAN AJAX REQUEST
                return axios.get('/api/location').then(response => response.data);
            },
            location(id){
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition((position) => {
                        const pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        }
                        console.log(position)
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
            },
            setMapOnAll(map) {
                this.markers.map(marker => {
                    marker.setMap(map)
                })
            },
            clearMarkers() {
                this.setMapOnAll(null);
            },
            deleteMarkers() {
                this.clearMarkers();
                this.markers = [];
            },
            getLocation(value){
                const user = this.data.users.filter(user => user.email == value)[0]
                let location = this.data.locations.filter(location => location.user_id == user.id)[0]
                this.map.setCenter({lat: parseFloat(location.lat), lng: parseFloat(location.lang)})
                this.map.setZoom(16)
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