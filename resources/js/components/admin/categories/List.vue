<template>
    
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>
              <div class="card-tools">
                  <button class="btn btn-primary" @click="newModel"><i class="fas fa-plus-square mr-2" ></i>Add Category</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row">
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" 
                    colspan="1" aria-label="Browser: activate to sort column ascending">No</th>
                    <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" 
                    aria-label="Rendering engine: activate to sort column descending">Category Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" 
                    colspan="1" aria-label="Browser: activate to sort column ascending">Description</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Platform(s): activate to sort column ascending">Photo</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Platform(s): activate to sort column ascending">Created At</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Engine version: activate to sort column ascending">Action</th>
                   </tr>
                </thead>
                <tbody>
                <tr v-for="(category, index) in categories" :key="category.id" role="row" class="odd">
                  <td class="sorting_1">{{index+1}}</td>
                  <td>{{category.cat_name | upText }}</td>
                  <td>{{category.Desc}}</td>
                  <td><img :src="category.cat_photo" class="rounded-circle" alt="" width="75" height="75"></td>
                  <td>{{category.created_at | myDate }}</td>
                  <td>
                       <a href="#" @click="editModel(category)" >
                              <i class="fa fa-edit text-success"></i>
                          </a>
                          <a href="#" @click="deleteCatedory(category.id)"> 
                              <i class="fa fa-trash text-danger"></i>
                          </a>
                  </td>
                </tr></tbody>
               
              </table></div></div></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New Category</h5>
                    <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update Category info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                <div class="modal-body">
                      <div class="form-group">
                        <label>Category Name</label>
                        <input v-model="form.cat_name" type="text" name="cat_name" placeholder="Category Name"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('cat_name') }">
                        <has-error :form="form" field="cat_name"></has-error>
                      </div>
              
                     <div class="form-group">
                        <label>Category Description</label>
                        <input v-model="form.Desc" type="text" name="Desc" placeholder="Category Description"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('Desc') }">
                        <has-error :form="form" field="Desc"></has-error>
                      </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-success">Create</button>
                </div>
                </form>
                </div>
                
            </div>
            </div>
        </div>
        <!-- /.col -->
   
</template>

<script>
import { setInterval } from 'timers';
    export default {
        // name:"List",
        data(){
           return {
             editmode: false,
             categories: {},
             form: new Form({
               id: '',
               cat_name: '',
               Desc: '',
               cat_photo: '',
             }),
           }
        },
        methods: {
          updateCategory(){
            this.$Progress.start();
            this.form.put('api/category/'+this.form.id)
            .then(() => {
               $('#addNew').modal('hide');
              Swal.fire(
                      'Updated!',
                      'Information has been updated.',
                      'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('LisinerQueryChange');
            })
            .catch(() => {
              this.$Progress.fail();
            })
          },
          editModel(category){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(category)
          },
          newModel(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },
          deleteCatedory(id){
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
                    this.form.delete('api/delete/'+id).then(() => {
                      Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                    Fire.$emit('LisinerQueryChange');
                    }).catch(()=> {
                      Swal.fire(
                        "Failed!" , "There was something wronge." , "warning"
                      )
                    })
                  }
              })
          },
          loadCategories(){
              axios.get("api/category").then(({data})=> (this.categories = data.data));
          },
            createCategory(){
              this.$Progress.start();
              this.form.post('api/category')
              .then(() => {
                 Fire.$emit('LisinerQueryChange');
              $('#addNew').modal('hide');
              Toast.fire({
                type: 'success',
                title: 'Category Added successfully'
                })
              this.$Progress.finish();

              })
              .catch(() => {
                this.$Progress.fail();
              })
             
            }
        }, 
        created() {
          this.loadCategories();
          Fire.$on('LisinerQueryChange', () => {
            this.loadCategories();
          })
          // setInterval(() => this.loadCategories(),10000);
        }
    }
</script>