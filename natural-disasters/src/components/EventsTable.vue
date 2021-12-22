<template>
<table>
  <tr>
    <th>Title</th>
    <th>Date</th>
    <th>Map</th>
  </tr>
  <tr v-for="item in events" :key="item.id">
    <td>{{item.title}}</td>
    <td>{{item.date}}</td>
    <td>
      <a :href="'https://www.google.com/maps/search/?api=1&query=' + item.coordinates" target="_blank">{{item.coordinates}}</a>
    </td>
  </tr>
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
table, table td, table th {
  border: 1px solid black;
  /* border-collapse: collapse; */
  padding: 1rem;
}

table{ 
  border-spacing: 1; 
  border-collapse: collapse; 
  background:rgba(233, 233, 233, 0.61);
  border-radius:6px;
  overflow:hidden;
  max-width:800px; 
  width:100%;
  margin:0 auto;
}

td{
    background:rgba(196, 196, 196, 0.61);
}
  
  
  td,th           { padding-left:8px}

  thead tr        { 
    height:60px;
    background:#FFED86;
    font-size:16px;
  }
  
  tbody tr        { height:48px; border-bottom:1px solid #E3F1D5 ;}
</style>