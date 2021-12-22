<template>
    <div>
        <button @click="fetchPrevPage">Prev page</button>
        <button @click="fetchNextPage">Next page</button>
        <br>
        <span>current page: {{this.currentPage}}</span>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
export default {
  computed: {
    ...mapGetters([
      'currentPage'
    ]),
  },
  methods:{
    ...mapActions({
      fetchEvents: 'getEvents',
      fetchNextPage: 'nextPage',
      fetchPrevPage: 'prevPage',
    }),
  },
  created(){
    this.fetchEvents();
  },
}
</script>