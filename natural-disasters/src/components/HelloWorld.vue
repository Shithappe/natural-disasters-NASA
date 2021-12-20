<template>
<div>
<select @input="get_events" v-model="selected">
  <!-- <option disabled value="">Choose disasters</option> -->
  <option v-for="item in categories" v-bind:key="item.title">{{item.title}}</option>
</select>

<select @input="get_events" v-model="pages">
  <option>5</option>
  <option>10</option>
  <option>15</option>
</select>


 <table border="1">
   <caption>one night</caption>
   <tr>
    <th>Title</th>
    <th>Date</th>
    <th>Map</th>
   </tr>
   <tr v-for="item in events" v-bind:key="item.title">
     <td>{{item.title}}</td><td>{{item.date}}</td><td><a v-bind:href="item.coordinates">link to map</a></td>
    </tr>
  </table>


</div>
</template>

<script>
import axios from "axios";
export default {
  name: 'HelloWorld',
  data() {
    return {
      selected: 'Wildfires',
      categories: [],
      events: [],
      pages: 10
    };
  },
  methods:{
    get_events(){
      axios.post('http://127.0.0.1:8000/api/get_by_category', 
            {
              'category': this.selected,
            })
            .then((response) => {
                console.log(response);
                this.events = response.data;
            })
    }
  },
  mounted(){
    axios.get('http://127.0.0.1:8000/api/get_categories')
     .then((response) => { 
       console.log(response.data);
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