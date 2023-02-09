<template>
  <v-container class="centered-container">
    <v-row class="text-left">
      <v-col class="mb-4">
        <h1 class="display-2 font-weight-bold mb-3">Mobile Device Table</h1>
      </v-col>
    </v-row>
    <v-row>
      <v-card>
        <v-card-title>
          Mobile Table
          <v-spacer>
            <Dialog
              :dialogueStatus="addDialogueStatus"
              :registerDialogue="toggleAddDialog"
            ></Dialog>
          </v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          >
          </v-text-field>
          <v-data-table
            v-model:sort-by="sortBy"
            v-model:items-per-page="itemsPerPage"
            :search="search"
            :headers="headers"
            :items="filteredTableDataFields"
            class="elevation-1"
          >
            <template v-slot:item="{ item }">
              <tr>
                <td>{{ item.columns.brand }}</td>
                <td>{{ item.columns.model }}</td>
                <td>{{ item.columns.os }}</td>
                <td>{{ item.columns.release_date }}</td>
                <td>
                  <v-btn color="primary" @click="toggleEditDialogue"
                    >Edit
                  </v-btn>
                </td>

                <td>
                  <v-btn color="red" @click="deleteMobileRecord(item.raw.id)"
                    >Delete
                  </v-btn>
                </td>
              </tr>
            </template>
          </v-data-table>
        </v-card-title>
      </v-card>
    </v-row>
  </v-container>
</template>

<script>
import DeviceService from "../../api/resources/DeviceService";
import Dialog from "./MobileCreateDialogue.vue";
import { ref, onMounted, computed } from "vue";
export default {
  name: "MobileTable",
  components: {
    Dialog,
  },

  setup() {
    const mobileData = ref([]);
    const headers = [
      {
        title: "Brand",
        align: "start",

        key: "brand",
      },
      {
        title: "Model",
        algin: "end",
        key: "model",
      },
      {
        title: "OS",
        align: "end",

        key: "os",
      },
      {
        title: "Release Date",
        align: "end",
        key: "release_date",
      },
      {
        title: "Edit Record",
        align: "end",
      },
      {
        title: "Delete Record",
        align: "end",
      },
    ];
    const search = ref("");
    const sortBy = [{ key: "os", order: "asc" }];
    const itemsPerPage = 10;
    const loading = ref(true);

    onMounted(() => {
      DeviceService.index().then((response) => {
        console.log();
        mobileData.value = response;
        loading.value = false;
      });
    });

    const filteredTableDataFields = computed(() =>
      mobileData.value.map((mobile) => {
        return {
          id: mobile.id,
          model: mobile.model,
          os: mobile.os,
          brand: mobile.brand,
          release_date: mobile.release_date,
        };
      })
    );

    const dialogue = ref({
      addDialogue: false,
      editDialogue: false,
    });

    const toggleEditDialog = () =>
      (dialogue.value.editDialogue = !dialogue.value.editDialogue);
    const toggleAddDialog = () => {
      dialogue.value.addDialogue = !dialogue.value.addDialogue;
    };

    const addDialogueStatus = computed(() => dialogue.value.addDialogue);
    const editDialogueStatus = computed(() => dialogue.value.editDialogue);

    const deleteMobileRecord = (id) => {
      DeviceService.delete(id);
    };
    const createMobileRecord = (requestBody) => {
      DeviceService.post(requestBody);
    };
    const editMobileRecord = (id, model) => {
      DeviceService.put(model, id);
    };
    return {
      filteredTableDataFields,
      headers,
      loading,
      itemsPerPage,
      search,
      sortBy,
      createMobileRecord,
      editMobileRecord,
      deleteMobileRecord,
      toggleAddDialog,
      toggleEditDialog,
      addDialogueStatus,
      editDialogueStatus,
    };
  },
};
</script>

<style scoped>
.centered-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
</style>
