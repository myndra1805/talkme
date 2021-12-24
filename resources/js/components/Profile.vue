<template>
    <div>
        <v-img
            :src="profile.foto"
            height="300px"
            position="relative"
            width="100%"
        >
            <upload-foto :csrf="csrf"></upload-foto>
        </v-img>
        <v-alert
            close-text="Close Alert"
            dark
            dismissible
            v-if="status == '' ? false : true"
            dense
            text
            type="success"
            class="mt-3"
        >{{status}}</v-alert>
        <v-alert
            close-text="Close Alert"
            dark
            dismissible
            v-else-if="error == '' ? false : true"
            dense
            text
            type="error"
            class="mt-3"
        >{{error}}</v-alert>
        <form action="/profile/update" method="post">
            <span v-html="csrf"></span>
            <input type="hidden" name="id" :value="profile.id">
            <v-row class="mt-5">
                <v-col cols="12" md="6" class="pb-0 pt-0">
                    <v-text-field
                        solo
                        v-model="profile.name"
                        prepend-inner-icon="mdi-account-box"
                        name="name"
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="6" class="pb-0 pt-0">
                    <v-text-field
                        solo
                        name="email"
                        type="email"
                        v-model="profile.email"
                        prepend-inner-icon="mdi-email"
                        disabled
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="6" class="pb-0 pt-0">
                    <v-menu
                        ref="menu"
                        v-model="menu"
                        :close-on-content-click="false"
                        :return-value.sync="date"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                    >
                        <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="date"
                                label="Picker in menu"
                                prepend-inner-icon="mdi-calendar"
                                readonly
                                solo
                                name="birtday"
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            v-model="date"
                            no-title
                            scrollable
                        >
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="primary"
                                @click="menu = false"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                @click="$refs.menu.save(date)"
                            >
                                OK
                            </v-btn>
                        </v-date-picker>
                    </v-menu>
                </v-col>
                <v-col cols="12" md="6" class="pb-0 pt-0">
                    <v-select
                        :items="genders"
                        label="Gender"
                        v-model="profile.gender"
                        solo
                        name="gender"
                        :prepend-inner-icon="profile.gender == 'Laki-Laki' ? 'mdi-gender-male' : 'mdi-gender-female'"
                    ></v-select>
                </v-col>
            </v-row>
            <v-row class="mt-5">
                <v-col cols="12" md="6" class="pb-0 pt-0">
                    <v-text-field
                        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show1 ? 'text' : 'password'"
                        name="new_password"
                        label="New Password"
                        solo
                        hint="Kosongkan jika tidak ingin mengubah password"
                        @click:append="show1 = !show1"
                        persistent-hint
                    ></v-text-field>
                </v-col>
                <v-col cols="12" md="6" class="pb-0 pt-0">
                    <v-text-field
                        :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="show2 ? 'text' : 'password'"
                        name="old_password"
                        label="Old Password"
                        solo
                        hint="Kosongkan jika tidak ingin mengubah password"
                        @click:append="show2 = !show2"
                        persistent-hint
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="space-around" class="mt-5">
                <v-col cols="12" sm="4">
                    <v-btn color="blue darken-2" width="100%" dark name="edit" type="submit">Edit Profile</v-btn>
                </v-col>
                <v-col cols="12" sm="4">
                    <v-btn color="red" width="100%" dark @click="deleteAccount">Delete Profile</v-btn>
                </v-col>
            </v-row>
        </form>

        <form action="/profile/delete" method="post" id="delete">
            <input type="hidden" name="id" :value="profile.id">
            <span v-html="csrf"></span>
        </form>
    </div>
</template>

<script>
import UploadFoto from "./UploadFoto.vue"
export default {
    components: {
        "upload-foto": UploadFoto
    },
    props: {
        user: String,
        csrf: String,
        status: String,
        error: String,
    },
    data: () => ({
        profile: "",
        menu: false,
        date: new Date().toISOString().substr(0, 10),
        show1: false,
        show2: false,
        genders: ["Laki-Laki", "Perempuan"]
    }),
    mounted: function(){
        this.profile = JSON.parse(this.user)
        this.profile.gender = this.profile.gender == 'l' ? 'Laki-Laki' : 'Perempuan'
        this.date = this.profile.birtday
    },
    methods: {
        deleteAccount: function(){
            if(confirm("Anda ingin menghapus account ?")){
                document.querySelector("#delete").submit()
            }
        }
    }
}
</script>