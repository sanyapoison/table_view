<template>
  <div class="container m-auto mt-4">
    <el-form @submit.prevent="searchProperties" label-width="120px">
      <el-row :gutter="20">
        <el-col :span="12">
          <el-form-item label="Name">
            <el-input v-model="filters.name" placeholder="Enter name" />
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item label="Bedrooms">
            <el-input-number v-model="filters.bedrooms" placeholder="Bedrooms" />
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item label="Bathrooms">
            <el-input-number v-model="filters.bathrooms" placeholder="Bathrooms" />
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item label="Storeys">
            <el-input-number v-model="filters.storeys" placeholder="Storeys" />
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item label="Garages">
            <el-input-number v-model="filters.garages" placeholder="Garages" />
          </el-form-item>
        </el-col>
        <el-col :span="12">
          <el-form-item label="Price Range">
            <el-slider
                v-model="filters.price"
                range
                :min="100000"
                :max="1000000"
                show-tooltip
            />
          </el-form-item>
        </el-col>
      </el-row>
      <el-form-item>
        <el-button type="primary" @click="searchProperties">Search</el-button>
      </el-form-item>
    </el-form>

    <el-table :data="results.data" style="width: 100%" v-if="results.data && results.data.length">
      <el-table-column prop="name" label="Name" width="180" />
      <el-table-column prop="bedrooms" label="Bedrooms" />
      <el-table-column prop="bathrooms" label="Bathrooms" />
      <el-table-column prop="storeys" label="Storeys" />
      <el-table-column prop="garages" label="Garages" />
      <el-table-column prop="price" label="Price" />
    </el-table>

    <el-pagination
        v-if="results.links"
        @size-change="handleSizeChange"
        @current-change="goToPage"
        :current-page="results.current_page"
        :page-sizes="[5]"
        :page-size="results.per_page"
        :total="results.total"
        layout="total, sizes, prev, pager, next, jumper"
        class="mt-4"
    />
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
        price: [100000, 1000000],
      },
      results: {},
    };
  },
  methods: {
    async searchProperties() {
      try {
        const response = await axios.get('/api/properties', {
          params: {
            ...this.filters,
            price_min: this.filters.price[0],
            price_max: this.filters.price[1],
          },
        });
        this.results = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    async goToPage(page) {
      try {
        const response = await axios.get(`/api/properties?page=${page}`);
        this.results = response.data;
      } catch (error) {
        console.error(error);
      }
    },
  },
  mounted() {
    this.searchProperties();
  },
};
</script>
