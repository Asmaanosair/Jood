
<template>

    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->

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
                            data-toggle="modal" data-target="#add-contact" >إضافة صورة  جديده</button>
                    <!-- Add Contact Popup Model -->
                    <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">إضافة صورة  جديده  </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                </div>

                                <form class="form-horizontal form-material" @submit.prevent="AddSlider" enctype="multipart/form-data">
                                <div class="modal-body">

                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="name"  id="name" placeholder="العنوان ">
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

                    <h4 class="card-title"> الصور المتحركه </h4>
                    <h6 class="card-subtitle">رؤية جميع الصور </h6>
                    <table class="table table-striped table-bordered" id="editable-datatable">
                        <thead>
                        <tr>
                            <th>  العنوان </th>
                            <th>  الصوره </th>
                            <th>تعديل </th>
                            <th>حذف  </th>

                        </tr>
                        </thead>
                        <tbody>



                        <tr v-for="slider in sliders">

                            <td> {{slider.title || ''}}</td>
                            <td>

                                <img  :src="slider.image || ''"  width="100px" height="100px">

                            </td>

                            <td>
                                <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                        data-toggle="modal" data-target="#edit-contact" @click="EditSlider(slider.id)"> <i class="fa fa-edit"></i>  </button>
                                <!-- Add Contact Popup Model -->
                            </td>

                            <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteSlider(slider.id)"> <i class="fa fa-trash"></i>  </button></td>

                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> ا لعنوان  </th>
                            <th>الصور</th>
                            <th>تعديل </th>
                            <th>حذف </th>

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

                                <form class="form-horizontal form-material" @submit.prevent="UpdateSlider(id)"  enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="name" placeholder="العنوان  ">
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

    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</template>
<script>

    export default {
        mounted() {
            this.GetSliders();
        },
        data() {
            return {
                sliders:{},
                name: '',
                id: '',
                editName:'',
                allErrors:[],
                image: '',
                showImag:'',
            };
        },

        methods: {
            GetSliders(){
                axios.get('/admin/slider').then(res => {

                     this.sliders=res.data[0]
                })
            },
            EditSlider($id){
                this.allErrors=[];
                axios.get('/admin/slider/'+$id+'/edit').then(res => {
                    this.name=res.data[0].title
                    this.showImag=res.data[0].image
                    this.id=res.data[0].id
                })
            },
            AddSlider() {
                let self = this;
                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('image', this.image);

                axios.post('/admin/slider', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(){
                        self.allErrors=[]
                        self.GetSliders();
                        self.$swal({
                            text:'تم الاضافه بنجاح   !!!',
                            icon: "success",
                        });
                }).catch(function (error) {
                        self.allErrors = error.response.data.errors
                }
                )
            },
            DeleteSlider($id){
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                    CancelButtonText:  'الغاء'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/admin/slider/'+$id).then(res => {
                            this.GetSliders()
                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },
            UpdateSlider($id) {
                let self = this;
                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('image', this.image);
                formData.append('_method',"PUT")
                axios.post('/admin/slider/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(res){
                      self.GetSliders();
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
        },

    }


</script>
