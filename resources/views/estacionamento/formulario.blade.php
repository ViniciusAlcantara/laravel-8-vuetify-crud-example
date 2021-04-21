@extends('layouts.app')
@section('content')
    <v-card style="background-color: white;" flat>

        @if(Request::is('*/edit'))
            {{ Form::model( $estacionamento, ['method' => 'PATCH',  'files' => true, 'route' => ['estacionamentos.update', $estacionamento->id], 'autocomplete' => 'off'] ) }}
            <input type="hidden" value="{{ $estacionamento->id }}" name="id">
        @else
            {{ Form::open(['route' => ['estacionamentos.store'],  'files' => true, 'autocomplete' => 'off']) }}
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
                                    Editar Estacionamento
                                </div>

                                <div class="subtitle-1 font-weight-light">
                                    Altere os dados do estacionamento abaixo e clique em salvar
                                </div>
                            </template>
                        @else
                            <template v-slot:heading>
                                <div class="display-2 font-weight-light">
                                    Novo Estacionamento
                                </div>

                                <div class="subtitle-1 font-weight-light">
                                    Preencha os dados abaixo para criar um novo estacionamento
                                </div>
                            </template>
                        @endif
                        <v-card-text>
                        @if(Request::is('*/edit'))
                            <form-estacionamento :estacionamento="{{$estacionamento}}" :usuarios="{{json_encode($usuarios)}}" :user="{{Auth::user()}}"></form-estacionamento>
                        @else
                            <form-estacionamento :usuarios="{{json_encode($usuarios)}}" :user="{{Auth::user()}}"></form-estacionamento>
                        @endif
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <a href="{{ route('estacionamentos.index') }}" class="btn btn-default">Voltar</a>
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

