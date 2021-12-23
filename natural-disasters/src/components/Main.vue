<template>
<div>

<CategorySelect_PagesSelect/>

<events-table :events="events"/>

<Pagination/>

</div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import EventsTable from './EventsTable.vue';
import CategorySelect_PagesSelect from './CategorySelect_PagesSelect.vue';
import Pagination from './Pagination.vue';

export default {
  name: 'Main',
  components: {
    EventsTable,
    CategorySelect_PagesSelect,
    Pagination
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
body {
  font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
}

#app {
  max-width: 30em;
  margin: 1em auto;
}
</style>