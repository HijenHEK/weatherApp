<template>
    <div class="weather-container pt-5" :style="background">
            <input type="search" id="address-input" placeholder="Where are we going?" />
            <div id="address-value"></div>
            <div class="weather-card">
                
                <div class="header">
                    <div class="status">
                        <div class="temp">
                            {{weather.temp}} °C <small>  at {{ weather.obs }} </small>
                        </div>
                        
                        <div class="desc">
                            <div v-for="desc in weather.desc" :key="desc.index">
                                {{desc}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="data">
                    <div class="city">
                            {{location.city}} , {{location.country}}
                    </div>
                    <div class="date">
                        {{location.date | moment("ddd , MMM Do") }}
                    </div>
                    </div>
                    
                </div>
                <div class="body">
                    <div class="forecast">
                        <div class="day">
                            Thu
                        </div>
                        <div class="status">
                            <span class="temp">
                                20°C
                            </span>
                            <span class="desc">
                                Rainy
                            </span>
                        </div>
                        <div class="icon">icon</div>
                    </div>
                                       
                </div>
            </div>
    </div>
</template>

<script>
     var places = require('places.js');

    export default {
        
        data () {
            return {
                bg : "",
                location : {
                    country : '' ,
                    city :  '' ,
                    date : '' ,
                    bg : ''
                },
                weather : {
                    temp : '',
                    desc : '',
                    obs  : '' ,
                },
            }
        },
        methods : {
            async fetchData(city) {
                
                let response = await fetch(`/api/weather?query=${city || 'Tunisia'}`)
                let data = await response.json()
                this.weather = {
                    temp : data.current.temperature ,
                    desc : data.current.weather_descriptions ,
                    obs : data.current.observation_time 
                }
                this.location = {
                        country : data.location.country ,
                        city :  data.location.name ,
                        date : data.location.localtime ,
                        bg : await this.fetchBg(this.location.city , this.weather.desc[0])
                    }
                
                
                

            },
            async fetchBg(city , desc) {
                
                let query = (city +' ' +desc)
                const response = await fetch(`/api/unsplash?query=${query}`)
                const data = await response.json()
                return data.regular || data.raw

            },
            myLocation() {
                fetch('https://ipapi.co/json/')
                    .then(function(response) {
                        return response.json();
                    })
                    .then((data)=>{
                        
                        this.location = {
                            country : data.country_name ,
                            city :  data.city ,
                            date : Date.now() ,
                        }

                    });
            }
            
        },
        computed : {
            background() {
                return `background-image : linear-gradient(160deg, #0093E930 0%, #80D0C730 100%) , url('${this.location.bg||'./img/bg1.jpg'}') ; background-size : cover ; background-position : center top ;  `
            }
        },
        
        mounted() {
            this.myLocation()



            this.fetchData(this.location.city)


            var placesAutocomplete = places({
                appId: 'pl286R2G2FD6' ,
                apiKey: '3b6ce17440c6809a69b5a357d8779675' ,
                container: document.querySelector('#address-input')
                
                }).configure({
                    type: 'city',
                    aroundLatLngViaIP: false,
            });
            placesAutocomplete.on('change', (e) => {

                this.fetchData(e.suggestion.name)


            });
            


            

        }
    }
</script>


