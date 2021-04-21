<template>
    <div>
        <v-row align="center">
            <v-col cols="6">
                <v-text-field v-model="password" :append-icon="show1 ? 'visibility' : 'visibility_off'"
                              :type="show1 ? 'text' : 'password'" name="password" id="password" :counter="100"
                              placeholder="Senha" @click:append="show1 = !show1"></v-text-field>
            </v-col>
            <v-col cols="6">
                <v-text-field v-model="passwordc" :append-icon="show2 ? 'visibility' : 'visibility_off'"
                              :type="show2 ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" :counter="100"
                              placeholder="Confirme a Senha" @click:append="show2 = !show2"></v-text-field>
            </v-col>
        </v-row>
        <v-spacer></v-spacer>
        <v-btn class="mx-2" dark large color="primary" @click="alterarSenha()">
            Alterar Senha
        </v-btn>

        <v-snackbar
            v-model="snackbar"
            :color="color"
            right
            :timeout="6000"
            top
            vertical
        >
            {{ text }}
            <v-btn
                dark
                text
                @click="snackbar = false"
            >
                Fechar
            </v-btn>
        </v-snackbar>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        name: "AlterarSenhaForm",
        data: () => ({
            password: null,
            passwordc: null,
            show1: false,
            show2: false,
            color: '',
            text: '',
            snackbar: false,
        }),
        methods: {
            alterarSenha() {
                const data = {
                    password: this.password,
                    password_confirmation: this.passwordc,
                    id: this.user.id
                }
                Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
                this.$http.post('/usuario/alterar-senha', data).then(response => {
                    this.dialog = false;
                    if (response.body.success) {
                        this.snackbar = true;
                        this.text = 'Senha modificada com sucesso!';
                        this.color = 'success';
                    } else {
                        this.snackbar = true;
                        this.text = 'Erro ao alterar senha! ' + response.body.message;
                        this.color = 'error';
                    }
                });

            },
        }
    }
</script>

<style scoped>

</style>
