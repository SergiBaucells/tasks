<template>

    <v-flex class="text-xs-center">
        <img src="img/images/icons2/outline-bookmarks-24px.svg" width="100">
        <h4 class="mt-4 mb-2 font-weight-thin headline text-xs-center">No tens cap tasca! 😭</h4>
        <v-btn
                color="secondary"
                class="justify-content-center"
                @click="emitCTA"
        ><v-icon>add</v-icon>Nova Tasca</v-btn>
    </v-flex>

</template>

<script>
import EventBus from './../eventBus'
export default {
  name: 'NoDataCTAComponent',
  props: ['img', 'btnText', 'mainText'],
  methods: {
    emitCTA () {
      EventBus.$emit('cta')
    }
  }
}
</script>
