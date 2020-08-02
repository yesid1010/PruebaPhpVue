import { Products} from '../js/Components/Product.js';
import {Categories} from '../js/Components/Categories.js';

const Ordenes = { template: '<div>ordenes</div>' }
// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
  { path: '/', component: Products },
  { path: '/products', component: Products },
  { path: '/categories', component: Categories },
  { path: '/ordenes', component: Ordenes }
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes // short for `routes: routes`
})


var application2 = new Vue({
   
    el:'#appAdmin',
    data:{
        
        products:[] = '',
        categories:'',
        category:'',
        product:{
            name:'',
            price:'',
            image:'',
            description:'',
            category:''
        }
    },
   
    methods:{
        addProduct(product){
            axios.post('../backend/api.php',{
                url:'created_product',
                product : product
            })
            .then( (data) =>{
                application2.product.name = '';
                application2.product.price = '';
                application2.product.description = '';
                application2.product.image = '';
                application2.product.category = ''
                console.log(data.data);
            })
        }
    },

    created:function(){},
    router
})