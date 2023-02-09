<template>
  <v-app>
    <v-main>
      <MobileTable/>
    </v-main>
  </v-app>
</template>

<script>
import MobileTable from './components/MobileTable.vue'

export default {
  name: 'App',
  components: {
    MobileTable,
  },
}
</script>
