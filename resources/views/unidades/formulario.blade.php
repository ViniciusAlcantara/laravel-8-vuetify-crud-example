@extends('layouts.app')
@section('content')
    <v-card style="background-color: white;" flat>

        @if(Request::is('*/edit'))
            {{ Form::model( $unidade, ['method' => 'PATCH',  'files' => true, 'route' => ['unidades.update', $unidade->id]] ) }}
            <input type="hidden" value="{{ $unidade->id }}" name="id">
        @else
            {{ Form::open(['url' => '/unidades',  'files' => true]) }}
        @endif

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
                            Cadastro de Unidades
                        </div>

                        <div class="subtitle-1 font-weight-light">
                            Preencha os dados abaixo para criar uma nova unidade para um dos seus estacionamentos
                        </div>
                    </template>
                    <v-card-text>
                    @if(Request::is('*/edit'))
                            <form-unidade :estacionamentos="{{$lista_estacionamentos}}" :unidade="{{$unidade}}" :user="{{ Auth::user() }}"></form-unidade>
                        @else
                            <form-unidade :estacionamentos="{{$lista_estacionamentos}}" :user="{{ Auth::user() }}"></form-unidade>
                    @endif
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <a href="{{ route('unidades.index') }}" class="btn btn-default">Voltar</a>
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

