<template>
    <v-menu
        offset-y
    >
        <template v-slot:activator="{ attrs, on }">
            <v-btn 
                v-bind="attrs"
                v-on="on"
                large
                text
            >
                <v-avatar size="40" class="mr-2">
                    <v-img :src="foto"></v-img>
                </v-avatar>
                {{name}}
                <v-icon size="20">mdi-chevron-down</v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-list>
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
            </v-list>
        </v-card>
        <form :action="route" method="post" id="logout">
            <span v-html="csrf"></span>
        </form>
    </v-menu>
</template>

<script>
export default {
    props: {
        foto: String,
        route: String,
        csrf: String,
        name: String
    },
    data: () => ({
        items: [
            { text: 'Profile', icon: 'mdi-account', link: "/profile" },
            { text: 'Logout', icon: 'mdi-logout', link: "" },
        ]
    }),
    methods: {
        logout: function(){
            document.querySelector("#logout").submit()
        }
    }
}
</script>