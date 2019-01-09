@extends('layouts.landing')

@section('title')
    Benvinguts
@endsection

@section('content')
    <v-app light>
        <v-toolbar>
            <v-toolbar-title>App de Tasques Catalanes</v-toolbar-title>
            <v-spacer></v-spacer>
            @if (Route::has('login'))
                @auth
                    <v-btn dark color="primary" href="{{ url('/home') }}">Accedeix</v-btn>
                @else
                    <v-btn dark color="primary" href="/login">Login</v-btn>
                    <v-btn dark color="primary" href="/register">Registrar</v-btn>
                @endauth
            @endif
        </v-toolbar>
        <v-content>
            <section>
                <v-parallax src="img/portada.jpg" height="600">
                    <v-layout
                            column
                            align-center
                            justify-center
                            class="white--text"
                    >
                        <img src="img/catalunya.png" alt="Vuetify.js" height="200">
                        <h1 class="white--text mb-2 display-1 text-xs-center">App de Tasques Catalanes</h1>
                        <div class="subheading mb-3 text-xs-center">Sergi Baucells Rodríguez</div>
                        <v-layout>
                            <v-btn
                                    class="blue lighten-2 mt-5"
                                    dark
                                    large
                                    href="/home"
                                    color="primary"
                            >
                                Accedeix
                            </v-btn>
                            <v-btn
                                    class="blue lighten-2 mt-5"
                                    dark
                                    large
                                    href="https://github.com/SergiBaucells/tasks"
                                    target="_blank"
                                    color="primary"
                            >
                                GitHub
                            </v-btn>
                        </v-layout>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-layout
                        column
                        wrap
                        class="my-5"
                        align-center
                >
                    <v-flex xs12 sm4 class="my-3">
                        <div class="text-xs-center">
                            <h2 class="headline">La millor manera de començar a desenvolupar</h2>
                        </div>
                    </v-flex>
                    <v-flex xs12>
                        <v-container grid-list-xl>
                            <v-layout row wrap align-center>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="yellow--text">color_lens</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Material Design</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Aprèn a personalitzar el disseny per canviar l'aparença de la
                                            interfície d'usuari, expressant la marca i l'estil a través d'elements com
                                            el color, la forma, la tipografia i la iconografia.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="red--text">flash_on</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline">Fast development</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Aprèn a desenvolupar d'una forma ràpida i eficient!.</br></br>
                                            Teballar amb "Responsive" i optimitzar la app d'una manera inmillorable!
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="yellow--text">build</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Completely Open Sourced</div>
                                        </v-card-title>
                                        <v-card-text>
                                            És un model de desenvolupament de programari basat en la
                                            col·laboració oberta.</br>
                                            És basa més en els beneficis pràctics que en qüestions ètiques.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section>
                <v-parallax src="img/portada2.jpg" height="380">
                    <v-layout column align-center justify-center>
                        <div class="headline white--text mb-3 text-xs-center">El desenvolupament web mai no ha estat tan
                            fàcil
                        </div>
                        <em>Accediu a la aplicació!</em>
                        <v-btn
                                class="blue lighten-2 mt-5"
                                dark
                                large
                                href="/home"
                                color="primary"
                        >
                            Accedeix
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Contacta</div>
                                </v-card-title>
                                <v-card-text>
                                    Si vols contactar amb el responsable, fes-ho via telèfon o email.
                                </v-card-text>
                                <v-list class="transparent">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="yellow--text">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>+34 645898261</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="red--text">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Catalunya, CAT</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="yellow--text">email</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>sergibaucells@iesebre.com</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>

            <v-footer color="primary">
                <span class="white--text pl-2">Created by Sergi Baucells Rodríguez, &copy; 2018 All rights reserved</span>
            </v-footer>
        </v-content>
    </v-app>
@endsection