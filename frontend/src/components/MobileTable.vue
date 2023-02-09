<template>
  <v-container>
    <v-row class="text-center">
      <v-col class="mb-4">
        <h1 class="display-2 font-weight-bold mb-3">
          Mobile Device Table
        </h1>
      </v-col>
      <v-card>
        <v-card-title>
          Mobiles
          <v-spacer></v-spacer>
          <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
          ></v-text-field>
        </v-card-title>
      </v-card>
      <v-data-table
      v-model:sort-by="sortBy"
        v-model:items-per-page="itemsPerPage"
        :search="search"
        :headers="headers"
        :items="mobileData"
        item-value="brand"
        class="elevation-1"
  >
    <template v-slot:item="{item}">
      <td> {{ item.brand }}</td>
      <td> {{ item.model }}</td>
      <td> {{ item.os }}</td>
      <td> {{ item.release_date }}</td>
      <td>
        <v-btn color="blue" @click="handleEdit(item)">
          <v-icon icon="mdi-pencil" >
            <span>Edit</span>
          </v-icon>
        </v-btn>
      </td>
      <td>
          <v-btn color="red" @click="handleDelete">
            <v-icon icon="mdi-delete" >
              <span>Delete</span>
            </v-icon>
          </v-btn>
      </td>
    </template>
    </v-data-table></v-row>
  </v-container>
</template>

<script>
import DeviceService from '../../api/resources/DeviceService';
import { ref, onMounted } from 'vue';
export default {
  name: 'MobileTable',
  setup(){
    const mobileData = ref([]);
    const headers  =[
      {}
    ]
    const search = ref('');
    const sortBy = [{key: 'os', order:'asc'}]
    const itemsPerPage = 20;
    const loading = ref(true)

    onMounted(() => {
        DeviceService.index().then(response => {
          mobileData.value = response;
          loading.value = false;
        })
    })


    const deleteMobileRecord = () =>{}
    const createMobileRecord = () =>{ }
    const editMobileRecord = () => {}
    return {
      mobileData,
      headers,
      loading,
      itemsPerPage,
      search,
      sortBy,
      createMobileRecord,
      editMobileRecord,
      deleteMobileRecord
    }
  },

}
</script>
