<template>
    <form action="/register" method="POST">
        <span v-html="csrf"></span>
        <v-row>
            <v-col cols="12" sm="6">
                <v-text-field
                    :rules="[rulesName.validation]"
                    prepend-inner-icon="mdi-account"
                    name="name"
                    label="Name"
                    solo
                    error
                    v-if="name"
                ></v-text-field>
                <v-text-field
                    solo
                    name="name"
                    label="Name"
                    prepend-inner-icon="mdi-account"
                    v-else
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
                <v-text-field
                    solo
                    name="email"
                    type="email"
                    label="Email"
                    prepend-inner-icon="mdi-email"
                    v-if="email"
                    error
                    :rules="[rulesEmail.validation]"
                ></v-text-field>
                <v-text-field
                    solo
                    name="email"
                    type="email"
                    label="Email"
                    prepend-inner-icon="mdi-email"
                    v-else
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
                <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="date"
                            label="Birthday"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            solo
                            name="date"
                            prepend-inner-icon="mdi-calendar"
                            v-if="birtday"
                            :rules="[rulesBirtday.validation]"
                            error
                        ></v-text-field>
                        <v-text-field
                            v-model="date"
                            label="Birthday"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            solo
                            name="date"
                            v-else
                            prepend-inner-icon="mdi-calendar"
                        ></v-text-field>
                    </template>
                    <v-date-picker
                        ref="picker"
                        v-model="date"
                        :max="new Date().toISOString().substr(0, 10)"
                        min="1950-01-01"
                        @change="save"
                    ></v-date-picker>
                </v-menu>
            </v-col>
            <v-col cols="12" sm="6">
                <v-select
                    :items="genders"
                    label="Gender"
                    solo
                    name="gender"
                    prepend-inner-icon="mdi-gender-male"
                    v-if="gender"
                    :rules="[rulesGender.validation]"
                    error
                ></v-select>
                <v-select
                    :items="genders"
                    v-else
                    label="Gender"
                    solo
                    name="gender"
                    prepend-inner-icon="mdi-gender-male"
                ></v-select>
            </v-col>
            <v-col cols="12" sm="6">
                <v-text-field
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show1 ? 'text' : 'password'"
                    name="password"
                    label="Password"
                    solo
                    @click:append="show1 = !show1"
                    prepend-inner-icon="mdi-lock"
                    v-if="password !=''"
                    :rules="[rulesPassword.validation]"
                    error
                ></v-text-field>
                <v-text-field
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show1 ? 'text' : 'password'"
                    name="password"
                    label="Password"
                    solo
                    @click:append="show1 = !show1"
                    v-else
                    prepend-inner-icon="mdi-lock"
                ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
                <v-text-field
                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show2 ? 'text' : 'password'"
                    name="password_confirmation"
                    label="Confirm Password"
                    solo
                    prepend-inner-icon="mdi-lock"
                    @click:append="show2 = !show2"
                    :rules="[rulesPassword.validation]"
                    error
                    v-if="password !=''"
                ></v-text-field>
                <v-text-field
                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show2 ? 'text' : 'password'"
                    name="password_confirmation"
                    label="Confirm Password"
                    solo
                    prepend-inner-icon="mdi-lock"
                    @click:append="show2 = !show2"
                    v-else
                ></v-text-field>
            </v-col>
            <v-col cols="12">
                <v-btn type="submit" dark color="blue" width="100%" large>REGISTER</v-btn>
            </v-col>
        </v-row>
    </form>
</template>

<script>
export default {
    props: {
        csrf: String,
        name: String,
        gender: String,
        email: String,
        birtday: String,
        password: String,
    },
    data: () => ({
        show1: false,
        show2: false,
        date: null,
        menu: false,
        genders: ["Laki-Laki", "Perempuan"],
        rulesName: {
            validation: () => (""),
        },
        rulesEmail: {
            validation: () => (""),
        },
        rulesGender: {
            validation: () => (""),
        },
        rulesBirtday: {
            validation: () => (""),
        },
        rulesPassword: {
            validation: () => (""),
        },
    }),
    watch: {
      menu (val) {
        val && setTimeout(() => (this.$refs.picker.activePicker = 'YEAR'))
      },
    },
    methods: {
      save (date) {
        this.$refs.menu.save(date)
      },
    },
    mounted: function(){
        this.rulesPassword.validation = this.password
        this.rulesBirtday.validation = this.birtday
        this.rulesName.validation = this.name
        this.rulesGender.validation = this.gender
        this.rulesEmail.validation = this.email
    }
}
</script>