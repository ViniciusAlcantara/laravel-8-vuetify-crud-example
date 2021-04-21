<template>
    <div>
        <v-alert v-if="message" :type="type">
            {{message}}
            <ul>
                <li v-for="error in errors" :key="index">{{ error }}</li>
            </ul>
        </v-alert>
        <v-row pa-2>
            <v-col cols="6" class="pl-2">
                <v-autocomplete name="fk_estacionamento" :items="estacionamentos" v-model="estacionamento" label="Condomínios"
                                clearable clear-icon="close" item-text="nome_estacionamento" item-value="id"
                >
                </v-autocomplete>
            </v-col>
            <v-col cols="6">
                <v-file-input accept=".csv, .xls, .xlsx" clearable clear-icon="close" v-model="planilha" label="Arquivo Excel para importar unidades"></v-file-input>
            </v-col>
        </v-row>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn href="unidades" color="primary" outlined>Voltar</v-btn>
            <v-btn @click="saveImport" color="primary">Salvar</v-btn>
        </v-card-actions>
    </div>
</template>

<script>
    export default {
        props: ['estacionamentos'],
        name: "ImportUnidades",
        data: () => ({
            estacionamento: null,
            planilha: null,
            message: null,
            type: '',
            errors: []
        }),
        methods: {
            saveImport() {
                this.type = '';
                this.message = null;
                const formData = new FormData();
                formData.append("select_file", this.planilha);
                formData.append("fk_estacionamento", this.estacionamento);
                Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
                this.$http.post('/unidades-save-import', formData).then(response => {
                    if (response.body.success) {
                        this.type = 'success';
                        this.message = 'Unidades importadas com sucesso!';
                    } else {
                        this.type = 'error';
                        this.message = 'Erro ao importar unidades!';
                        if (response.body.errors.length > 0) {
                            this.errors = response.body.errors;
                        }
                    }
                }).catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>

<style scoped>

</style>
