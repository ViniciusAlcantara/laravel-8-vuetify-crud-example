@extends('layouts.app')

@section('content')
    <v-card flat>
        <v-toolbar flat color="white">
            <v-spacer></v-spacer>
            <v-btn href="{{ route('usuarios.create') }}" dark class="mb-2" color="green"><v-icon>library_add</v-icon>Adicionar</v-btn>
        </v-toolbar>
        </v-card-title>

        <v-card-text>
            <table-component :items="{{$usuarios}}" title="/usuarios/" table_header="Usuários"
                             :escondeexcluir="{{true}}"
                             table_subheader="Visualize e administre os usuários cadastrados na plataforma"
                             :headers="[
                {
                  text: 'ID',
                  align: 'left',
                  sortable: true,
                  value: 'id',
                },
                {
                    text: 'Nome', value: 'name',
                    align: 'left',
                    sortable: true,
                },
                {
                    text: 'Email', value: 'email',
                    align: 'left',
                    sortable: true,
                },{
                    text: 'Perfil', value: 'perfil',
                    align: 'left',
                    sortable: true,
                },
                { text: 'Ações', value: 'action', sortable: false, align: 'center' },
            ]" ></table-component>
        </v-card-text>
    </v-card>
@endsection

