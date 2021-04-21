@extends('layouts.app')

@section('content')
    <v-card flat>
        <v-card-title>
            <v-toolbar flat color="white">
                <v-spacer></v-spacer>
                <v-btn href="{{ route('estacionamentos.create') }}" dark class="mb-2" color="green"> <v-icon>library_add</v-icon> Adicionar</v-btn>
            </v-toolbar>
        </v-card-title>
        <v-card-text>
            <table-component :items="{{$estacionamentos}}" title="/estacionamentos/" table_header="Estacionamentos"
                             table_subheader="Veja e administre na tabela a seguir os seus condomínios que você gerencia" :headers="[
                {
                    text: 'Estacionamento', value: 'nome',
                    align: 'left',
                    sortable: true,
                },
                {
                    text: 'CNPJ', value: 'cnpj',
                    align: 'left',
                    sortable: true,
                },
                {
                    text: 'Cidade', value: 'cidade',
                    align: 'left',
                    sortable: true,
                },
                {
                    text: 'Estado', value: 'estado',
                    align: 'left',
                    sortable: true,
                },
                {
                    text: 'Responsável', value: 'name',
                    align: 'left',
                    sortable: true,
                },
                { text: 'Unidades', value: 'unidades', sortable: false, align: 'center' },
                { text: 'Ações', value: 'action', sortable: false, align: 'center' },
            ]" ></table-component>
        </v-card-text>
    </v-card>
@endsection

