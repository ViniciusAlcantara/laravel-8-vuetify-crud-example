<template>
    <div>
        <v-container fluid>
            <v-row align="center">
                <v-col cols="6">
                    <v-text-field v-model="nome" name="name" id="nome" :counter="100"
                                  placeholder="Nome"></v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-text-field type="email" v-model="email" name="email" id="email" :counter="100" :readonly="user != null"
                                  placeholder="Email"></v-text-field>
                </v-col>
            </v-row>
            <v-row align="center" v-if="user == null">
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
        </v-container>
    </div>
</template>

<script>
    export default {
        props: ['user', 'atual'],
        name: "UsuarioForm",
        data: () => ({
            password: null,
            nome: null,
            email: null,
            telefone: null,
            ddd: null,
            passwordc: null,
            perfis: [
                {id: 1, nome: 'Administrador'},
                {id: 2, nome: 'Usuário'},
                {id: 3, nome: 'Condomínio'},
                {id: 4, nome: 'Administradora de Condomínios'},
            ],
            fk_perfil: 2,
            show1: false,
            show2: false,
            edit: false
        }),
        mounted() {
            if (this.user) {
                console.log(this.user)
                if (this.atual.fk_perfil != 1) this.edit = true;
                this.nome = this.user.name
                this.email = this.user.email
                this.fk_perfil = this.user.fk_perfil
            }
        }
    }
</script>

<style scoped>

</style>
