var application = new Vue({
    el:'#app',
    data:{
        products:'',
        categories:'',
        category:'',
        myModel:false,
        carrito:''
    },

    methods:{
                fetchAllData:function(category=0){
                    axios.post('backend/api.php', {
                        url:'products',
                        category
                    })
                    .then(function(response){
                        application.products = response.data[0];
                        application.categories = response.data[1];
                        console.log(response.data);
                    });
                },

                addcard : function(product){
                    console.log(product)
                },

                addOrden: function(carrito){
                    axios.post('backend/api.php', {
                        url:'insert',
                        carrito
                    })
                    .then(function(response){
                            console.log('compra realizada')
                    });
                },

    },
    created:function(){
     this.fetchAllData();
    }
   });