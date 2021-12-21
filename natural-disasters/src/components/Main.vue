<template>
<div>
<select v-model='selected' @change="get_events">
  <option v-for="category in categories" v-bind:key="category.id" :value="category.title">{{category.title}}</option>
</select>

<select @change="get_events" v-model="pages">
  <option>5</option>
  <option>10</option>
  <option>20</option>
</select>

 <table border="1">
   <!-- <caption>one night</caption> -->

   <tr>
    <th>Title</th>
    <th>Date</th>
    <th>Map</th>
   </tr>
   <tr v-for="item in events" v-bind:key="item.id">
     <td>{{item.title}}</td><td>{{item.date}}</td><td><a v-bind:href="'https://www.google.com/maps/search/?api=1&query=' + item.coordinates">{{item.coordinates}}</a></td>
    </tr>
  </table>

  <div>
    <button @click="get_prevPage">Prev page</button>
    <button @click="get_nextPage">Next page</button>
    <br>
    <span>current page: {{this.currentPage}}</span>
  </div>


</div>
</template>

<script>
import axios from "axios";
export default {
  name: 'Main',
  data() {
    return {
      selected: 'Wildfires',
      categories: [],
      events: [],
      pages: 10,
      nextPage: '',
      prevPage: '',
      currentPage: 1,
      colPages: 0
    };
  },
  methods:{
    get_events(){
      axios.get('http://127.0.0.1:8000/api/get_by_category?category=' + this.selected + '&pages=' + this.pages + '&page=' + this.currentPage,
            )
            .then((response) => {
                this.events = response.data.data;
                this.nextPage = response.data.next_page_url.split('=')[1];
                this.prevPage = response.data.prev_page_url.split('=')[1];
                this.currentPage = response.data.current_page;
                console.log(this.nextPage);
            })
    },
    get_nextPage(){
      this.currentPage = this.nextPage;
      this.get_events();
    },
    get_prevPage(){
      this.currentPage = this.prevPage;
      this.get_events();
    },

  },
  mounted(){
    axios.get('http://127.0.0.1:8000/api/get_categories')
     .then((response) => { 
       this.categories = response.data;
      });
    this.get_events();
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