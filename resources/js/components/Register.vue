<template>
    <v-container fluid style="height: 100vh;">
        <v-row style="height: 100vh;">
            <v-col cols="12" md="6" class="bg-register text-center white--text pb-0">
                <v-row justify="center" style="height: 100%;" align="center">
                    <v-col cols="12" md="10" class="white--text" align-self="center">
                        <h4 class="mb-0 mt-5">Join us in giving hope to people</h4>
                        <h1>Lorem ipsum dolor sit amet.</h1>
                    </v-col>
                </v-row>
            </v-col>
            <v-col cols="12" md="6" class="white" align-self="center">
                <v-card max-width="600px" style="margin: auto;">
                    <v-card-text class="pt-10 pb-10">
                        <div class="text-center">
                            <v-avatar color="blue" class="white--text" size="100" style="margin: auto;">
                                <span>TM</span>
                            </v-avatar>
                        </div>
                        <h1 class="text-center mb-5 mt-5 judul">REGISTER ACCOUNT</h1>
                        <form-register
                            :csrf="csrf"
                            :name="name"
                            :gender="gender"
                            :birtday="birtday"
                            :email="email"
                            :password="password"
                        ></form-register>
                    </v-card-text>
                </v-card>
                <p class="text-center mt-5">Have account ? <a href="/login">Sign In</a></p>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import FormRegister from "./FormRegister.vue"
export default {
    components: {
        "form-register": FormRegister 
    },
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
}
</script>

<style scoped>
    .bg-register{
        background-image: url('/images/3438958.jpg');
        background-size: 100% 100%;
    }
    @media screen and (max-width: 960px) {
        .bg-register{
            display: none;
        }
    }
    @media screen and (max-width: 600px) {
        .judul{
            font-size: 25px;
        }
    }
</style>