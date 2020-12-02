<template>
    <div class="weather-container pt-5" :style="background">
    
            <div class="weather-card">
                
                <div class="header">
                    <div class="status">
                        <div class="temp">
                            {{current.temp}} °C
                        </div>
                        <div class="desc">
                            <div v-for="desc in current.desc" :key="desc.index">
                                {{desc}}
                            </div>
                        </div>
                    </div>
                    
                    <div class="data">
                    <div class="city">
                            Gafsa, Tunisia
                    </div>
                    <div class="date">
                        Wed , 2 dec 2020
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
     
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data () {
            return {
                bg : "./img/bg1.jpg",
                current : {},
            }
        },
        methods : {
            async fetchData() {
                var response = await fetch(`/api/weather`)
                var data = await response.json()
                this.current = {
                    temp : data.current.temperature ,
                    desc : data.current.weather_descriptions ,
                }
                
                this.fetchBg()
            },
            async fetchBg() {
                var response = await fetch(`/api/unsplash?query=${this.current.desc[0]} `)
                var data = await response.json()
                data = data.filter(i=> {
                    if(i.width > i.height)
                    {return i}                    
                });
                this.bg = data[0].urls.raw
            }
        },
        computed : {
            background() {
                return "background-image : linear-gradient(160deg, #0093E930 0%, #80D0C730 100%) , url('"+this.bg+"') ; background-size : cover ; background-position : center ;  "
            }
        },
        created() {
            this.fetchData()
        }
    }
</script>


