<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">
    <meta name="theme-color" content="#F7C948"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="#F7C948">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Tasques Sergi Baucells">
    <link rel="apple-touch-startup-image" href="img/images/icons2/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="57x57" href="img/images/icons2/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/images/icons2/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/images/icons2/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/images/icons2/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/images/icons2/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/images/icons2/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/images/icons2/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/images/icons2/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/images/icons2/apple-touch-icon-180x180.png">
    <link rel="manifest" href="/manifest.json">
    <link rel="apple-touch-icon" href="img/images/icons2/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/images/icons2/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/images/icons2/favicon-16x16.png">
    <link rel="mask-icon" href="img/images/icons2/safari-pinned-tab.svg" color="#d0c300">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="msapplication-TileImage" content="img/images/icons2/mstile-144x144.png">
    <!-- Carta compartida -->
    <meta property="og:image" content="/img/catalunya.png">
    <meta property="og:image:width" content="1190">
    <meta property="og:image:height" content="623">
    <meta property="og:description" content="Aplicaci&oacute; de tasques catalanes">
    <meta property="og:title" content="Tasques - Sergi Baucells Rordiguez">
    <meta property="og:url" content="https://tasks.sergibaucells.scool.cat">
    <meta property="og:type" content="website">
    <title>@yield('title')</title>
    <style>
        [v-cloak] { display: none }
    </style>
</head>
<body>
<v-app id="app" v-cloak style="background: #F0F4F8;background: -webkit-linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);
            background: linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);">
    <snackbar></snackbar>
    <service-worker></service-worker>
    <navigation v-model="drawer"></navigation>
    <v-navigation-drawer
            v-model="drawerRight"
            fixed
            right
            clipped
            app
    >
        <v-card>
            <v-card-title class="primary white--text"><h4>Perfil</h4></v-card-title>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-avatar>
                    <v-avatar title="{{Auth::user()->name}}({{(Auth::user()->email)}})">
                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">
                    </v-avatar>
                </v-list-tile-avatar>
                <v-list-tile-content>
                    <v-list-tile-title>{{ Auth::user()->name }}</v-list-tile-title>
                    <v-list-tile-title>{{ Auth::user()->email }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-content>
                    <v-list-tile-title>Administrador? {{ Auth::user()->admin ? 'Si' : 'No' }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-content>
                    <v-list-tile-title>Rols</v-list-tile-title>
                    <v-list-tile-sub-title>{{ implode(', ',Auth::user()->map()['roles']) }}</v-list-tile-sub-title>
                </v-list-tile-content>
            </v-list-tile>
            <v-divider></v-divider>
            <v-list-tile class="pb-2 pt-2">
                <v-list-tile-content>
                    <v-list-tile-title>Permisos</v-list-tile-title>
                    <v-list-tile-sub-title>{{ implode(', ',Auth::user()->map()['permissions']) }}</v-list-tile-sub-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-card>
        <v-card>
            <v-card-title class="primary white--text"><h4>Opcions administrador</h4></v-card-title>

            <v-layout row wrap>
                @impersonating
                <v-flex xs12 text-xs-center class="pb-2 pt-2">
                    <v-avatar title="{{ Auth::user()->impersonatedBy()->name }} ( {{ Auth::user()->email }} )">
                        <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->impersonatedBy()->email) }}"
                             alt="avatar">
                    </v-avatar>
                </v-flex>
                @endImpersonating
                <v-flex xs12 text-xs-center class="pb-2 pt-2">
                    @canImpersonate
                    <impersonate class="ml-1 mr-1" label="Entrar com..." url="/api/v1/regular_users"></impersonate>
                    @endCanImpersonate
                    @impersonating
                    {{ Auth::user()->impersonatedBy()->name }} està suplantant a {{ Auth::user()->name }}
                    <v-btn color="success" href="impersonate/leave">
                        <v-icon class="mr-1" >exit_to_app</v-icon>
                        Abandonar la suplantació
                    </v-btn>
                    @endImpersonating
                </v-flex>
            </v-layout>
        </v-card>
        <v-card>
            <v-card-title class="primary white--text"><h4>Colors del tema</h4></v-card-title>
            <color></color>
        </v-card>
    </v-navigation-drawer>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>Menú</v-toolbar-title>
        <v-spacer></v-spacer>

        <notifications-widget></notifications-widget>

        <span class="mr-4 hidden-xs-only" v-role="'SuperAdmin'"><git-info></git-info></span>

        <v-avatar @click.stop="drawerRight = !drawerRight" title="{{Auth::user()->name}}({{(Auth::user()->email)}})">
            <img v-if="{{ Auth::user()->online }}" style="border: lawngreen 2px solid; margin: 20px;" src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">
            <img v-else style="border: red 2px solid; margin: 20px;" src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">
        </v-avatar>
        <v-form action="logout" method="POST">
            @csrf
            <v-btn type="submit" icon><v-icon>exit_to_app</v-icon></v-btn>
        </v-form>
    </v-toolbar>
    <v-content>
        <v-container fluid fill-height>
            <v-layout>
                <v-flex>
                    @yield('content')
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    <v-footer color="primary" app>
        <span class="white--text pl-2">Created by Sergi Baucells Rodríguez, &copy; 2018 All rights reserved</span>
    </v-footer>
</v-app>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>