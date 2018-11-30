<script>
export default{
  el: '#app',
  name: 'App',
  data: () => ({
    drawer: false,
    drawerRight: false,
    items: [
      {
        icon: 'keyboard_arrow_up',
        'icon-alt': 'keyboard_arrow_down',
        text: 'Tasques',
        model: true,
        children: [
          { icon: 'assignment', text: 'Tasques PHP', url: '/tasks' },
          { icon: 'assignment', text: 'Tasques Tailwind', url: '/tasks_vue' },
          { icon: 'assignment', text: 'Tasques', url: 'tasques' }
        ]
      },
      { icon: 'turned_in', text: 'Etiquetes', url: 'tags' },
      { icon: 'account_box', text: 'Sobre nosaltres', url: '/about' },
      { icon: 'date_range', text: 'Calendari', url: '/calendari' }
    ]
  }),
  props: {
    source: String
  },
  methods: {
    impersonate (user) {
      if (user) {
        window.location.href = '/impersonate/take/' + user
      }
    }
  }
}
</script>
