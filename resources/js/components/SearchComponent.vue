<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Search Properties</h1>
    <form @submit.prevent="searchProperties" class="space-y-4 mb-6">
      <div class="grid grid-cols-2 gap-4">
        <input v-model="filters.name" placeholder="Name" class="border p-2 rounded w-full" />
        <input v-model.number="filters.bedrooms" placeholder="Bedrooms" type="number" class="border p-2 rounded w-full" />
        <input v-model.number="filters.bathrooms" placeholder="Bathrooms" type="number" class="border p-2 rounded w-full" />
        <input v-model.number="filters.storeys" placeholder="Storeys" type="number" class="border p-2 rounded w-full" />
        <input v-model.number="filters.garages" placeholder="Garages" type="number" class="border p-2 rounded w-full" />
        <input v-model.number="filters.price_min" placeholder="Min Price" type="number" class="border p-2 rounded w-full" />
        <input v-model.number="filters.price_max" placeholder="Max Price" type="number" class="border p-2 rounded w-full" />
      </div>
      <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Search</button>
    </form>

    <div v-if="loading" class="text-center">Loading...</div>

    <table v-if="results.data && results.data.length" class="w-full border-collapse border border-gray-200">
      <thead>
      <tr class="bg-gray-100">
        <th class="border p-2">Name</th>
        <th class="border p-2">Bedrooms</th>
        <th class="border p-2">Bathrooms</th>
        <th class="border p-2">Storeys</th>
        <th class="border p-2">Garages</th>
        <th class="border p-2">Price</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="property in results.data" :key="property.id">
        <td class="border p-2">{{ property.name }}</td>
        <td class="border p-2">{{ property.bedrooms }}</td>
        <td class="border p-2">{{ property.bathrooms }}</td>
        <td class="border p-2">{{ property.storeys }}</td>
        <td class="border p-2">{{ property.garages }}</td>
        <td class="border p-2">${{ property.price }}</td>
      </tr>
      </tbody>
    </table>

    <div v-else class="text-center text-gray-500">No results found</div>

    <div v-if="results.links" class="mt-4 flex justify-center space-x-2">
      <button
          v-for="(link, index) in results.links"
          :key="index"
          @click="goToPage(link.url)"
          :class="[
          'py-2 px-4 rounded',
          link.active ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700',
        ]"
          v-html="link.label"
      ></button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      filters: {
        name: '',
        bedrooms: null,
        bathrooms: null,
        storeys: null,
        garages: null,
        price_min: null,
        price_max: null,
      },
      results: {},
      loading: false,
    };
  },
  methods: {
    async searchProperties() {
      this.loading = true;
      try {
        const response = await axios.get('/api/properties', {
          params: this.filters,
        });
        this.results = response.data;
      } catch (error) {
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
    async goToPage(url) {
      if (!url) return;
      this.loading = true;
      try {
        const response = await axios.get(url);
        this.results = response.data;
      } catch (error) {
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
  },
  mounted() {
    this.searchProperties(); // Запрос данных при загрузке компонента
  },
};
</script>
