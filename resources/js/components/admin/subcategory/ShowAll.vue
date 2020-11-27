<template>

    <!-- ============================================================== -->
    <!-- Page wrapper  -->

        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-subtitle"></h6>
                    <button type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right"
                            data-toggle="modal" data-target="#add-contact" >إضافة اقسام  جديده</button>
                    <!-- Add Contact Popup Model -->
                    <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">إضافة اقسام جديده  </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                </div>

                                <form class="form-horizontal form-material" @submit.prevent="AddSubCategory" enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Image</span>
                                                    <input  type="file" @change="UploadImage" class="upload">
                                                    <div v-if="allErrors.image" class="alert-danger form-control">{{ allErrors.image[0] }}</div>

                                                </div>
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class="form-group mb-4">
                                                                <label for="exampleFormControlSelect1"> اختر القسم التابع له </label>
                                                                <select class="form-control" id="exampleFormControlSelect1" v-model="categoryId">
                                                                    <option  v-for="category in categories" :value="category.id">{{category .category}}</option>
                                                                </select>
                                                            </div>
                                                <div v-if="allErrors.categoryId" class="alert-danger form-control">{{ allErrors.categoryId[0] }}</div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect"
                                        >Save</button>

                                        <button type="button" class="btn btn-default waves-effect"
                                                data-dismiss="modal">Cancel</button>

                                    </div>
                                </form>


                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <h4 class="card-title">الاقسام الفرعية </h4>
                    <h6 class="card-subtitle">رؤية جميع الاقسام الفرعية</h6>
                    <table class="table table-striped table-bordered" id="zero_config">
                        <thead>
                        <tr>
                            <th> الاقسام الفرعية</th>
                            <th> الاقسام الرئيسية</th>
                            <th>  الصوره</th>
                            <th>  اظهار فى الصفحه الرئيسيه </th>


                            <th>تعديل </th>
                            <th>حذف  </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="subcategory in subCategories">

                            <td> {{subcategory.name || ''}}</td>
                            <td>

                                {{subcategory.category || ''}}

                            </td>
                            <img  :src="subcategory.image || ''"  width="100px" height="100px">
                            <td>

                                <span v-if="subcategory.visibility==1" v-on:click="ChangeVisibility(subcategory.id)" class="btn btn-success   m-t-10 mb-2"
                                >   تم العرض      </span>
                                <span v-else-if="subcategory.visibility==0"  class="btn btn-danger  m-t-10 mb-2" v-on:click="ChangeVisibility(subcategory.id)"
                                >     غير معروض     </span>


                            </td>
                            <td>
                                <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                        data-toggle="modal" data-target="#edit-contact" @click="EditSubCategory(subcategory.id)"> <i class="fa fa-edit"></i>  </button>
                                <!-- Add Contact Popup Model -->
                            </td>

                            <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteSubCategory(subcategory.id)">  <i class="fa fa-trash"></i>  </button></td>
                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> الاقسام الفرعية</th>
                            <th>الاقسام الرئيسية</th>

                            <th> الصوره</th>
                            <th>  اظهار فى الصفحه الرئيسيه </th>
                            <th>تعديل </th>
                            <th>حذف  </th>
                        </tr>
                        </tfoot>
                    </table>
                    <div id="edit-contact"  class="modal fade in" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" >  تعديل   </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                </div>

                                <form class="form-horizontal form-material" @submit.prevent="UpdateSubCategory(id)"  enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>

                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Image</span>
                                                    <input  type="file" @change="UploadImage" class="upload">
                                                    <img :src="showImag" width="50px" height="50px">
                                                </div>
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <div class="form-group mb-4">
                                                    <label for="exampleFormControlSelect1"> اختر القسم الرئيسي </label>
                                                    <select class="form-control" id="exampleFormControlSelect" v-model="categoryId">

                                                        <option  v-for="category in categories" :value="category.id">{{category .category}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info waves-effect"
                                        >Save</button>

                                        <button type="button" class="btn btn-default waves-effect"
                                                data-dismiss="modal">Cancel</button>

                                    </div>
                                </form>


                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->

    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</template>
<script>
    export default {
        mounted() {
            this.GetSubCategory();
        },
        data() {
            return {
                categories:{},
                subCategories:{},
                name: '',
                id: '',
                categoryId: '',
                allErrors:[],
                image: '',
                showImag:'',
                allStatus:['   المتجر غير متاح  ',
                    '   المتجر  متاح ',
                ],
                availability:0,
            };
        },
        methods: {
            GetSubCategory(){
                axios.get('/admin/sub_category').then(res => {
                   this.categories=res.data.categories
                   this.subCategories=res.data.subCategories
                })
            },
            EditSubCategory($id){
                axios.get('/admin/sub_category/'+$id+'/edit').then(res => {
                    this.name=res.data[0].name
                    this.id=res.data[0].id
                    this.showImag=res.data[0].image
                   this.categoryId=res.data[0].category_id
                })
            },
            AddSubCategory() {
                let self = this;
                let formData = new FormData();
                formData.append('categoryId',this.categoryId);
                formData.append('name', this.name);
                formData.append('image', this.image);
                axios.post('/admin/sub_category', formData)
                    .then(function(){
                        self.GetSubCategory();
                        self.allErrors=[]
                        self.$swal({
                            text:'تم الاضافه بنجاح   !!!',
                            icon: "success",
                        });
                    }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                    }
                )
            },
            DeleteSubCategory($id){
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                    CancelButtonText:  'الغاء'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/admin/sub_category/'+$id).then(res => {
                            this.GetSubCategory()
                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },
            UpdateSubCategory($id) {
                let self = this;
                let formData = new FormData();
                formData.append('name',this.name);
                formData.append('image',this.image);
                formData.append('categoryId', this.categoryId);
                formData.append('_method',"PUT")
                axios.post('/admin/sub_category/'+$id, formData)
                    .then(function(res){
                        self.GetSubCategory();
                        self.$swal({
                            text:'تم التعديل بنجاح   !!!',
                            icon: "success",
                        });

                    }).catch(function(error){
                    self.allErrors = error.response.data.errors
                });
            },
            UploadImage(e){
                this.image = e.target.files[0];
            },
            ChangeVisibility($id){
                let self = this;
                axios.get('/admin/sub_category/'+$id+'/visibility')
                    .then(function(res){
                        self.GetSubCategory();
                        console.log(res.data)
                        self.$swal({
                            text:res.data,
                            icon: "success",
                        });
                    }).catch(function(error){

                });

            },
        },

    }


</script>
