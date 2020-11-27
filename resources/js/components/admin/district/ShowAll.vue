
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
                            data-toggle="modal" data-target="#add-contact" >إضافة حى  جديد</button>
                    <!-- Add Contact Popup Model -->
                    <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">إضافة حى جديد  </h4>
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


                                                <div class="form-group mb-4">
                                                    <label for="exampleFormControlSelect1"> اختر المدينه</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="cityId">
                                                        <option  v-for="city in cities" :value="city.id">{{city .city}}</option>
                                                    </select>
                                                </div>
                                                <div v-if="allErrors.cityId" class="alert-danger form-control">{{ allErrors.cityId[0] }}</div>
                                                <div class="form-group mb-4">
                                                    <label for="exampleFormControlSelect1"> اختر المتجر التابع له </label>
                                                    <select class="form-control"  v-model="branchId">
                                                        <option  v-for="branch in branches" :value="branch.id">{{branch .branch}}</option>
                                                    </select>
                                                </div>
                                                <div v-if="allErrors.branchId" class="alert-danger form-control">{{ allErrors.branchId[0] }}</div>

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

                    <h4 class="card-title">الاحياء </h4>
                    <h6 class="card-subtitle">رؤية جميع الاحياء</h6>
                    <table class="table table-striped table-bordered" id="zero_config">
                        <thead>
                        <tr>
                            <th> الاحياء</th>
                            <th>المدن</th>
                            <th>المتجر التابع له </th>
                            <th>  الحاله </th>
                            <th>تعديل </th>
                            <th>حذف  </th>

                        </tr>
                        </thead>
                        <tbody>



                        <tr v-for="district in districts">

                            <td> {{district.name || ''}}</td>
                            <td>

                                {{district.city || ''}}

                            </td>
                            <td>

                                {{district.branch || ''}}

                            </td>
                            <td>

                                <span v-if="district.availability==1" v-on:click="ChangeAvailability(district.id)" class="btn btn-success   m-t-10 mb-2"
                                >   متاح     </span>
                                <span v-else-if="district.availability==0"  class="btn btn-danger  m-t-10 mb-2" v-on:click="ChangeAvailability(district.id)"
                                >   غير  متاح    </span>


                            </td>

                            <td>
                                <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                        data-toggle="modal" data-target="#edit-contact" @click="EditDistrict(district.id)"> <i class="fa fa-edit"></i>  </button>
                                <!-- Add Contact Popup Model -->
                            </td>

                            <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteDistrict(district.id)">  <i class="fa fa-trash"></i>  </button></td>

                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> الاحياء</th>
                            <th>المدن</th>
                            <th>المتجر التابع له </th>
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
                                        <div class="form-group">
                                            <div class="col-md-12 m-b-20">
                                            <div class="form-group mb-4">
                                                <label for="exampleFormControlSelect1"> اختر المدينه</label>
                                                <select class="form-control" id="exampleFormControlSelect" v-model="cityId">

                                                    <option  v-for="city in cities" :value="city.id">{{city .city}}</option>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="exampleFormControlSelect1"> اختر المتجر التابع له </label>
                                            <select class="form-control"  v-model="branchId">
                                                <option  v-for="branch in branches" :value="branch.id">{{branch .branch}}</option>
                                            </select>
                                        </div>
                                        <div v-if="allErrors.branchId" class="alert-danger form-control">{{ allErrors.branchId[0] }}</div>

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
                cities:{},
                name: '',
                cityId: '',
                image: '',
                branches:{},
                address: '',
                latitude: '',
                longitude: '',
                id: '',
                branchId:'',
                allErrors:[],
                allStatus:['    غير متاح  ',
                    '     متاح ',
                ],
                availability:0,

            };
        },
        methods: {
            GetDistricts(){
                axios.get('/admin/district').then(res => {
                    this.cities=res.data.cities
                    this.districts=res.data.districts
                    this.branches=res.data.branches

                })

            },
            EditDistrict($id){
                axios.get('/admin/district/'+$id+'/edit').then(res => {
                    this.name=res.data[0].name
                    this.id=res.data[0].id
                    this.cityId=res.data[0].city_id
                    this.branchId=res.data[0].branch_id
                    this.latitude=res.data[0].lat
                    this.longitude=res.data[0].long
                    this.availability=res.data[0].availability
                })

            },
            AddDistricts() {
                let self = this;
                let formData = new FormData();
                formData.append('cityId',this.cityId);
                formData.append('name', this.name);
                formData.append('branchId', this.branchId);
                formData.append('latitude', this.latitude);
                formData.append('longitude', this.longitude);
                formData.append('availability', this.availability);
                axios.post('/admin/district', formData)
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
                        axios.delete('/admin/district/'+$id).then(res => {
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
                formData.append('cityId',this.cityId);
                formData.append('name', this.name);
                formData.append('branchId', this.branchId);
                formData.append('latitude', this.latitude);
                formData.append('longitude', this.longitude);
                formData.append('availability', this.availability);
                formData.append('_method',"PUT")
                axios.post('/admin/district/'+$id, formData)
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
                axios.get('/admin/district/'+$id+'/availability')
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
