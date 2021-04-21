@extends('layouts.app')
@section('content')
    <v-card style="background-color: white;" flat>
        <v-row class="pa-5">
            <v-col
                cols="12"
            >
                <base-material-card
                    color="primary"
                    class="px-5 py-3"
                >
                    <template v-slot:heading>
                        <div class="display-2 font-weight-light">
                            Importar Unidades
                        </div>

                        <div class="subtitle-1 font-weight-light">
                            Escolha um condomínio e faça o upload de um arquivo .csv, .xls ou .xlsx para cadastrar múltiplas unidades de um única vez
                        </div>
                    </template>
                    <v-card-text>
                        <!-- Adicionar aqui select para escolher o condomínio para o qual as unidades serão importadas  -->
                        <import-unidades :estacionamentos="{{json_encode($lista_estacionamentos)}}"></import-unidades>
                    </v-card-text>

                        <v-card-title>Exemplo de como os dados devem ser preenchidos antes de serem importados acima:</v-card-title>
                        <v-simple-table>
                            <template v-slot:default>
                                <thead>
                                <tr>
                                    <th class="text-left">Morador</th>
                                    <th class="text-left">Email Morador</th>
                                    <th class="text-left">Fração ideal</th>
                                    <th class="text-left">Número Unidade</th>
                                    <th class="text-left">Adimplente</th>
                                    <th class="text-left">Código de Área</th>
                                    <th class="text-left">WhatsApp</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Morador 1</td>
                                    <td>morador1@teste.com</td>
                                    <td>2</td>
                                    <td>23</td>
                                    <td>Sim</td>
                                    <td>61</td>
                                    <td>998055657</td>
                                </tr>
                                <tr>
                                    <td>Morador 2</td>
                                    <td>morador2@teste.com</td>
                                    <td>4</td>
                                    <td>12</td>
                                    <td>Não</td>
                                    <td>61</td>
                                    <td>998055657</td>
                                </tr>
                                <tr>
                                    <td>Morador 3</td>
                                    <td>morador3@teste.com</td>
                                    <td>7</td>
                                    <td>42</td>
                                    <td>Sim</td>
                                    <td>61</td>
                                    <td>998055657</td>
                                </tr>
                                </tbody>
                            </template>
                        </v-simple-table>
                    </v-card-text>
                    <input type="hidden" value="{{ Auth::user()->id }}" name="fk_usuario">
                    <v-card-actions>

                    </v-card-actions>
                </base-material-card>
            </v-col>
        </v-row>
        {{ Form::close() }}
    </v-card>
@endsection

