<template>
    <v-card flat>
        <v-progress-linear
            v-if="loading"
            indeterminate
            color="cyan"
        ></v-progress-linear>
        <v-row class="py-5">
            <v-col
                cols="12"
            >
                <base-material-card
                    color="primary"
                    class="px-5 py-3"
                >
                    <template v-slot:heading>
                        <div class="display-2 font-weight-light">
                            {{table_header}}
                        </div>

                        <div class="subtitle-1 font-weight-light">
                            {{table_subheader}}
                        </div>
                    </template>
                <v-card-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="Pesquise"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-card-title>
                <v-data-table
                    :show-select="showselect"
                    v-model="selected"
                    item-key="id"
                    :headers="headers"
                    :items="items"
                    :search="search"
                    :items-per-page="10"
                    :footer-props="{
                      'items-per-page-text': 'Itens por página:',
                      'items-per-page-all-text': 'Todos',
                    }"
                >
                    <template v-slot:top >
                        <div v-if="selected.length > 0">
                            <v-btn class="mx-2" dark large color="primary" @click="excluirmultiplas = true">
                                Excluir Unidades
                            </v-btn>
                        </div>
                    </template>
                    <template v-slot:item.unidades="{ item }">
                        <v-btn class="mr-2" fab dark small color="#f4511e" :href="'/estacionamentos/unidades/'+ item.id">
                            <v-icon>mdi-car-info</v-icon>
                        </v-btn>
                    </template>
                    <template v-slot:item.action="{ item }">
                        <v-row>
                            <v-col cols="6" v-if="!escondeeditar">
                                <v-btn fab
                                       dark
                                       small
                                       class="mr-2"
                                       color="primary"
                                       :href="title + item.id + '/edit'">
                                    <v-icon>edit</v-icon>
                                </v-btn>
                            </v-col>
                            <v-col cols="6" v-if="!escondeexcluir">
                                <v-btn
                                    fab
                                    dark
                                    small
                                    color="error"
                                    @click="deleteItem(item.id)"
                                >
                                    <v-icon>delete</v-icon>
                                </v-btn>
                            </v-col>
                        </v-row>
                    </template>

                    <template v-slot:no-data>
                        Nenhum registro encontrado!
                    </template>

                </v-data-table>
                <v-dialog
                    v-model="excluirmultiplas"
                    max-width="600"
                >
                    <v-card>
                        <v-card-title class="headline">Excluir Registros</v-card-title>
                        <v-card-text>
                            Tem certeza que deseja excluir todos os registros selecionados?
                            Essa ação é irreversível, uma vez que as informações forem excluídas, NÃO poderão mais ser recuperadas.
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="primary" outlined @click="excluirmultiplas = false">Não</v-btn>
                            <v-btn class="mx-2" dark color="primary" @click="excluirSelecionadas">Sim</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
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
            </base-material-card>
        </v-col>
        </v-row>
    </v-card>
</template>

<script>
    export default {
        props: ['items', 'headers', 'title', 'escondeeditar', 'table_header',
            'table_subheader', 'escondeexcluir', 'showselect'],
        name: "TableComponent",
        data: () => ({
            search: null,
            color: '',
            text: '',
            snackbar: false,
            loading: false,
            valid: true,
            unidades: [],
            selected: [],
            excluirmultiplas: false
        }),
        methods: {
            deleteItem: function(id){
                Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
                this.$http.delete(this.title+id).then(response => {
                    location.reload();
                });
            },
            excluirSelecionadas() {
                const ids = this.selected.map(e => {
                    return e.id
                })
                this.loading = true;
                const data = {
                    ids: ids
                }

                Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#csrf-token').getAttribute('content');
                this.$http.post('/excluir-unidades', data).then(response => {
                    if (response.body.success) {
                        this.snackbar = true;
                        this.text = 'Unidades excluídas com sucesso!';
                        this.color = 'success';
                        this.loading = false;
                        location.reload()
                    } else {
                        this.snackbar = true;
                        this.text = 'Erro ao excluir unidades!';
                        this.color = 'error';
                        this.loading = false;
                    }
                });
            }
        },

    }
</script>

<style scoped>

</style>
