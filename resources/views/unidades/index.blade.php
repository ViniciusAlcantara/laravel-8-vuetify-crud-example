@extends('layouts.app')

@section('content')
    <v-card>
        <v-card-title>
            <v-toolbar flat color="white">
                <v-spacer></v-spacer>
                <v-btn href="{{ route('unidades.create') }}" dark class="mb-2" color="green"> <v-icon>library_add</v-icon> Adicionar</v-btn>
            </v-toolbar>
        </v-card-title>


        <v-card-text>
            <table-component :items="{{$unidades}}" title="/unidades/" table_header="Unidades" :showselect="true"
                             table_subheader="Veja e administre abaixo as unidades presentes nos condomínios que você gerencia" :headers="[

                {
                    text: 'Número Unidade', value: 'numero',
                    align: 'left',
                    sortable: true,
                },{
                    text: 'Descrição', value: 'descricao',
                    align: 'left',
                    sortable: true,
                },
                {
                    text: 'Área da Vaga', value: 'area',
                    align: 'left',
                    sortable: true,
                },
                {
                    text: 'Estacionamento', value: 'nome',
                    align: 'left',
                    sortable: true,
                },
                { text: 'Ações', value: 'action', sortable: false },
            ]" ></table-component>
        </v-card-text>
    </v-card>
@endsection

