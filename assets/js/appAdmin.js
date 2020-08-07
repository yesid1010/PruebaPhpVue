import { Products} from '../js/Components/Product.js';
import {Categories} from '../js/Components/Categories.js';

const Ordenes = { template: '<div>ordenes</div>' }

const routes = [
  { path: '/', component: Products },
  { path: '/products', component: Products },
  { path: '/categories', component: Categories },
  { path: '/ordenes', component: Ordenes }
]


const router = new VueRouter({
  routes 
})


var application2 = new Vue({
   
    el:'#appAdmin',
    router
})