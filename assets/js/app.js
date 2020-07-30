var application = new Vue({
    el:'#app',
    data:{
        products:'',
        categories:'',
        selectedCategorie:'',
        myModel:false,
        carrito:''
    },

    methods:{
                fetchAllData:function(selectedCategorie=0){
                    axios.post('backend/api.php', {
                        action:'fetchall',
                        selectedCategorie
                    })
                    .then(function(response){
                        application.products = response.data[0];
                        application.categories = response.data[1];
                    });
                },

                addcard : function(product){
                    console.log(product)
                },

                addOrden: function(carrito){
                    axios.post('backend/api.php', {
                        action:'insert',
                        carrito
                    })
                    .then(function(response){
                            console.log('compra realizada')
                    });
                }

    },
    created:function(){
     this.fetchAllData();
    }
   });