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
      'selectedCategory',
      'categories',
      'events',
      'pages',
      'currentPage'
    ]),
  },
  methods:{
    ...mapActions({
      fetchEvents: 'getEvents',
      fetchNextPage: 'nextPage',
      fetchPrevPage: 'prevPage',
      fetchCategories: 'fetchCategories'
    }),
  },
  created(){
    this.fetchCategories();
    this.fetchEvents();
  },
}
</script>

<style scoped>
body {
  font-family: 'Source Sans Pro', 'Helvetica Neue', Arial, sans-serif;
  text-rendering: optimizelegibility;
  -moz-osx-font-smoothing: grayscale;
  -moz-text-size-adjust: none;
}

h1,.muted {
  color: #2c3e5099;
}

h1 {
  font-size: 26px;
  font-weight: 600;
}

#app {
  max-width: 30em;
  margin: 1em auto;
}
</style>