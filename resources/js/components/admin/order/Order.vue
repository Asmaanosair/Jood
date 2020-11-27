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


                    <h4 class="card-title">الطلبات  </h4>
                    <h6 class="card-subtitle">رؤية جميع الطلبات</h6>
                    <table class="table table-striped table-bordered" id="zero_config">
                        <thead>
                        <tr>
                            <th>  اسم العميل  </th>
                            <th>  العنوان   </th>

                            <th> حالة الطلب   </th>
                            <th>تعديل </th>
                            <th>مشاهدة الطلب   </th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr v-for="order in allOrders">

                            <td> {{order.name || ''}}</td>
                            <td>

                                {{order.address || ''}}

                            </td>

                            <td>
                                <span v-if="order.status==0" class="btn btn-orange  m-t-10 mb-2"
                                > طلب جديد  </span>
                                <span v-else-if="order.status==1" class="btn btn-success  m-t-10 mb-2"
                                >  تم قبول الطلب   </span>
                                <span v-else-if="order.status==2" class="btn btn-danger  m-t-10 mb-2"
                                >  تم الغاء الطلب   </span>
                                <span v-else class="btn btn-default  m-t-10 mb-2"
                                >  تم الانتهاء من الطلب    </span>

                            </td>

                            <td>
                                <button type="button" class="btn btn-success  m-t-10 mb-2 float-right"
                                        data-toggle="modal" data-target="#edit-contact" @click="EditOrder(order.id)"> <i class="fa fa-edit"></i>  </button>
                                <!-- Add Contact Popup Model -->
                            </td>

                            <td class="center">
                                <router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 float-right" :to="{ name: 'orderDetails',params: { id: order.id }}"> <i class="fa fa-eye-slash"></i> </router-link>
                            </td>

                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>  اسم العميل  </th>
                            <th>  العنوان   </th>

                            <th> حالة الطلب   </th>
                            <th>تعديل </th>
                            <th>مشاهدة الطلب   </th>
                        </tr>
                        </tfoot>
                    </table>

                    <div id="edit-contact"  class="modal fade in" tabindex="-1" role="dialog"
                         aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" >  تعديل حالة الطلب    </h4>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-hidden="true">×</button>
                                </div>

                                <form class="form-horizontal form-material" @submit.prevent="UpdateOrder(id)"  enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
<!--                                            <div class="col-md-12 m-b-20">-->
<!--                                                <input type="text" class="form-control" v-model="note" placeholder="ملحوظه  ">-->
<!--                                            </div>-->
                                            <div class="col-md-12 m-b-20">
                                                <div class="form-group mb-4">
                                                    <label for="exampleFormControlSelect1"> اختر الحاله </label>
                                                    <select class="form-control" id="exampleFormControlSelect" v-model="status">

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
        </div>

</template>
<script>
export default {
    mounted() {

        this.GetOrders();

    },
    data() {
        return {
            allOrders:{},
            note:'',
            allStatus:['  طلب جديد ',
                '  قبول الطلب',
                ' الغاء الطلب '
                ,'تم الانتهاء'],
            status:'',
            order:'',
            id:'',
        };
    },
    methods: {
        GetOrders(){
            axios.get('/admin/order').then(res => {
                this.allOrders=res.data
                console.log(this.allOrders)
            })
        }
        ,
        EditOrder($id){
            axios.get('admin/order/'+$id+'/edit').then(res => {
                this.note=res.data[0].note
                this.status=res.data[0].status
                this.id=res.data[0].id

            })

        },
        ShowOrder($id){
            axios.get('admin/order/'+$id+'/edit').then(res => {
                this.order=res.data[0]

            })

        },
        UpdateOrder($id) {
            let self = this;
            let formData = new FormData();
            formData.append('note',this.note);
            formData.append('status', this.status);
            formData.append('_method',"PUT")
            axios.post('admin/order/'+$id, formData)
                .then(function(res){
                    self.GetOrders();
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });

                })
        },


    },
}

</script>
