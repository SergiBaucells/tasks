<template>
    <v-menu offset-y>
        <v-badge slot="activator" left overlap color="error" class="ml-2 mr-2 mt-2">
            <span slot="badge" v-text="this.count"></span>
            <v-btn icon color="white" :loading="loading" :disabled="loading">
                <v-icon color="primary">person</v-icon>
            </v-btn>
        </v-badge>
        <v-list>
           TODO
        </v-list>
    </v-menu>
</template>

<script>
export default {
  name: 'UsersOnlineWidget',
  data () {
    return {
      loading: false,
      users: [],
      count: 0
    }
  },
  mounted () {
    this.listen()
  },
  methods: {
    listen () {
      window.Echo.join(this.channel)
        .here((users) => { this.count = users.length })
        .joining(user => this.count++)
        .leaving(user => this.count--)
    }
  },
  props: {
    channel: {
      type: String,
      default: 'App.Counter'
    }
  },
  computed: {
    counter () {
      if (this.users) return this.users.length
      return 0
    }
  }
}
</script>
