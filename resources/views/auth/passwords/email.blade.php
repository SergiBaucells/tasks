@extends('layouts.login')

@section('content')
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm4>
                <v-card class="elevation-12">
                    <v-toolbar color="primary" dark>
                        <v-toolbar-title>{{ __('Restablir la contrasenya') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn flat type="submit" href="/login">Enrere</v-btn>
                    </v-toolbar>
                    <v-card-text>
                        @if (session('status'))
                            <v-alert type="success" :value="true">
                                {{ session('status') }}
                            </v-alert>
                        @endif

                        <v-form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <v-text-field id="email" type="email"
                                          error-messages="{{ $errors->first('email') }}"
                                          class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                          name="email"
                                          value="{{ old('email') }}" placeholder="{{ __('Correu Electrònic') }}"
                                          required>
                            </v-text-field>

                            <v-btn type="submit" color="primary">
                                {{ __('Enviar enllaç per restablir contrasenya') }}
                            </v-btn>

                        </v-form>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
