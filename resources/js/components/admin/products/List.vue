<template>
    
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product List</h3>
              <div class="card-tools">
                  <button class="btn btn-primary" >
                    <i class="fas fa-plus-square mr-2" ></i><router-link class="text-decoration-none text-white" to="/add-product">Add Product</router-link></button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" 
                    colspan="1" aria-label="Browser: activate to sort column ascending">No</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Platform(s): activate to sort column ascending">Photo</th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" 
                    aria-label="Rendering engine: activate to sort column descending">Product Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" 
                    colspan="1" aria-label="Browser: activate to sort column ascending">Description</th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" 
                    aria-label="Rendering engine: activate to sort column descending">Category Name</th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" 
                    aria-label="Rendering engine: activate to sort column descending">User Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Platform(s): activate to sort column ascending">Created At</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Engine version: activate to sort column ascending">Action</th>
                   </tr>
                </thead>
                <tbody>
                <tr v-for="(product,index) in getAllProduct" :key="product.id" role="row" class="odd">
                  <td class="sorting_1">{{index+1}}</td>
                  <td><img class="rounded-circle" :src="ourImage(product.pro_photo)" alt="" width="75" height="75"></td>
                  <td>{{product.pro_title}}</td>
                  <td>{{product.pro_desc | sortlength(50,"...")}}</td> 
                  <td>{{product.category.cat_name}}</td>
                  <td>{{product.user.name}}</td>
                  <td>created_at</td>
                  <td>
                          
                          <router-link :to="`edit-product/${product.id}`" >
                             <i class="fa fa-edit text-success"></i>
                          </router-link>
                          <a href="#" @click.prevent="deleteProduct(product.id)"> 
                              <i class="fa fa-trash text-danger"></i>
                          </a>
                  </td>
                </tr></tbody>
               
              </table></div></div></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
         
        </div>
        <!-- /.col -->
   
</template>

<script>


export default {
    name: 'List',
    mounted(){
       this.$store.dispatch("allProduct")
    },
    computed:{
      getAllProduct(){
           return this.$store.getters.getProduct
      }
    },
    methods:{
       ourImage(img){
         return "img/"+img;
       },
       deleteProduct(id){
          Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.value) {
                    axios.get('/delete/'+id).then(() => {
                      Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                    this.$store.dispatch("allProduct")
                    // Fire.$emit('LisinerQueryChange');
                    }).catch(()=> {
                      Swal.fire(
                        "Failed!" , "There was something wronge." , "warning"
                      )
                    })
                  }
              })
       }
    }
}
</script>

<style scoped>
    
</style>