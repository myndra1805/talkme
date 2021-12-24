<template>
    <v-menu
        offset-y
    >
        <template v-slot:activator="{ attrs, on }">
            <v-badge
                offset-x="20"
                offset-y="20"
                bordered
                dot
                color="red"
            >
                <v-btn 
                    icon
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon>mdi-bell</v-icon>
                </v-btn>
            </v-badge>
        </template>
        <v-card height="145px">
            <v-list>
                <v-list-item
                    v-for="i in 5"
                    :key="i"
                >
                    <v-list-item-avatar size="50px" color="red">
                        <span class="white--text">AY</span>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>Ari Yuhendra</v-list-item-title>
                        <v-list-item-subtitle>ariyuhendra@gmail.com</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                        <v-btn small>Terima</v-btn> 
                    </v-list-item-action>
                </v-list-item>
            </v-list>
        </v-card>
    </v-menu>
</template>

<script>
export default {

}
</script>