<template>
    
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">User List</h3>
              <div class="card-tools">
                  <button class="btn btn-primary" @click="newModel"><i class="fas fa-plus-square mr-2" ></i>Add User</button>
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
                    aria-label="Rendering engine: activate to sort column descending">User Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" 
                    colspan="1" aria-label="Browser: activate to sort column ascending">User Email</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Platform(s): activate to sort column ascending">Type</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Platform(s): activate to sort column ascending">Created At</th>
                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" 
                    aria-label="Engine version: activate to sort column ascending">Action</th>
                   </tr>
                </thead>
                <tbody>
                <tr v-for="(user, index) in users" :key="user.id" role="row" class="odd">
                  <td class="sorting_1">{{index+1}}</td>
                  <td>{{user.name | upText }}</td>
                  <td>{{user.email}}</td>
                  <td>{{user.type}}</td>
                  <td>{{user.created_at | myDate }}</td>
                  <td>
                       <a href="#" @click="editModel(user)" >
                              <i class="fa fa-edit text-success"></i>
                          </a>
                          <a href="#" @click="deleteUser(user.id)"> 
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
                    <h5 v-show="!editmode" class="modal-title" id="addNewLabel">Add New User</h5>
                    <h5 v-show="editmode" class="modal-title" id="addNewLabel">Update User info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                      <div class="form-group">
                        <label>User Name</label>
                        <input v-model="form.name" type="text" name="name" placeholder="User Name"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                      </div>
              
                     <div class="form-group">
                        <label>User Email</label>
                        <input v-model="form.email" type="email" name="email" placeholder="User email"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                      </div>
                     <div class="form-group">
                        <select v-model="form.type"  name="type" id="type"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value="">Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">Standard User</option>
                            <option value="author">Author</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
                      </div>
                     <div class="form-group">
                        <label>User Password</label>
                        <input v-model="form.password" type="password" name="password" placeholder="User password"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
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
             users: {},
             form: new Form({
               id: '',
               name: '',
               email: '',
               type: '',
               password: '',
               user_photo: '',
             }),
           }
        },
        methods: {
          updateUser(){
            this.$Progress.start();
            this.form.put('api/user/'+this.form.id)
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
          editModel(user){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(user)
          },
          newModel(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
          },
          deleteUser(id){
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
                    this.form.delete('api/user/'+id).then(() => {
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
          loadUsers(){
              axios.get("api/user").then(({data}) => (this.users = data.data));
          },
            createUser(){
              this.$Progress.start();
              this.form.post('api/user')
              .then(() => {
                 Fire.$emit('LisinerQueryChange');
              $('#addNew').modal('hide');
              Toast.fire({
                type: 'success',
                title: 'Signed in successfully'
                })
              this.$Progress.finish();

              })
              .catch(() => {
                this.$Progress.fail();
              })
             
            }
        }, 
        created() {
          this.loadUsers();
          Fire.$on('LisinerQueryChange', () => {
            this.loadUsers();
          })
          // setInterval(() => this.loadCategories(),10000);
        }
    }
</script>