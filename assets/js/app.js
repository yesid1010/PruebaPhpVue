var application = new Vue({
    el:'#app',
    data:{
        products:'',
        categories:'',
        category:'',
        myModel:false,
        carrito:'',
        video:''
    },

    methods:{
                fetchAllData:function(category=0){
                    axios.post('backend/routes/index.php', {
                        url:'products',
                        category
                    })
                    .then(function(response){
                        application.products = response.data[0];
                        application.categories = response.data[1].data;
                        console.log(response);
                    });
                },

                addcard : function(product){
                    console.log(product)
                },
                getVideo(event){
                    application.video = event.target.files[0];
                },
                addvideo:function(){
                    const formData = new FormData()
                    formData.append('video',application.video, application.video.name)

                    axios.post('subir.php',formData)
                    .then(response => {
                        $('#file').val('');
                        swal("Guardado", "Archivo Guardado", "success",{
                            timer: 2000,
                            button:false
                        });
                    })
                },
                addOrden: function(carrito){
                    axios.post('backend/routes/index.php', {
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