<template>

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
                            <h4 class="card-title">    الموصلين   </h4>
                            <h6 class="card-subtitle">رؤية جميع الموصلين  </h6>

                                <table class="table table-striped table-bordered" id="">
                                <thead>
                                <tr>
                                    <th>  اسم الموصل  </th>
                                    <th>    رقم الفون  </th>
                                    <th>  مشاهده الطلبات وتفاصيلها  </th>




                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in delivery">

                                    <td :id="item.id"> {{item.name || ''}}</td>
                                    <td>

                                        {{item.phone || ''}}

                                    </td>


                                    <td style="width: 20%">
                                        <router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 float-right" :to="{ name: 'deliveries',params: { id: item.id }}"> <i class="fa fa-eye-slash"></i> </router-link>

                                         </td>

                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>  اسم الموصل  </th>
                                    <th>   رقم الفون  </th>
                                    <th>  مشاهده الطلبات وتفاصيلها  </th>
                                </tr>
                                </tfoot>
                            </table>


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



</template>
<script>
    export default {

        mounted() {
            this.GetDelivery();
        },
        data() {
            return {
                delivery:{},

            }
        },
        methods: {
            GetDelivery(){
                axios.get('admin/delivery/show').then(res => {
                   this.delivery=res.data
                })
            },

        },

    }
</script>
