@extends('layouts.landing')

@section('title')
    Benvinguts
@endsection

@section('content')
    <v-app light v-cloak style="background: #F0F4F8;background: -webkit-linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);
            background: linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);">
        <share-fab></share-fab>
        <service-worker></service-worker>
        <v-toolbar>
            <v-toolbar-title>App de Tasques Catalanes</v-toolbar-title>
            <v-spacer></v-spacer>
            @if (Route::has('login'))
                @auth
                    <v-btn dark color="primary darken-3" href="{{ url('/home') }}">Accedeix</v-btn>
                @else
                    <v-btn dark color="primary darken-3" href="/login">Login</v-btn>
                    <v-btn dark color="primary darken-3" href="/register">Registrar</v-btn>
                @endauth
            @endif
        </v-toolbar>
        <v-content>
            <section>
                <v-parallax-webp alt="Portada" src="/images/portada.webp" height="600" alt-format="jpg">
                    <v-layout
                            column
                            align-center
                            justify-center
                            class="white--text"
                    >
                        <img-webp src="/images/catalunya.webp" alt="Vuetify.js" height="200" alt-format="png"></img-webp>
                        <h1 style="
                        font-family: 'Montserrat', sans-serif;
                        font-size: 30px;
                        text-shadow: rgba(0,0,0,40) 0 0 50px;"
                            class="white--text mb-2 text-xs-center">
                            App de Tasques Catalanes
                        </h1>
                        <div class="subheading mb-3 text-xs-center">Sergi Baucells Rodríguez</div>
                        <v-layout>
                            <v-btn
                                    class="mt-5"
                                    dark
                                    large
                                    href="/home"
                                    color="primary darken-3"
                            >
                                Accedeix
                            </v-btn>
                            <v-btn
                                    class="mt-5"
                                    dark
                                    large
                                    href="https://github.com/SergiBaucells/tasks"
                                    target="_blank"
                                    rel="noopener"
                                    color="primary darken-3"
                            >
                                GitHub
                            </v-btn>
                        </v-layout>
                    </v-layout>
                </v-parallax-webp>
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
                                            <v-icon x-large class="primary--text">color_lens</v-icon>
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
                                            <v-icon x-large class="success--text">flash_on</v-icon>
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
                                            <v-icon x-large class="primary--text">build</v-icon>
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
                <v-parallax-webp alt="Portada2" src="/images/portada2.webp" height="380" alt-format="jpg">
                    <v-layout column align-center justify-center>
                        <h1 style="
                        font-family: 'Montserrat', sans-serif;
                        font-size: 30px;
                        text-shadow: rgba(0,0,0,40) 0 0 50px;"
                            class="white--text mb-2 text-xs-center">
                            El desenvolupament web mai ha estat tan fàcil
                        </h1>
                        <div style="text-shadow: rgba(0,0,0,40) 0 0 50px;" class="subheading mb-3 text-xs-center">
                            Accediu a la aplicació!
                        </div>
                        <v-btn
                                class="mt-5"
                                dark
                                large
                                href="/home"
                                color="primary darken-3"
                        >
                            Accedeix
                        </v-btn>
                    </v-layout>
                </v-parallax-webp>
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
                                            <v-icon class="primary--text">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>+34 645898261</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="success--text">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Catalunya, CAT</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="primary--text">email</v-icon>
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

            <footer class="footer-distributed">

                <div class="footer-left">

                    <h3>Aplicació de <span>Tasques</span></h3>

                    <p class="footer-links">
                        <a href="/">Home</a>
                        ·
                        <a href="/tasques">Tasques</a>
                        ·
                        <a href="/tasks">Tasques PHP</a>
                        ·
                        <a href="/tasks_vue">Tasques Tailwind</a>
                        ·
                        <a href="/tags">Etiquetes</a>
                        ·
                        <a href="/about">Sobre Nosaltres</a>
                    </p>

                    <p class="footer-company-name">IES del Ebre Sergi Baucells Rodríguez &copy; 2019</p>
                </div>

                <div class="footer-center">

                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p><span>Av. de Cristòfol Colom, 34-42, 43500</span> Tortosa, Catalunya</p>
                    </div>

                    <div>
                        <i class="fa fa-phone"></i>
                        <p>+32 645898261</p>
                    </div>

                    <div>
                        <i class="fa fa-envelope"></i>
                        <p><a href="mailto:sergibaucells@iesebre.com">sergibaucells@iesebre.com</a></p>
                    </div>

                </div>

                <div class="footer-right">

                    <p class="footer-company-about">
                        <span>Sobre l'empresa</span>
                        Estudiants de DAM del Intitut IES del Ebre.
                    </p>

                    <div class="footer-icons">

                        <a target="_blank" rel="noopener" href="https://www.facebook.com/Baucells">
                            <img alt="facebook" src="/img/icons_welcome_page/facebook-logo.svg">
                        </a>
                        <a target="_blank" rel="noopener" href="https://twitter.com/94xixa">
                            <img alt="twitter" src="/img/icons_welcome_page/logo-de-twitter.svg">
                        </a>
                        <a target="_blank" rel="noopener" href="https://github.com/SergiBaucells">
                            <img alt="github" src="/img/icons_welcome_page/github-signo.svg">
                        </a>

                    </div>

                </div>

            </footer>
        </v-content>
    </v-app>
@endsection