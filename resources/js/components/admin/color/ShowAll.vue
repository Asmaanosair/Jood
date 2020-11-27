
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
                            data-toggle="modal" data-target="#add-contact" >إضافة الوان جديده</button>
                    <!-- Add Contact Popup Model -->
                    <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">إضافة الوان جديده  </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                </div>

                                <form class="form-horizontal form-material" @submit.prevent="AddColor" enctype="multipart/form-data">
                                <div class="modal-body">

                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="color"  id="name" placeholder="الاسم ">
                                                <div v-if="allErrors.color" class="alert-danger form-control">{{ allErrors.color[0] }}</div>



                                            </div>

                                        </div>
                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="color" class="form-control" v-model="code"   placeholder="الوان ">
                                                <div v-if="allErrors.code" class="alert-danger form-control">{{ allErrors.code[0] }}</div>



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

                    <h4 class="card-title">الالوان</h4>
                    <h6 class="card-subtitle">رؤية جميع الالوان</h6>
                    <table class="table table-striped table-bordered" id="zero_config">
                        <thead>
                        <tr>
                            <th> الالوان </th>
                            <th> الالوان </th>
                            <th>تعديل </th>
                            <th>حذف  </th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="color in colors">

                            <td> {{color.color || ''}}</td>
                            <td>
                                <div v-bind:style="{ backgroundColor: color.code, width: 50 + 'px',height: 50 + 'px' }"></div>
                            </td>

                            <td>
                                <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                        data-toggle="modal" data-target="#edit-contact" @click="EditColor(color.id)"> <i class="fa fa-edit"></i>  </button>
                                <!-- Add Contact Popup Model -->
                            </td>

                            <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteColor(color.id)"> <i class="fa fa-trash"></i>  </button></td>

                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> الالوان </th>
                            <th> الالوان </th>
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

                                <form class="form-horizontal form-material" @submit.prevent="UpdateColor(id)"  enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="text" class="form-control" v-model="color" placeholder="الاسم ">
                                                <div v-if="allErrors.color" class="alert-danger form-control">{{ allErrors.color[0] }}</div>


                                            </div>

                                        </div>
                                        <div class="form-group">

                                            <div class="col-md-12 m-b-20">
                                                <input type="color" class="form-control" v-model="code" placeholder="الاسم ">
                                                <div v-if="allErrors.code" class="alert-danger form-control">{{ allErrors.code[0] }}</div>


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
            this.GetColors();
        },
        data() {
            return {
                colors:{},
                code: '',
                color: '',
                id: '',
                allErrors:[],
            };
        },

        methods: {
            GetColors(){
                axios.get('/admin/color').then(res => {
                     this.colors=res.data[0]
                })
            },
            EditColor($id){
                this.allErrors=[];
                axios.get('/admin/color/'+$id+'/edit').then(res => {
                    this.code=res.data[0].code
                    this.color=res.data[0].color
                    this.id=res.data[0].id
                })

            },
            AddColor() {
                let self = this;
                let formData = new FormData();
                formData.append('code', this.code);
                formData.append('color', this.color);
                console.log(formData)
                axios.post('/admin/color', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(){
                        self.allErrors=[]
                        self.GetColors();
                        self.$swal({
                            text:'تم الاضافه بنجاح   !!!',
                            icon: "success",
                        });
                }).catch(function (error) {
                        self.allErrors = error.response.data.errors

                }

                )

            },
            DeleteColor($id){
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                    CancelButtonText:  'الغاء'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/admin/color/'+$id).then(res => {
                            this.GetColors()

                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },
            UpdateColor($id) {
                let self = this;
                let formData = new FormData();
                formData.append('code', this.code);
                formData.append('color', this.color);
                formData.append('_method',"PUT")
                axios.post('/admin/color/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(res){
                      self.GetColors();
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
