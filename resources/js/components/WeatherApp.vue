<template>
    <div class="weather-container pt-5" :style="background">
            <input type="search" id="address-input" placeholder="Where are we going?" />
            <div id="address-value"></div>
            <div class="weather-card">
                
                <div class="header">
                    <div class="status">
                        <div class="temp">
                            {{current.temp}} °C <small>  at {{ current.obs }} </small>
                        </div>
                        
                        <div class="desc">
                            <div v-for="desc in current.desc" :key="desc.index">
                                {{desc}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="data">
                    <div class="city">
                            {{location.region}} , {{location.country}}
                    </div>
                    <div class="date">
                        {{location.localtime | moment("ddd , MMM Do") }}
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
                city : 'Gafsa',
                location : {},
                current : {},
            }
        },
        methods : {
            async fetchData() {
                
                let response = await fetch(`/api/weather?query=${this.city || 'Tunisia'}`)
                let data = await response.json()
                console.log(data)
                this.current = {
                    temp : data.current.temperature ,
                    desc : data.current.weather_descriptions ,
                    obs : data.current.observation_time 
                }
                this.fetchBg()
                this.location = data.location 
                
                

            },
            async fetchBg() {
                
                let query = (this.city +' ' +this.current.desc[0]) || 'nature'
                query = query.replace(/ /g, "%20")
                console.log(query)
                const response = await fetch(`/api/unsplash?query=${query}`)
                
                const data = await response.json()
                console.log(data)
                // data = data.filter(i=> {
                //     if(i.width > i.height)
                //     {return i}                    
                // });
                this.bg = data.regular || data.raw
                console.log(this.bg)
            },
            changeCity(city) {
                this.city = city
                this.fetchData()

            }
        },
        computed : {
            background() {
                return "background-image : linear-gradient(160deg, #0093E930 0%, #80D0C730 100%) , url('"+this.bg+"') ; background-size : cover ; background-position : center top ;  "
            }
        },
        
        mounted() {
            var placesAutocomplete = places({
                appId: 'pl286R2G2FD6' ,
                apiKey: '3b6ce17440c6809a69b5a357d8779675' ,
                container: document.querySelector('#address-input')
                
                }).configure({
                    type: 'city',
                    aroundLatLngViaIP: false,
            });
            placesAutocomplete.on('change', (e) => {
                this.changeCity(e.suggestion.name)
            });
            

            this.fetchData()

            

        }
    }
</script>


