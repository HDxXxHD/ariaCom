<template>
   <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" @submit.prevent="addnewProduct()">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="pro_title">Product Title</label>
                            <input id="pro_title" v-model="form.pro_title" type="text" name="pro_title" placeholder="Enter Prdouct Title"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('pro_title') }">
                        <has-error :form="form" field="pro_title"></has-error>
                        </div>
                        <div class="col-md-4">
                            <label for="category_id">Product Category</label>
                            <select class="form-control" :class="{ 'is-invalid': form.errors.has('category_id') }" v-model="form.category_id">
                                <option disabled value="">Please select a category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{category.cat_name}}</option>
                                
                            </select>
                        <has-error :form="form" field="pro_title"></has-error>

                        </div>
                        
                    </div>
                     <div class="form-group">
                        <label for="pro_desc">Product Description</label>
                            <!-- <textarea rows="4" id="pro_descId"  v-model="form.pro_desc" type="text" name="pro_desc" placeholder="Enter Prdouct Description"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('pro_desc') }"></textarea> -->
                             <ckeditor  :editor="editor" v-model="form.pro_desc"  @ready="onReady" :config="editorConfig"></ckeditor>
                            <has-error :form="form" field="pro_desc"></has-error>
                    </div>  
                     <div class="col-md-12">
                       <div class="row form-group">
                         <div class="col-md-4">
                         <label for="pro_brand">Product Brand</label>
                            <input id="pro_brand" v-model="form.pro_brand" type="text" name="pro_brand" placeholder="Enter Prdouct Brand"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('pro_brand') }">
                        <has-error :form="form" field="pro_brand"></has-error>
                      </div>
                      <div class="col-md-4">
                         <label for="pro_origin">Product Origin</label>
                            <input id="pro_origin" v-model="form.pro_origin" type="text" name="pro_origin" placeholder="Enter Prdouct Origin"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('pro_origin') }">
                        <has-error :form="form" field="pro_origin"></has-error>
                      </div>
                      <div class="col-md-4">
                         <label for="pro_type">Product Type</label>
                            <input id="pro_type" v-model="form.pro_type" type="text" name="pro_type" placeholder="Enter Prdouct Type"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('pro_type') }">
                        <has-error :form="form" field="pro_type"></has-error>
                      </div>
                       </div>   
                     </div>
                     <div class="col-md-12">
                        <div class="row form-group">
                          <div class="col-md-4">
                         <label for="pro_model">Product Model</label>
                            <input id="pro_model" v-model="form.pro_model" type="text" name="pro_model" placeholder="Enter Prdouct Model"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('pro_model') }">
                        <has-error :form="form" field="pro_model"></has-error>
                      </div>
                      <div class="col-md-4">
                        <label for="pro_incoterms">Product Incoterms</label>
                            <input id="pro_incoterms" v-model="form.pro_incoterms" type="text" name="pro_incoterms" placeholder="Enter Prdouct Incoterms"
                          class="form-control" :class="{ 'is-invalid': form.errors.has('pro_incoterms') }">
                        <has-error :form="form" field="pro_incoterms"></has-error>
                      </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="pro_packing">Product Packing</label>
                            <ckeditor  :editor="editor" v-model="form.pro_packing"  @ready="onReady" :config="editorConfig"></ckeditor>
                            <has-error :form="form" field="pro_packing"></has-error>
                     </div>
                     <div class="form-group">
                        <label for="pro_termsSale">Product sales conditions</label>
                            <ckeditor  :editor="editor" v-model="form.pro_termsSale"  @ready="onReady" :config="editorConfig"></ckeditor>
                            <has-error :form="form" field="pro_termsSale"></has-error>
                     </div>
                     <div class="form-group">
                        <label for="pro_payType">Product Payment Terms</label>
                            <ckeditor  :editor="editor" v-model="form.pro_payType"  @ready="onReady" :config="editorConfig"></ckeditor>
                            <has-error :form="form" field="pro_payType"></has-error>
                     </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input @change="changePhoto($event)" type="file" name="pro_photo" class="custom-file-input" id="pro_photoId" :class="{ 'is-invalid': form.errors.has('pro_photo') }">
                        <label class="custom-file-label" for="pro_photoId" >Choose Photo</label>
                         <has-error :form="form" field="pro_photo"></has-error>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                      <img :src="form.pro_photo" alt="" width="150" >
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
</template>

<script>
import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';

export default {
    name: 'New',
    data(){
        return{
            categories: {},
           form: new Form({
               pro_title: '',
               pro_desc: '',
               pro_brand: '',
               category_id: '',
               pro_origin: '',
               pro_type: '',
               pro_model: '',
               pro_packing: '',
               pro_termsSale: '',
               pro_incoterms: '',
               pro_payType: '',
               pro_color: '',
               pro_photo: '',
            }),
            editor: DecoupledEditor,
            editorConfig: {
                   ckfinder: {
                        // Open the file manager in the pop-up window.
                        openerMethod: 'popup',

                        uploadUrl: '/uploadckeditor',
                       
                        options: {
                            resourceType: 'Images'
                        }
                    },
            }

        } 

    },
    mounted(){
            
    },
    computed: {

    },
    methods:{
        onReady(editor) {
                // Insert the toolbar before the editable area.
                editor.ui.getEditableElement().parentElement.insertBefore(
                    editor.ui.view.toolbar.element,
                    editor.ui.getEditableElement()
                );
        },
        loadCategories(){
              axios.get("api/category").then(({data})=> (this.categories = data.data));
          },
          changePhoto(event){
              var file = event.target.files[0];
                if(file.size>100000){
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>Why do I have this issue?</a>'
                    })
                }else{
                var reader = new FileReader();
                reader.onload = (event) => {
                    // The file's text will be printed here
                   this.form.pro_photo = event.target.result
                };

                reader.readAsDataURL(file);
                }

                
          },
          addnewProduct(){
             this.form.post('saveproduct')
             .then(()=>{
                 this.$router.push('/product-list')

                 Toast.fire({
                     type: 'success',
                     title: 'Product Added successfully'
                 })
             })
             .catch(()=>{

             })
          }
         
    },
     created() {
          this.loadCategories();
          // setInterval(() => this.loadCategories(),10000);
        }
}
</script>

<style >
   .ck.ck-editor__editable_inline{
     border-color: #ced4da !important; 
   }
</style>