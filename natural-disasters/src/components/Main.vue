<template>
  <div>

    <div id="map">
       <GoogleMap :chosenMarker="chosenMarker"/>
    </div>

    <br>

    <div class="main">
      <CategorySelect_PagesSelect/>
      <div class="table">
        <events-table :events="events" @eventClick="setMarker"/>
      </div>

      <!-- <Pagination/> -->
    </div>

  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import EventsTable from './EventsTable.vue';
import CategorySelect_PagesSelect from './CategorySelect_PagesSelect.vue';
// import Pagination from './Pagination.vue';

import GoogleMap from "./GoogleMap";

export default {
  name: 'Main',
  components: {
    EventsTable,
    CategorySelect_PagesSelect,
    // Pagination,
    GoogleMap
  },
  data() {
    return {
      chosenMarker: null
    }
  },
  computed: {
    ...mapGetters([
      'events',
      'markerById'
    ]),
  },
  methods:{
    ...mapActions({
      fetchEvents: 'getEvents',
    }),

    setMarker(id) {
      console.log(id);
      this.chosenMarker = this.markerById(id);
    }
  },
}
</script>

<style scoped>

.main{
  margin: 0;
  padding: 1rem;
  max-width: 400px; 
  position: absolute;
  right: 0;
  top: 0;
  height: 100vh;

  background:rgba(250, 250, 250);
}

.table{
  margin: 50px 0;
  overflow: auto;
  max-height: 650px;
}

.table::-webkit-scrollbar {
  width: 3px;      
}

.table::-webkit-scrollbar-thumb {
 background-color: rgba(56, 35, 35, 0.15); 
  }

#map{
  width: 100vw;
  height: 100vh;
}


body {
  font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
}
</style>