<template>
    <div>
        <v-navigation-drawer
            v-model="drawer"
            app
            dark
        >
            <v-list class="pt-5 pb-5">
                <v-list-item>
                    <v-list-item-avatar size="55">
                        <v-img :src="profile.foto"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title class="title">{{profile.name}}</v-list-item-title>
                        <v-list-item-subtitle>{{profile.email}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list
                nav
            >
                <v-list-item-group
                    v-model="selectedItem"
                    color="primary"
                >
                    <template v-for="(item, i) in items">
                        <v-list-item
                            :key="i"
                            link
                            :href="item.link"
                            v-if="item.link != ''"
                        >
                            <v-list-item-icon>
                                <v-icon v-text="item.icon"></v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title v-text="item.text"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item
                            :key="i"
                            link
                            @click="logout"
                            v-else
                        >
                            <v-list-item-icon>
                                <v-icon v-text="item.icon"></v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title v-text="item.text"></v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar 
            app
            dark
            color="primary"
            style="border: none; box-shadow: none;"
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>Talk Me</v-toolbar-title>
            <v-spacer></v-spacer>
            <account-app 
                :foto="profile.foto"
                :name="profile.name"
                :csrf="csrf"
                :route="route"
            ></account-app>
        </v-app-bar>
    </div>
</template>

<script>
    import Account from "./Account.vue"
    export default {
        components: {
            "account-app": Account,
        },
        props: {
            route: String,
            csrf: String,
            user: String,
            users: String
        },
        data: () => ({
            drawer: null,
            selectedItem: 0,
            items: [
                { text: 'Dashboard', icon: 'mdi-view-dashboard', link: "/" },
                { text: 'Chat', icon: 'mdi-chat', link: "/chat" },
                { text: 'Distance', icon: 'mdi-map-marker-distance', link: "/distance" },
                { text: 'About', icon: 'mdi-information', link: "/about" },
            ],
            profile: ""
        }),
        mounted: function(){
            if(window.location.pathname.split("/")[1] == 'chat'){
                this.selectedItem = 1
            }else if(window.location.pathname.split("/")[1] == 'about'){
                this.selectedItem = 3
            }else if(window.location.pathname.split("/")[1] == 'distance'){
                this.selectedItem = 2
            }
            let data = window.location.pathname
            data = data.split("/")
            this.profile = JSON.parse(this.user)
        }
    }
</script>