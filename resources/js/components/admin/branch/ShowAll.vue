
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
                                data-toggle="modal" data-target="#add-contact" >إضافة متجر  جديد</button>
                        <!-- Add Contact Popup Model -->
                        <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">إضافة متجر جديد  </h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                    </div>

                                    <form class="form-horizontal form-material" @submit.prevent="AddDistricts" enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="address" placeholder="العنوان ">
                                                    <div v-if="allErrors.address" class="alert-danger form-control">{{ allErrors.address[0] }}</div>

                                                </div>
                                                <div class="col-md-12 m-b-20">

                                                    <div class="form-group">
                                                        <label>Latitude</label>

                                                        <div class="col-md-12 m-b-20">
                                                            <input type="text" class="form-control" v-model="latitude"  placeholder=" Latitude   ">
                                                            <div v-if="allErrors.latitude" class="alert-danger form-control">{{ allErrors.latitude[0] }}</div>

                                                        </div>


                                                    </div>
                                                    <div class="form-group">
                                                        <label>Longitude</label>
                                                        <div class="col-md-12 m-b-20">
                                                            <input type="text" class="form-control" v-model="longitude"  placeholder=" Longitude   ">
                                                            <div v-if="allErrors.longitude" class="alert-danger form-control">{{ allErrors.longitude[0] }}</div>



                                                        </div>


                                                    </div>
                                                    <div  class="form-group">
                                                        <div class="col-md-12 m-b-20">
                                                            <div class="form-group mb-4">
                                                                <label for="exampleFormControlSelect1"> اختر الحاله </label>
                                                                <select class="form-control"  v-model="availability">

                                                                    <option  v-for="(test,index) in allStatus" :value="index">{{test}}</option>

                                                                </select>
                                                            </div>
                                                        </div>
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

                        <h4 class="card-title">المتاجر </h4>
                        <h6 class="card-subtitle">رؤية جميع المتاجر</h6>
                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th> المتاجر</th>
                                <th>العنوان</th>
                                <th>المنتجات التابع له </th>
                                <th>  الحاله </th>
                                <th>تعديل </th>
                                <th>حذف  </th>

                            </tr>
                            </thead>
                            <tbody>



                            <tr v-for="branch in branches">

                                <td> {{branch.branch || ''}}</td>
                                <td>

                                    {{branch.address || ''}}

                                </td>
                                <td>

                                    <router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 float-right" :to="{ name: 'BranchProduct',params: { id: branch.id }}"> <i class="fa fa-eye-slash"></i>  المنتجات</router-link>

                                </td>
                                <td>

                                <span v-if="branch.availability==1" v-on:click="ChangeAvailability(branch.id)" class="btn btn-success   m-t-10 mb-2"
                                >   متاح     </span>
                                    <span v-else-if="branch.availability==0"  class="btn btn-danger  m-t-10 mb-2" v-on:click="ChangeAvailability(branch.id)"
                                    >   غير  متاح    </span>


                                </td>

                                <td>
                                    <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                            data-toggle="modal" data-target="#edit-contact" @click="EditDistrict(branch.id)"> <i class="fa fa-edit"></i>  </button>
                                    <!-- Add Contact Popup Model -->
                                </td>

                                <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteDistrict(branch.id)">  <i class="fa fa-trash"></i>  </button></td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th> المتاجر</th>
                                <th>العنوان</th>
                                <th>المنتجات التابع له </th>
                                <th>  الحاله </th>
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

                                    <form class="form-horizontal form-material" @submit.prevent="UpdateDistrict(id)"  enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="address" placeholder="العنوان ">
                                                <div v-if="allErrors.address" class="alert-danger form-control">{{ allErrors.address[0] }}</div>

                                            </div>
                                            <div class="form-group">
                                                <label>Latitude</label>

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="latitude"  placeholder=" Latitude   ">
                                                    <div v-if="allErrors.latitude" class="alert-danger form-control">{{ allErrors.latitude[0] }}</div>

                                                </div>


                                            </div>
                                            <div class="form-group">
                                                <label>Longitude</label>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="longitude"  placeholder=" Longitude   ">
                                                    <div v-if="allErrors.longitude" class="alert-danger form-control">{{ allErrors.longitude[0] }}</div>



                                                </div>


                                            </div>
                                            <div  class="form-group">
                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label for="exampleFormControlSelect1"> اختر الحاله </label>
                                                        <select class="form-control"  v-model="availability">

                                                            <option  v-for="(test,index) in allStatus" :value="index">{{test}}</option>

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

    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</template>
<script>
export default {
    mounted() {
        this.GetDistricts();

    },
    data() {
        return {
            districts:{},
            name: '',
            branches:{},
            address: '',
            latitude: '',
            longitude: '',
            allErrors:[],
            allStatus:['    غير متاح  ',
                '     متاح ',
            ],
            availability:0,

        };
    },
    methods: {
        GetDistricts(){
            axios.get('/admin/branch').then(res => {
                this.branches=res.data

            })

        },
        EditDistrict($id){
            axios.get('/admin/branch/'+$id+'/edit').then(res => {
                this.name=res.data.branch
                this.address=res.data.address
                this.id=res.data.id
                this.latitude=res.data.lat
                this.longitude=res.data.long
                this.availability=res.data.availability
            })

        },
        AddDistricts() {
            let self = this;
            let formData = new FormData();
            formData.append('address',this.address);
            formData.append('name', this.name);
            formData.append('latitude', this.latitude);
            formData.append('longitude', this.longitude);
            formData.append('availability', this.availability);
            axios.post('/admin/branch', formData)
                .then(function(){
                    self.GetDistricts();
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
        DeleteDistrict($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/admin/branch/'+$id).then(res => {
                        this.GetDistricts()
                    })
                    this.$swal(
                        'تم الحذف بنجاح ',
                    )
                }
            });

        },
        UpdateDistrict($id) {
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('address', this.address);
            formData.append('latitude', this.latitude);
            formData.append('longitude', this.longitude);
            formData.append('availability', this.availability);
            formData.append('_method',"PUT")
            axios.post('/admin/branch/'+$id, formData)
                .then(function(res){
                    self.GetDistricts();
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });

                }).catch(function(error){
                self.allErrors = error.response.data.errors
            });
        },
        ChangeAvailability($id){
            let self = this;
            axios.get('/admin/branch/'+$id+'/availability')
                .then(function(res){
                    self.GetDistricts();
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function(error){

            });

        },
    },

}


</script>
