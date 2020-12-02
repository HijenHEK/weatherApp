<template>
    <div class="weather-container pt-5" :style="background">
    
            <div class="weather-card">
                
                <div class="header">
                    <div class="status">
                        <div class="temp">
                            15°C
                        </div>
                        <div class="desc">
                            Cloudy
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
                bg : './img/bg1.jpg'
            }
        },
        computed : {
            background() {
                return "background : linear-gradient(160deg, #0093E985 0%, #80D0C785 100%) ,url('"+this.bg+"') ";
            }
        }
    }
</script>


