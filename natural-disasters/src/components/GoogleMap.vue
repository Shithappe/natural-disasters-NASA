<template>
  <div>
        <gmap-map 
          ref="mymap" 
          :center="startLocation" 
          :zoom="zoom" 
          style="width: 100%; height: 800px"
        >

          <gmap-info-window :position="infoPosition" :opened="infoOpened" @closeclick="infoOpened=false">
            {{infoContent}}
          </gmap-info-window>

      <gmap-marker 
        v-for="(item, key) in markers" 
        :key="key" 
        :position="getPosition(item)" 
        :clickable="true" 
        @click="toggleInfo(item, key)" 
      />

    </gmap-map>
  </div>
</template>
 
<script>
  import { mapGetters } from 'vuex';
export default {
  name: "GoogleMap",
      props: [
        'chosenMarker'
    ],
  data() {
    return {
      zoom: 3,
      locationMarkers: [
        { 
        lat: 39.7837304,
        lng: -100.4458825
      },
      ],
      locPlaces: [],
      existingPlace: null,

      startLocation: {
        lat: 20.0,
        lng: 12.0
    },
    infoPosition: null,
    infoContent: null,
    infoOpened: false,
    infoCurrentKey: null,
    };
  },
  computed: {
    ...mapGetters([
      'markers',
    ]),
  },

  watch: {
    chosenMarker: function(newMarker) {
      this.startLocation = newMarker;
      this.zoom = 10;
    }
  },
  created() {
    this.locateGeoLocation();
  },
 
  methods: {

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
      //  + `` + marker.date;

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
