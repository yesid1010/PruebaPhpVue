const Products = {  
    data: function() {
            return {
                products:[],
                categories:[],
                product:{
                    name:'',
                    price:'',
                    image:'',
                    description:'',
                    category:''
                },
                category:''
            }
    },
    created:function(){
        this.getProducts();
    },
    methods: {
        addProduct(product){
            axios.post('../backend/api.php',{
                url:'created_product',
                product : product
            })
            .then( (data) =>{
                console.log(data);
                this.product.name = '';
                this.product.price = '';
                this.product.description = '';
                this.product.image = '';
                this.product.category = '';
                this.getProducts();
                this.closemodal('createProduct');
            })
        },
        getProducts:function(category=0){
            var that = this;
            axios.post('../backend/api.php', {
                url:'products',
                category
            })
            .then(function(response){
                that.products = response.data[0];
                that.categories = response.data[1];
            });
        },
        deleteProduct : function(id){
            axios.post('../backend/api.php',{
                url:'deleteProduct',
                id: id
            })
            .then((data)=>{
                this.getProducts();
                swal("Eliminado", "Producto eliminado", "success",{
                    timer: 2000,
                    button:false
                });
                console.log(data.data);
            })

        },
        confirmDelete: function(id){
            swal({
                     title: "¿Eliminar este Producto?",
                     text: "Esta acciòn no se podrà deshacer",
                     icon: "warning",
                     buttons: true,
                     dangerMode: true,
                 })
                 .then((willDelete) => {
                     if (willDelete) {
                         this.deleteProduct(id)
                     }
                 });
         },
        closemodal: function(modal){
            $('#'+modal).modal('hide');
        }
    },
    template: `<div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><h3>Products</h3></div>
                        <div class="col-md-4 float-right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#createProduct">Crear Producto</button></div>
                    </div>
                    <hr>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">id</th>
                            <th scope="col">name</th>
                            <th scope="col">price</th>
                            <th scope="col">description</th>
                            <th scope="col">image</th>
                            <th scope="col">options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products">
                            <th scope="row">{{product.idproduct}}</th>
                            <td>{{product.name}}</td>
                            <td>{{product.price}}</td>
                            <td>{{product.description}}</td>
                            <td> <img :src="product.image" width="100px" height="100px"  alt="..."></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategory">Editar</button>
                                <button type="button" class="btn btn-danger" @click="confirmDelete(product.idproduct)">Eliminar</button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">Name</label>
                                            <input v-model="product.name" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Price</label>
                                            <input v-model="product.price" type="number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="">image (url)</label>
                                            <input v-model="product.image" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                                <label for="" >Category</label>
                                                <select v-model="product.category" class="form-control">
                                                <option v-for="category in categories"   v-bind:value="category.idcategory">
                                                    {{ category.name }}
                                                    </option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="" >Description</label>
                                            <textarea v-model="product.description" class="form-control" cols="10" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" @click="addProduct(product)" class="btn btn-primary">Save</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>`,
    }

    export {Products};