@extends('layouts.app')
@section('content')
    <v-card style="background-color: white;" flat>

        @if(Request::is('*/edit'))
            {{ Form::model( $usuario, ['method' => 'PATCH',  'files' => true, 'route' => ['usuarios.update', $usuario->id], 'autocomplete' => 'off'] ) }}
            <input type="hidden" value="{{ $usuario->id }}" name="id">
        @else
            {{ Form::open(['route' => ['usuarios.store'],  'files' => true, 'autocomplete' => 'off']) }}
        @endif
        <v-row class="pa-5">
            <v-col
                cols="12"
            >
                <base-material-card
                    color="primary"
                    class="px-5 py-3"
                >
                    @if(Request::is('*/edit'))
                        <template v-slot:heading>
                            <div class="display-2 font-weight-light">
                                Editar Usuário
                            </div>

                            <div class="subtitle-1 font-weight-light">
                                Visualize e edite os dados abaixo
                            </div>
                        </template>
                    @else
                        <template v-slot:heading>
                            <div class="display-2 font-weight-light">
                                Novo Usuário
                            </div>

                            <div class="subtitle-1 font-weight-light">
                                Preencha os dados abaixo para criar um novo usuário
                            </div>
                        </template>
                    @endif

                    <v-card-text>
                        @if(Request::is('*/edit'))
                            <form-usuario :user="{{json_encode($usuario)}}" :atual="{{Auth::user()}}"></form-usuario>
                        @else
                            <form-usuario></form-usuario>
                        @endif
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        @if(!Request::is('*/edit'))
                            <a href="{{ url()->current() }}" class="btn btn-default">Limpar</a>
                        @endif
                        {{ Form::submit('Salvar', ['class' => 'btn btn-primary text-white']) }}
                    </v-card-actions>
                </base-material-card>
            </v-col>
        </v-row>
        {{ Form::close() }}
    </v-card>
@endsection

