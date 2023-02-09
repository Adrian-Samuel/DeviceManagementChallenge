<template>
  <v-container>
    <v-row class="text-center">
      <v-col class="mb-4">
        <h1 class="display-2 font-weight-bold mb-3">
          Mobile Device Table
        </h1>
      </v-col>
     
  
  <v-data-table
    v-model:items-per-page="itemsPerPage"
    :headers="headers"
    :items="desserts"
    item-value="name"
    class="elevation-1"
  ></v-data-table>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: 'MobileTable',

  data: () => ({
    
  }),
}
</script>
