const Categories = { 
        data: function() {
            return {
                categories:[],
                name:'',
            }
        },
        created:function(){
            this.getCategories();
        },
        methods: {
            addCategory : function(name){
                axios.post('../backend/api.php',{
                    url:'save_category',
                    name:name
                })
                .then((data)=>{
                    this.name = ''
                    console.log(data.data);
                    this.getCategories();
                })
            },

            getCategories:function(){
                var that = this;
                axios.post('../backend/api.php', {
                    url:'categories'
                })
                .then(function(response){
                    that.categories = response.data;
                    console.log(that.categories);
                });
            }
        },
        template: `<div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"><h3>Categories</h3></div>
                            <div class="col-md-4 float-right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#createCategory">Crear Categoria</button></div>
                        </div>
                        <hr>
                        <table class="table col-md-8 offset-md-2">
                            <thead class="thead-dark">
                                <tr>
                                <th width="200">id</th>
                                <th width="200">name</th>
                                <th width="200" >options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="category in categories">
                                <th >{{category.idcategory}}</th>
                                <td>{{category.name}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategory">Editar</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#createCategory">Eliminar</button>
                                </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-row">
                                                <label for="" class="col-md-2">Name: </label>
                                                <input v-model="name" type="text" class="form-control col-md-6">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" @click="addCategory(name)" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>`
}

export {Categories};