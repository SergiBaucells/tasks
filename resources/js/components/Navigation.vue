<template>
    <v-navigation-drawer
            v-model="dataDrawer"
            fixed
            app
            clipped
    >
        <v-list dense>
            <template v-for="item in items">
                <v-layout
                        v-if="item.heading"
                        :key="item.heading"
                        row
                        align-center
                >
                    <v-flex xs6>
                        <v-subheader v-if="item.heading">
                            {{ item.heading }}
                        </v-subheader>
                    </v-flex>
                    <v-flex xs6 class="text-xs-center">
                        <a href="#!" class="body-2 black--text">EDIT</a>
                    </v-flex>
                </v-layout>
                <v-list-group
                        v-else-if="item.children"
                        v-model="item.model"
                        :key="item.text"
                        :prepend-icon="item.model ? item.icon : item['icon-alt']"
                        append-icon=""
                >
                    <v-list-tile slot="activator" :href="item.url">
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                    <v-list-tile
                            v-for="(child, i) in item.children"
                            :key="i"
                            :href="child.url"
                            :style="isSelected(child)"
                    >
                        <v-list-tile-action v-if="child.icon">
                            <v-icon>{{ child.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                {{ child.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list-group>
                <v-list-tile v-else :key="item.text" :href="item.url" :style="isSelected(item)">
                    <v-list-tile-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ item.text }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
  name: 'Navigation',
  data () {
    return {
      dataDrawer: this.drawer,
      items: [
        { icon: 'account_balance', text: 'Welcome', url: '/' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasques',
          model: true,
          children: [
            { icon: 'assignment', text: 'Tasques PHP', url: '/tasks' },
            { icon: 'assignment', text: 'Tasques Tailwind', url: '/tasks_vue' },
            { icon: 'assignment', text: 'Tasques', url: '/tasques' }
          ]
        },
        { icon: 'turned_in', text: 'Etiquetes', url: '/tags' },
        { icon: 'account_box', text: 'Sobre nosaltres', url: '/about' },
        { icon: 'date_range', text: 'Calendari', url: '/calendari' },
        { icon: 'person', text: 'Perfil', url: '/profile' },
        { icon: 'update', text: 'ChangeLog', url: '/changelog' },
        { icon: 'notifications', text: 'Notificacions', url: '/notifications' },
        { icon: 'stay_primary_portrait', text: 'Mobile', url: '/mobile' },
        { icon: 'contact_mail', text: 'NewsLetters', url: '/newsletters' },
        { icon: 'av_timer', text: 'Rellotge', url: '/clock' }

      ]
    }
  },
  props: {
    drawer: {
      Type: Boolean,
      default: false
    }
  },
  watch: {
    dataDrawer (drawer) {
      this.$emit('input', drawer)
    },
    drawer (drawer) {
      this.dataDrawer = drawer
    }
  },
  model: {
    prop: 'drawer',
    event: 'input'
  },
  methods: {
    isSelected (item) {
      const currentPath = window.location.pathname
      if (item.url === currentPath) {
        return {
          'border-left': '5px solid #F0B429',
          'background-color': '#F0F4F8',
          'font-size': '1em'
        }
      }
    }
  }
}
</script>
