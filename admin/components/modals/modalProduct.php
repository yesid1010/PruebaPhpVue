  <!-- Modal -->
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