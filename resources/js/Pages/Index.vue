<script setup>
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    tourist_guide_data: Array
});
</script>

<template>
    <Head title="Tourist Guide" />

    <div class="container">
        <h1 class="text-center">Tourist Guide</h1>

        <div class="accordion" id="tourist-accordion">
            <div v-for="(item, index) in tourist_guide_data" class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="`#${index}-cont`" aria-expanded="true" :aria-controls="`${index}-cont`">{{  item.city_name }}</button>
                </h2>
                <div :id="`${index}-cont`" class="accordion-collapse collapse" data-bs-parent="#tourist-accordion">
                    <div class="accordion-body">
                        <ul class="nav nav-tabs" :id="`${index}-tabs`" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" :id="`${index}-weather-tab`" data-bs-toggle="tab" :data-bs-target="`#${index}-weather-tab-cont`" type="button" role="tab" :aria-controls="`${index}-weather-tab-cont`" aria-selected="true">Weather</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" :id="`${index}-places-tab`" data-bs-toggle="tab" :data-bs-target="`#${index}-places-tab-cont`" type="button" role="tab" :aria-controls="`${index}-places-tab-cont`" aria-selected="false">Places</button>
                            </li>
                        </ul>
                        <div class="tab-content" :id="`${index}-tab-cont`">
                            <div class="tab-pane fade show active" :id="`${index}-weather-tab-cont`" role="tabpanel" :aria-labelledby="`${index}-weather-tab`" tabindex="0">
                                <div v-for="(forecasts_item, forecasts_index) in item.forecasts" class="ps-3">
                                    <p class="fw-bold m-0">{{ forecasts_index }}</p>
                                    <div v-for="(forecast_item, forecast_index) in forecasts_item" class="row mb-3">
                                        <div class="col-4 col-xl-1">{{ forecast_index }}</div>
                                        <div class="col-8 col-xl-3">
                                            <div class="row">
                                                <div class="col col-xl-6">Weather</div>
                                                <div class="col col-xl-6">{{ forecast_item.weather }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-xl-6">Temperature</div>
                                                <div class="col col-xl-6">{{ forecast_item.temperature }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-xl-6">Precipitation</div>
                                                <div class="col col-xl-6">{{ forecast_item.precipitation }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-xl-6">Humidity</div>
                                                <div class="col col-xl-6">{{ forecast_item.humidity }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                            <div class="tab-pane fade" :id="`${index}-places-tab-cont`" role="tabpanel" :aria-labelledby="`${index}-places-tab`" tabindex="0">
                                <div v-for="(places_item, places_index) in item.places" class="ps-3">
                                    <div class="my-3 clearfix">
                                        <div class="float-start me-1">
                                            <img :src="places_item.photo" :alt="places_item.name" />
                                        </div>
                                        <div class="float-start place-info">
                                            <p>{{ places_item.name }}</p>
                                            <p>{{ places_item.address }}</p>
                                            <div class="row">
                                                <div class="col">{{ places_item.category }}</div>
                                                <div class="col">{{ places_item.rating }}/10 rating</div>
                                                <div class="col text-break">{{ places_item.is_closed }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
