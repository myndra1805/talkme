<template>
    <v-dialog
        v-model="dialog"
        persistent
        max-width="290"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                dark
                v-bind="attrs"
                v-on="on"
                icon
                style="position: absolute; bottom: 0; right: 0;"
            >
                <v-icon>mdi-camera</v-icon>
            </v-btn>
        </template>
        <v-card>
            <form action="/profile/foto" method="post" enctype="multipart/form-data">
                <v-card-text>
                    <span v-html='csrf'></span>
                     <v-file-input
                        accept="image/png, image/jpeg, image/bmp"
                        prepend-icon="mdi-camera"
                        label="Foto Profile"
                        name="foto"
                    ></v-file-input>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red"
                        dark
                        @click="dialog = false"
                        small
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue darken-2"
                        type="submit"
                        name="save"
                        dark
                        small
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </form>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    props: {
        csrf: String
    },
    data () {
        return {
            dialog: false,
        }
    },
}
</script>