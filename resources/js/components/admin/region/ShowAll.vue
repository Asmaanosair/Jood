
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
                            data-toggle="modal" data-target="#add-contact" >إضافة منطقه جديده</button>
                    <!-- Add Contact Popup Model -->
                    <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">إضافة منطقه جديده  </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                </div>

                                <form class="form-horizontal form-material" @submit.prevent="AddRegions" enctype="multipart/form-data">
                                <div class="modal-body">

                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="name"  id="name" placeholder="الاسم ">
                                                <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>



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

                    <h4 class="card-title">المناطق</h4>
                    <h6 class="card-subtitle">رؤية جميع المناطق</h6>
                    <table class="table table-striped table-bordered" id="zero_config">
                        <thead>
                        <tr>
                            <th> المناطق</th>
                            <th>تعديل </th>
                            <th>حذف  </th>

                        </tr>
                        </thead>
                        <tbody>



                        <tr v-for="region in regions">

                            <td> {{region.name || ''}}</td>

                            <td>
                                <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                        data-toggle="modal" data-target="#edit-contact" @click="EditRegion(region.id)"> <i class="fa fa-edit"></i>  </button>
                                <!-- Add Contact Popup Model -->
                            </td>

                            <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteRegion(region.id)"> <i class="fa fa-trash"></i>  </button></td>

                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> المناطق</th>
                            <th>الصور</th>
                            <th>تعديل </th>

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

                                <form class="form-horizontal form-material" @submit.prevent="UpdateRegions(id)"  enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


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
            this.GetRegions();
        },
        data() {
            return {
                regions:{},
                name: '',
                id: '',
                editName:'',
                allErrors:[],
            };
        },

        methods: {
            GetRegions(){
                axios.get('admin/region').then(res => {
                    console.log(res.data[0])
                     this.regions=res.data[0]
                })
            },
            EditRegion($id){
                this.allErrors=[];
                axios.get('admin/region/'+$id+'/edit').then(res => {
                    this.name=res.data[0].name
                    this.id=res.data[0].id
                })

            },
            AddRegions() {
                let self = this;
                let formData = new FormData();
                formData.append('name', this.name);
                console.log(formData)
                axios.post('admin/region', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(){
                        self.allErrors=[]
                        self.GetRegions();
                        self.$swal({
                            text:'تم الاضافه بنجاح   !!!',
                            icon: "success",
                        });
                }).catch(function (error) {
                        self.allErrors = error.response.data.errors

                }

                )

            },
            DeleteRegion($id){
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                    CancelButtonText:  'الغاء'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('admin/region/'+$id).then(res => {
                            this.GetRegions()

                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },
            UpdateRegions($id) {
                let self = this;
                let formData = new FormData();
                formData.append('name', this.name);
                formData.append('_method',"PUT")
                axios.post('admin/region/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(res){
                      self.GetRegions();
                        self.$swal({
                            text:'تم التعديل بنجاح   !!!',
                            icon: "success",
                        });
                    }).catch(function(error){
                    self.allErrors = error.response.data.errors
                });
            },
        },

    }


</script>
