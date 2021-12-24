<template>
  <div>

    <div id="map">
       <GoogleMap :events="events"/>
    </div>

    <br>

    <div class="main">
      <CategorySelect_PagesSelect/>
      <div class="table">
        <events-table :events="events"/>
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
  computed: {
    ...mapGetters([
      'events',
    ]),
  },
  methods:{
    ...mapActions({
      fetchEvents: 'getEvents',
    }),
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

/* .table::-webkit-scrollbar-track {
  background: rgba(255, 166, 0, 0.315);    
} */

.table::-webkit-scrollbar-thumb {
 background-color: rgba(56, 35, 35, 0.15);    /* color of the scroll thumb */
  }

#map{
  width: 100vw;
  height: 100vh;
}


body {
  font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
}
</style>