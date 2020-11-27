
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
                    <form class="form-horizontal form-material" @submit.prevent="UpdateSetting(id)"  enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">

                                <div class="col-md-12 m-b-20">
                                    <label>اسم الموقع </label>
                                    <input type="text" class="form-control" v-model="name" placeholder=" اسم الموقع">
                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label> رقم الجوال  </label>
                                    <input type="text" class="form-control" v-model="phone" placeholder="رقم الجوال  ">
                                    <div v-if="allErrors.phone" class="alert-danger form-control">{{ allErrors.phone[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label> البريد الاليكترونى  </label>
                                    <input type="text" class="form-control" v-model="email" placeholder="البريد الاليكتروني  ">
                                    <div v-if="allErrors.email" class="alert-danger form-control">{{ allErrors.email[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label> الفيسبوك  </label>
                                    <input type="text" class="form-control" v-model="facebook" placeholder=" الفيسبوك   ">
                                    <div v-if="allErrors.facebook" class="alert-danger form-control">{{ allErrors.facebook[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label> تويتر  </label>
                                    <input type="text" class="form-control" v-model="twitter" placeholder=" تويتر   ">
                                    <div v-if="allErrors.twitter" class="alert-danger form-control">{{ allErrors.twitter[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label> انستجرام  </label>
                                    <input type="text" class="form-control" v-model="instagram" placeholder=" انستجرام    ">
                                    <div v-if="allErrors.instagram" class="alert-danger form-control">{{ allErrors.instagram[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label>Meta Keywords </label>
                                    <input type="text" class="form-control" v-model="keywords" placeholder=" Meta Keywords    ">
                                    <div v-if="allErrors.keywords" class="alert-danger form-control">{{ allErrors.keywords[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label>Meta Description  </label>
                                    <input type="text" class="form-control" v-model="description" placeholder=" Meta Description    ">
                                    <div v-if="allErrors.description" class="alert-danger form-control">{{ allErrors.description[0] }}</div>


                                </div>
                                <div class="col-md-12 m-b-20">
                                    <label> اللوجو   </label>
                                    <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Logo</span>
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
                        <!-- /.modal-dialog -->
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
            this.EditSetting();
        },
        data() {
            return {
                name: '',
                phone:'',
                keywords:'',
                description:'',
                facebook:'',
                twitter:'',
                instagram:'',
                email:'',
                allErrors:[],
                image: '',
                showImag:'',

            };
        },

        methods: {

            EditSetting($id){
                this.allErrors=[];
                axios.get('/admin/setting/1/edit').then(res => {
                    this.name=res.data[0].siteName
                    this.phone=res.data[0].phone
                    this.keywords=res.data[0].keywords
                    this.description=res.data[0].description
                    this.facebook=res.data[0].facebook
                    this.twitter=res.data[0].twitter
                    this.instagram=res.data[0].instagram
                    this.email=res.data[0].email
                    this.showImag=res.data[0].logo
                    this.id=res.data[0].id
                })
            },


            UpdateSetting($id) {
                let self = this;
                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('image', this.image);
                formData.append('phone', this.phone);
                formData.append('keywords', this.keywords);
                formData.append('description', this.description);
                formData.append('facebook', this.facebook);
                formData.append('twitter', this.twitter);
                formData.append('instagram', this.instagram);
                formData.append('email', this.email);
                formData.append('_method',"PUT")
                axios.post('/admin/setting/1', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(res){
                      self.EditSetting();
                        self.$swal({
                            text:'تم التعديل بنجاح   !!!',
                            icon: "success",
                        });
                    }).catch(function(error){

                    self.allErrors = error.response.data.errors
                    console.log(self.allErrors)
                });
            },
            UploadImage(e){
                this.image = e.target.files[0];
            },
        },

    }


</script>
