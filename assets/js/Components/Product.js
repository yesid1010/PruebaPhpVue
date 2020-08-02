const Products = {  
    data: function() {
            return {
                products:[]
            }
    },
    created:function(){
        this.getProducts();
    },
    methods: {
        getProducts:function(category=0){
            var that = this;
            axios.post('../backend/api.php', {
                url:'products',
                category
            })
            .then(function(response){
                that.products = response.data[0];
            });
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
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createCategory">Eliminar</button>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>`,
    }

    export {Products};