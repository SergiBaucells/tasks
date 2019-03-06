<template>
    <v-toolbar color="primary" dark fixed app clipped-right clipped-left>
        <v-toolbar-side-icon @click.stop="$emit('toggle-left')"></v-toolbar-side-icon>
        <v-toolbar-title>Menú</v-toolbar-title>
        <v-spacer></v-spacer>

        <notifications-widget></notifications-widget>

        <span class="mr-4 hidden-xs-only" v-role="'SuperAdmin'"><git-info></git-info></span>

        <v-avatar @click="$emit('toggle-right')" :title="user.name">
            <img v-if="user.online" style="border: lawngreen 2px solid; margin: 20px;" :src="'https://www.gravatar.com/avatar/'+ user.gravatar" alt="avatar">
            <img v-else style="border: red 2px solid; margin: 20px;" :src="'https://www.gravatar.com/avatar/' + user.gravatar" alt="avatar">
        </v-avatar>
        <v-form action="logout" method="POST">
            <v-btn type="submit" icon><v-icon>exit_to_app</v-icon></v-btn>
        </v-form>
    </v-toolbar>
</template>

<script>
import NotificationsWidget from './notifications/NotificationsWidget.vue'
import GitInfoComponent from './git/GitInfoComponent.vue'

export default {
  name: 'MainToolbar',
  components: {
    'notifications-widget': NotificationsWidget,
    'git-info': GitInfoComponent
  },
  created () {
    this.user = window.laravel_user
  }
}
</script>
