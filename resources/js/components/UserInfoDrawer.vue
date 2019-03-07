<!--<template>-->
    <!--<v-navigation-drawer-->
            <!--v-model="drawer"-->
            <!--fixed-->
            <!--right-->
            <!--clipped-->
            <!--app-->
    <!--&gt;-->
        <!--<v-card>-->
            <!--<v-card-title class="primary white&#45;&#45;text"><h4>Perfil</h4></v-card-title>-->
            <!--<v-list-tile class="pb-2 pt-2">-->
                <!--<v-list-tile-avatar>-->
                    <!--<v-avatar title="{{Auth::user()->name}}({{(Auth::user()->email)}})">-->
                        <!--<img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar">-->
                    <!--</v-avatar>-->
                <!--</v-list-tile-avatar>-->
                <!--<v-list-tile-content>-->
                    <!--<v-list-tile-title>user.name</v-list-tile-title>-->
                    <!--<v-list-tile-title>user.email</v-list-tile-title>-->
                <!--</v-list-tile-content>-->
            <!--</v-list-tile>-->
            <!--<v-divider></v-divider>-->
            <!--<v-list-tile class="pb-2 pt-2">-->
                <!--<v-list-tile-content>-->
                    <!--<v-list-tile-title>Administrador? {{ user.admin ? 'Si' : 'No' }}</v-list-tile-title>-->
                <!--</v-list-tile-content>-->
            <!--</v-list-tile>-->
            <!--<v-divider></v-divider>-->
            <!--<v-list-tile class="pb-2 pt-2">-->
                <!--<v-list-tile-content>-->
                    <!--<v-list-tile-title>Rols</v-list-tile-title>-->
                    <!--<v-list-tile-sub-title>{{ implode(', ',Auth::user()->map()['roles']) }}</v-list-tile-sub-title>-->
                <!--</v-list-tile-content>-->
            <!--</v-list-tile>-->
            <!--<v-divider></v-divider>-->
            <!--<v-list-tile class="pb-2 pt-2">-->
                <!--<v-list-tile-content>-->
                    <!--<v-list-tile-title>Permisos</v-list-tile-title>-->
                    <!--<v-list-tile-sub-title>{{ implode(', ',Auth::user()->map()['permissions']) }}</v-list-tile-sub-title>-->
                <!--</v-list-tile-content>-->
            <!--</v-list-tile>-->
        <!--</v-card>-->
        <!--<v-card>-->
            <!--<v-card-title class="primary white&#45;&#45;text"><h4>Opcions administrador</h4></v-card-title>-->

            <!--<v-layout wrap>-->
                <!--@impersonating-->
                <!--<v-flex xs12 text-xs-center class="pb-2 pt-2">-->
                    <!--<v-avatar title="{{ Auth::user()->impersonatedBy()->name }} ( {{ Auth::user()->email }} )">-->
                        <!--<img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->impersonatedBy()->email) }}"-->
                             <!--alt="avatar">-->
                    <!--</v-avatar>-->
                <!--</v-flex>-->
                <!--@endImpersonating-->
                <!--<v-flex xs12 text-xs-center class="pb-2 pt-2">-->
                    <!--@canImpersonate-->
                    <!--<impersonate class="ml-1 mr-1" label="Entrar com..." url="/api/v1/regular_users"></impersonate>-->
                    <!--@endCanImpersonate-->
                    <!--@impersonating-->
                    <!--{{ Auth::user()->impersonatedBy()->name }} està suplantant a {{ Auth::user()->name }}-->
                    <!--<v-btn color="success" href="impersonate/leave">-->
                        <!--<v-icon class="mr-1" >exit_to_app</v-icon>-->
                        <!--Abandonar la suplantació-->
                    <!--</v-btn>-->
                    <!--@endImpersonating-->
                <!--</v-flex>-->
            <!--</v-layout>-->
        <!--</v-card>-->
        <!--<v-card>-->
            <!--<v-card-title class="primary white&#45;&#45;text"><h4>Colors del tema</h4></v-card-title>-->
            <!--<color></color>-->
        <!--</v-card>-->
    <!--</v-navigation-drawer>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
  <!--name: 'UserInfoDrawer',-->
  <!--props: {-->
    <!--drawer: {-->
      <!--type: Boolean,-->
      <!--required: true-->
    <!--}-->
  <!--},-->
  <!--created () {-->
    <!--this.user = window.user-->
  <!--}-->
<!--}-->
<!--</script>-->
