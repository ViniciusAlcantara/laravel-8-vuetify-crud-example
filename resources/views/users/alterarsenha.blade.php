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
                            Alterar Senha
                        </div>

                        <div class="subtitle-1 font-weight-light">
                            Preencha os dados abaixo para alterar a sua senha
                        </div>
                    </template>
                    <v-card-text>
                        <form-alterar-senha :user="{{ Auth::user()}}"></form-alterar-senha>
                    </v-card-text>
                </base-material-card>
            </v-col>
        </v-row>
        {{ Form::close() }}
    </v-card>
@endsection
