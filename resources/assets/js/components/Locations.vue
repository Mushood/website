<template>
    <gmap-map
        :center="center"
        :zoom="6"
        style="width: 100%; height: 600px"
    >
    <gmap-info-window :options="infoOptions" :position="infoWindowPos" :opened="infoWinOpen" @closeclick="infoWinOpen=false">
        <strong>{{info}}</strong>
    </gmap-info-window>
    <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        :clickable="true"
        :draggable="true"
        @click="toggleInfoWindow(m,index)"
    ></gmap-marker>
  </gmap-map>
</template>

<script>
    /////////////////////////////////////////
    // New in 0.4.0
    import * as VueGoogleMaps from 'vue2-google-maps';

    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyAnAPLCP61n4zn4qi7M_TY2GaDbMh40h6I',
        }
    });

    export default {
        mounted() {
            console.log('Map mounted.');

            for (var i = 0; i < this.markers.length; i++) {
              this.markers[i].position.lat = parseFloat(this.markers[i].position.lat) ;
              this.markers[i].position.lng = parseFloat(this.markers[i].position.lng) ;
            }

        },

        data () {
            return {
                center: {lat: 51.507366, lng: -0.127798},
                info: '',
                infoWindowPos: {
                    lat: 0,
                    lng: 0
                },
                infoWinOpen: false,
                currentMidx: null,
                //optional: offset infowindow so it visually sits nicely on top of our marker
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -45
                    }
                },
            }
        },

        props: {
            markers: {
                required: true
            },
        },

        methods: {
            toggleInfoWindow: function(marker, idx) {
                this.infoWindowPos = marker.position;
                this.info = marker.info;

                //check if its the same marker that was selected if yes toggle
                if (this.currentMidx == idx) {
                    this.infoWinOpen = !this.infoWinOpen;
                }
                //if different marker set infowindow to open and reset current marker index
                else {
                    this.infoWinOpen = true;
                    this.currentMidx = idx;
                }
            }
        }
    }
</script>

<style>

</style>
