<template>
  <div>
    <!-- <gmap-map
        :zoom="5"    
        :center="center"
        style="width:100%;  height: 600px;"
      >
      <gmap-marker
        :key="index"
        v-for="(m, index) in locationMarkers"
        :position="m.position"
        @click="center=m.position"
      ></gmap-marker>
    </gmap-map> -->
        <gmap-map 
          ref="mymap" 
          :center="startLocation" 
          :zoom="5" 
          style="width: 100%; height: 800px"
        >

          <gmap-info-window :options="infoOptions" :position="infoPosition" :opened="infoOpened" @closeclick="infoOpened=false">
            {{infoContent}}
          </gmap-info-window>

      <gmap-marker 
        v-for="(item, key) in tempcoordinates" 
        :key="key" 
        :position="getPosition(item)" 
        :clickable="true" 
        @click="toggleInfo(item, key)" 
      />

    </gmap-map>
  </div>
</template>
 
<script>
  import { mapActions, mapGetters } from 'vuex';
export default {

  name: "GoogleMap",
    //   props: {
    //     events: {
    //         type: Array,
    //         required: true
    //     }
    // },
  data() {
    return {
      myCoordinates: {},
      center: { 
        lat: 39.7837304,
        lng: -100.4458825
      },
      locationMarkers: [
        { 
        lat: 39.7837304,
        lng: -100.4458825
      },
      ],
      locPlaces: [],
      existingPlace: null,


      startLocation: {
        lat: 10.3157,
        lng: 123.8854
    },
    tempcoordinates: {
      // 0: {
      //   full_name: 'Erich  Kunze',
      //   lat: '10.31',
      //   lng: '123.89'
      // },
      // 1: {
      //   full_name: 'Delmer Olson',
      //   lat: '10.32',
      //   lng: '123.89'
      // }
    },
    infoPosition: null,
    infoContent: null,
    infoOpened: false,
    infoCurrentKey: null,
    infoOptions: {
      pixelOffset: {
        width: 0,
        height: -35
      }
    },
    };
  },
  computed: {
    ...mapGetters([
      'events',
    ]),
  },
  mounted() {

    console.log(this.events);

    // this.coordinates.forEach(function(item, i) {
    //   console.log(item.coordinates.split(','), i);
    //   // console.log(item.title);
    // });

    // this.tempcoordinates = this.myCoordinates;
    // // console.log(this.myCoordinates);


    this.locateGeoLocation();
  },
 
  methods: {
    ...mapActions({
      fetchEvents: 'getEvents',
    }),
    initMarker(loc) {
      this.existingPlace = loc;
    },
    addLocationMarker() {
      if (this.existingPlace) {
        const marker = {
          lat: this.existingPlace.geometry.location.lat(),
          lng: this.existingPlace.geometry.location.lng()
        };
        this.locationMarkers.push({ position: marker });
        this.locPlaces.push(this.existingPlace);
        this.center = marker;
        this.existingPlace = null;
      }
    },
    locateGeoLocation: function() {
      navigator.geolocation.getCurrentPosition(res => {
        this.center = {
          lat: res.coords.latitude,
          lng: res.coords.longitude
        };
      });
    },


       getPosition: function(marker) {
      return {
        lat: parseFloat(marker.lat),
        lng: parseFloat(marker.lng)
      }
    },
    toggleInfo: function(marker, key) {
      this.infoPosition = this.getPosition(marker);
      this.infoContent = marker.full_name;
      if (this.infoCurrentKey == key) {
        this.infoOpened = !this.infoOpened;
      } else {
        this.infoOpened = true;
        this.infoCurrentKey = key;
      }
    }
  }
};
</script>

<style scoped>
div{
  /* opacity: 50%; */
}
</style>