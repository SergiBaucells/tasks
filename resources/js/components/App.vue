<script>
export default{
  el: '#app',
  name: 'App',
  data: () => ({
    drawer: null,
    items: [
      { icon: 'assignment', text: 'Tasques PHP' },
      { icon: 'assignment', text: 'Tasques Vue' },
      { icon: 'account_box', text: 'Sobre nosaltres' },
      { icon: 'date_range', text: 'Calendari' }
    ]
  }),
  props: {
    source: String
  }
}
</script>
