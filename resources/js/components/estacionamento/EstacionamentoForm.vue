<template>
    <div>
        <v-container fluid>
            <v-row align="center">
                <v-col cols="6">
                    <v-text-field v-model="nome_estacionamento" name="nome" id="nome" :counter="100"
                                  placeholder="Nome Estacionamento"></v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-text-field v-model="cnpj" name="cnpj" id="cnpj" :counter="100"
                                  placeholder="CNPJ Estacionamento"></v-text-field>
                </v-col>
            </v-row>
            <v-row align="center">
                <v-col cols="12">
                    <v-autocomplete  :items="usuarios" v-model="fk_usuario" label="Usuário Responsável"
                                     name="fk_usuario" id="fk_usuario" clear-icon="close"
                                     item-text="autocomplete" item-value="id" hide-selected
                    >
                    </v-autocomplete>
                </v-col>
            </v-row>
            <v-row align="center">
                <v-col cols="12">
                    <v-text-field v-model="endereco" name="endereco" id="endereco" :counter="100"
                                  placeholder="Endereço Estacionamento"></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="6">
                    <v-autocomplete :items="estados" v-model="estado" label="Estado" @change="buscaCidades()" clear-icon="close"
                                    clearable item-text="nome" item-value="nome" return-object autocomplete="none"
                    >
                    </v-autocomplete>
                    <input type="hidden" name="estado" :value="computedEstate">
                </v-col>
                <v-col cols="6">
                    <v-autocomplete name="cidade" :items="cidades" v-model="cidade" label="Cidade" :disabled="semEstado"
                                    clearable clear-icon="close" item-text="nome" item-value="nome" autocomplete="none"
                    >
                    </v-autocomplete>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
    export default {
        props: ['estacionamento', 'administrador', 'usuarios', 'user'],
        name: "EstacionamentoForm",
        data: () => ({
            nome_estacionamento: null,
            cnpj: null,
            endereco: null,
            estado: null,
            cidade: null,
            fk_usuario: null,
            semEstado: true,
            estados: [],
            cidades: [],
            step: 1
        }),
        mounted() {
            this.$http.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados').then(response => {
                // get body data
                this.estados = response.body;
            }, response => {
                // error callback
                console.log(response)
            });

            this.$http.get('https://servicodados.ibge.gov.br/api/v1/localidades/municipios').then(response => {
                // get body data
                this.cidades = response.body;
            }, response => {
                // error callback
                console.log(response)
            });

            if (this.estacionamento) {
                this.nome_estacionamento = this.estacionamento.nome
                this.endereco = this.estacionamento.endereco
                this.estado = this.estacionamento.estado
                this.cidade = this.estacionamento.cidade
                this.cnpj = this.estacionamento.cnpj
                this.fk_usuario = parseInt(this.estacionamento.fk_usuario)
                this.semEstado = false
                console.log(this.fk_usuario)
            }
        },
        computed: {
            computedEstate () {
                if (this.estacionamento) return this.estacionamento.estado
                return (this.estado) ? this.estado.nome : ''
            }
        },
        methods: {
            buscaCidades() {
                this.$http.get('https://servicodados.ibge.gov.br/api/v1/localidades/estados/'+ this.estado.id + '/municipios').then(response => {
                    // get body data
                    this.cidades = response.body;
                    this.semEstado = false;
                }, response => {
                    // error callback
                    console.log(response)
                });
            },
        }
    }
</script>

<style scoped>

</style>
