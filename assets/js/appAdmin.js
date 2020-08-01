var application2 = new Vue({
    el:'#appAdmin',
    data:{
        name:'',
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
        addCategory : function(name){
            axios.post('../backend/api.php',{
                url:'save_category',
                name:name
            })
            .then((data)=>{
                application2.name = ''
                console.log(data.data);
            })
        },
        getCategories:function(){
            axios.post('../backend/api.php', {
                url:'categories',
            })
            .then((data)=>{
                application2.categories = data.data;
                console.log(application2.categories);
            });
        },

        addProduct(product){
            axios.post('../backend/api.php',{
                url:'created_product',
                product : product
            })
            .then( (data) =>{
                application2.product = ''
                console.log(data.data);
            })
        }
    },

    created:function(){
        this.getCategories();
    }

})