<script>
export default {
  el: '#app',
  name: 'App',
  data: () => ({
    drawer: false,
    drawerRight: false,
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
          { icon: 'assignment', text: 'Tasques', url: 'tasques' }
        ]
      },
      { icon: 'turned_in', text: 'Etiquetes', url: 'tags' },
      { icon: 'account_box', text: 'Sobre nosaltres', url: '/about' },
      { icon: 'date_range', text: 'Calendari', url: '/calendari' },
      { icon: 'person', text: 'Perfil', url: '/profile' },
      { icon: 'update', text: 'ChangeLog', url: '/changelog' }
    ]
  }),
  props: {
    source: String
  }
}
</script>
