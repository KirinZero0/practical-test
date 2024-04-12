<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";

const searchCity = ref("Denpasar");
const weatherData = ref(null);
const isLoading = ref(false);

const searchWeather = async () => {
    try {
        isLoading.value = true;
        const apiKey = "3babffdc944f53958bb905aa1bb81873";
        const response = await fetch(
            `https://api.openweathermap.org/data/2.5/weather?q=${searchCity.value}&appid=${apiKey}`
        );
        const data = await response.json();
        if (response.ok) {
            weatherData.value = {
                city: data.name,
                description: data.weather[0].description,
                temperature: data.main.temp,
                humidity: data.main.humidity,
                windSpeed: data.wind.speed,
                weatherIcon: `https://openweathermap.org/img/wn/${data.weather[0].icon}.png`,
            };
        } else {
            console.error("Failed to fetch weather data:", data.message);
        }
    } catch (error) {
        console.error("Error fetching weather data:", error);
    } finally {
        isLoading.value = false;
    }
};
onMounted(() => {
    searchWeather();
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex justify-center items-center h-full mt-3">
            <div
                class="bg-gradient-to-b from-white to-blue-400 overflow-hidden shadow-sm sm:rounded-lg w-72 md:rounded-lg lg:rounded-lg"
            >
                <div class="p-6 text-gray-900 flex flex-col items-center">
                    <input
                        type="text"
                        placeholder="Enter city name"
                        class="px-4 py-2 border border-gray-300 rounded-md mb-4 w-full"
                        v-model="searchCity"
                    />
                    <button
                        class="px-4 py-2 bg-sky-300 text-white rounded-md hover:bg-sky-500"
                        @click="searchWeather"
                    >
                        Search
                    </button>

                    <div v-if="weatherData" class="mt-6">
                        <img
                            :src="weatherData.weatherIcon"
                            :alt="weatherData.description"
                            class="w-16 h-16 mx-auto mb-4"
                        />

                        <div class="text-center">
                            <h3 class="text-lg font-semibold">
                                {{ weatherData.city }}
                            </h3>
                            <p class="text-sm">{{ weatherData.description }}</p>
                            <p class="text-3xl font-bold">
                                {{ weatherData.temperature }}°C
                            </p>
                            <p class="text-sm">
                                Humidity: {{ weatherData.humidity }}%
                            </p>
                            <p class="text-sm">
                                Wind Speed: {{ weatherData.windSpeed }} km/h
                            </p>
                        </div>
                    </div>
                    <div
                        v-else-if="isLoading"
                        class="flex justify-center items-center mt-6"
                    >
                        Loading weather data...
                    </div>
                    <div v-else class="flex justify-center items-center mt-6">
                        Weather data not found. Please try again.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
