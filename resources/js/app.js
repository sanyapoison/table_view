import './bootstrap';
import { createApp } from 'vue';
import ElementPlus from 'element-plus';
import 'element-plus/dist/index.css';
import SearchComponent from './components/SearchComponent.vue';

const app = createApp({});
app.use(ElementPlus);
app.component('search-component', SearchComponent);
app.mount('#app');



