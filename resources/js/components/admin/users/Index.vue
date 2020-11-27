
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
                                data-toggle="modal" data-target="#add-contact" >إضافة  مستخدم  </button>
                        <!-- Add Contact Popup Model -->
                        <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">إضافة مستخدم  </h4>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">×</button>
                                    </div>

                                    <form class="form-horizontal form-material" @submit.prevent="AddUser" enctype="multipart/form-data">
                                        <div class="modal-body">

                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="phone" placeholder="رقم الفون  ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>
                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="email" class="form-control" v-model="email" placeholder=" الايميل   ">
                                                    <div v-if="allErrors.email" class="alert-danger form-control">{{ allErrors.email[0] }}</div>
                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="password" class="form-control" v-model="password" placeholder=" كلمة المرور   ">
                                                    <div v-if="allErrors.password" class="alert-danger form-control">{{ allErrors.password[0] }}</div>
                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label for="exampleFormControlSele">  الصلاحيات</label>
                                                        <select class="form-control" id="exampleFormControlSele" v-model="role">

                                                            <option  v-for="(item,index) in permissions" :value="index">{{item}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label > اختر الحاله </label>
                                                        <select class="form-control"  v-model="activity">

                                                            <option  v-for="(item,index) in status" :value="index">{{item}}</option>
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

                        <h4 class="card-title"> المستخدمين   </h4>
                        <h6 class="card-subtitle">رؤية جميع المستخدمين </h6>
                        <table class="table table-striped table-bordered" id="zero_config">
                            <thead>
                            <tr>
                                <th> البيانات  </th>
                                <th>  الصلاحية </th>
                                <th>  الحاله  </th>
                                <th>تعديل </th>
                                <th>حذف  </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users">

                                <td>
                                    <li>{{user.name }}</li>
                                    <li>{{user.phone }}</li>
                                    <li>{{user.email }}</li>
                                </td>
                                <td>

                                    <span v-for="(item,index) in permissions">
                                    <h5 v-if="user.role==index" style="color: blue">{{item}}</h5>
                                        <h5 v-else ></h5>
                                    </span>

                                </td>
                                <td>
                                    <h5 v-if="user.status==0" style="color: red">غير مفعل </h5>
                                    <h5 v-else style="color: green"> مفعل </h5>
                                </td>


                                <td>
                                    <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                            data-toggle="modal" data-target="#edit-contact" @click="EditUser(user.id)"> <i class="fa fa-edit"></i>  </button>
                                    <!-- Add Contact Popup Model -->
                                </td>

                                <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteUser(user.id)">  <i class="fa fa-trash"></i>  </button></td>

                            </tr>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th> البيانات  </th>
                                <th>  الصلاحية </th>
                                <th>  الحاله  </th>
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

                                    <form class="form-horizontal form-material" @submit.prevent="UpdateUser(id)"  enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">

                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="name" placeholder="الاسم ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>


                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="text" class="form-control" v-model="phone" placeholder="رقم الفون  ">
                                                    <div v-if="allErrors.name" class="alert-danger form-control">{{ allErrors.name[0] }}</div>
                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <input type="email" class="form-control" v-model="email" placeholder=" الايميل   ">
                                                    <div v-if="allErrors.email" class="alert-danger form-control">{{ allErrors.email[0] }}</div>
                                                </div>

                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label for="">  الصلاحيات</label>
                                                        <select class="form-control" id="" v-model="role">

                                                            <option  v-for="(item,index) in permissions" :value="index">{{item}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 m-b-20">
                                                    <div class="form-group mb-4">
                                                        <label > اختر الحاله </label>
                                                        <select class="form-control"  v-model="activity">

                                                            <option  v-for="(item,index) in status" :value="index">{{item}}</option>
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
        this.GetUsers();
    },
    data() {
        return {
            users:{},
            name: '',
            phone: '',
            email: '',
            password:'',
            id: '',
            role: 0,
            activity:1,
            status:['غير مفعل ','مفعل' ],
            permissions:['مدير النظام' ,' مجهز طلبات ','حسابات','موصل' ],
            allErrors:[],
        };
    },
    methods: {
        GetUsers(){
            axios.get('/admin/user').then(res => {
                this.users=res.data

            })
        },
        EditUser($id){
            axios.get('/admin/user/'+$id+'/edit').then(res => {
                this.name=res.data.name
                this.role=res.data.role
                this.activity=res.data.status
                this.email=res.data.email
                this.phone=res.data.phone
                this.id=res.data.id

            })
        },
        AddUser() {
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('role', this.role);
            formData.append('password', this.password);
            formData.append('activity', this.activity);
            formData.append('email', this.email);
            formData.append('phone', this.phone);
            axios.post('/admin/user', formData)
                .then(function(){
                    self.GetUsers();
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
        DeleteUser($id){
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
                CancelButtonText:  'الغاء'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/admin/user/'+$id).then(res => {
                        this.GetUsers()
                    })
                    this.$swal(
                        'تم الحذف بنجاح ',
                    )
                }
            });

        },
        UpdateUser($id) {
            let self = this;
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('role', this.role);
            formData.append('password', this.password);
            formData.append('activity', this.activity);
            formData.append('email', this.email);
            formData.append('phone', this.phone);
            formData.append('_method',"PUT")
            axios.post('/admin/user/'+$id, formData)
                .then(function(res){
                    self.GetUsers();
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
