<template>
    <v-container fluid style="height: 100vh;">
        <v-row class="pb-0 pt-0 mb-0" style="height: 100vh">
            <v-col cols="12" md="6" class="text-center white--text bg-login" style=" background-image: url('/images/3438958.jpg'); background-size: 100% 100%;">
                <v-row justify="center" style="height: 100%;">
                    <v-col cols="12" md="10" class="white--text" align-self="center">
                        <h4>Nice to see you again</h4>
                        <h1>WELCOME BACK</h1>
                    </v-col>
                </v-row>
            </v-col>
            <v-col cols="12" md="6" class="white pl-5 pr-5 pt-5 pb-5" style="border: 2px solid red;" align-self="center">
                <v-card max-width="500px" style="margin: auto;">
                    <v-card-text style="padding: 50px 20px;">
                        <div class="text-center">
                            <v-avatar color="blue" class="white--text" size="100" style="margin: auto;">
                                <span>TM</span>
                            </v-avatar>
                        </div>
                        <h1 class="text-center mb-5 mt-5">LOGIN</h1>
                        <form action="/login" method="POST">
                            <span v-html="csrf"></span>
                            <v-text-field
                                label="Email"
                                solo
                                prepend-inner-icon="mdi-account"
                                name="email"
                                type="email"
                            ></v-text-field>
                            <v-text-field
                                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                :rules="[rules.emailMatch]"
                                :type="show ? 'text' : 'password'"
                                prepend-inner-icon="mdi-lock"
                                name="password"
                                label="Password"
                                solo
                                error
                                @click:append="show = !show"
                                v-if="error"
                            ></v-text-field>
                            <v-text-field
                                v-else
                                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                                prepend-inner-icon="mdi-lock"
                                :type="show ? 'text' : 'password'"
                                name="password"
                                label="Password"
                                solo
                                @click:append="show = !show"
                            ></v-text-field>
                            <v-checkbox
                                label="Remember Me"
                                name="remember"
                            ></v-checkbox>
                            <v-row>
                                <v-col cols="12" sm="6">
                                    <v-btn type="submit" name="submit" style="width: 100%;" color="blue" dark>LOGIN</v-btn>
                                </v-col>
                                <v-col cols="12" sm="6">
                                    <v-btn type="submit" name="submit" text style="width: 100%;">Lupa Password ?</v-btn>
                                </v-col>
                            </v-row>
                        </form>
                    </v-card-text>
                </v-card>
                <p class="text-center mt-5">Don't have account ? <a href="/register">Sign Up</a></p>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    props: {
        error: String,
        csrf: String
    },
    data: () => ({
        show: false,
        rules: {
            emailMatch: () => (`Username atau password yang anda masukkan salah`),
        },
    }),
    mounted: function(){
        console.log(this.error)
    }
}
</script>

<style scoped>
    @media screen and (max-width: 960px) {
        .bg-login{
            display: none;
        }
    }
</style>