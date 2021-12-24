<template>
<table>
  <tr>
    <!-- <th>Title</th> -->
    <!-- <th>Date</th> -->
    <!-- <th>Map</th> -->
  </tr>
  <tbody>
  <tr v-for="item in events" :key="item.id">
    
    <td>
      {{item.title}}
      <br>
      <span>{{item.date}}</span>
    </td>

    <!-- <td>{{item.title}}</td>
    <td>{{item.date}}</td> -->
    <!-- <td>
      <a :href="'https://www.google.com/maps/search/?api=1&query=' + item.coordinates" target="_blank">{{item.coordinates}}</a>
    </td> -->
  </tr>
    </tbody>
</table>
</template>

<script>
export default {
    name: "EventsTable",
    props: {
        events: {
            type: Array,
            required: true
        }
    }
}
</script>

<style scoped>
td {
  transition: all 0.5s ease-out;
  border: 1px solid #ccc;
  border-width: 1px 0;
}

table{ 
    border: none;
    font-family: 'Open Sans', 'Helvetica Neue', 'Segoe UI', 'Calibri', 'Arial', sans-serif;
    border-spacing: 1; 
    border-collapse: collapse; 
    border-radius: 10px;
    overflow: hidden;
}

td{
    padding: 5px 10px;
}

td:hover{
  box-shadow: 0px 5px 10px 2px rgba(34, 60, 80, 0.2);
  background:rgba(255, 255, 255);
}

span{
  font-size: 12px;
  opacity: 75%;
}



  
</style>