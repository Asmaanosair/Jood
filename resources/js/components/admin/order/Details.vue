<template>

    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid" id="invoicetable">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->



                    <div class="card card-body">
                        <div class="invoice-header d-flex align-items-center border-bottom pb-3">
                            <h3 class="font-medium text-uppercase mb-0">الفاتوره</h3>
                            <div class="ml-auto">
                                <h4 class="invoice-number"></h4>
                            </div>
                        </div>
                        <div class="" id="custom-invoice">
                            <!-- (1) -->
                            <div class="invoice-123" id="printableArea">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <div class="pull-left">
                                            <address>
                                                <h3>&nbsp;تفاصيل العميل ,</h3>
                                                <h4 class="mb-0 font-weight-bold">&nbsp;{{user.name}}  </h4>
                                                <div class="mb-2">
                                                    <span class="font-weight-bold ml-1">Invoice Id:</span><span class="invoice-number ml-2"></span>
                                                    <h6 class="text-muted font-medium">&nbsp;Email: {{user.email}}</h6>
                                                </div>
                                                <p class="text-muted ml-1">
                                                    {{order.address}}

                                                </p>
                                            </address>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive mt-5" style="clear: both;">
                                            <table class="table table-hover" id="zero_config">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>اسم المنتج </th>
                                                    <th>الحجم</th>
                                                    <th>اللون </th>
                                                    <th class="text-right">الكميه</th>
                                                    <th class="text-right">سعرالقطعه </th>
                                                    <th class="text-right">التكلفه </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="item in products">
                                                    <td class="text-center">{{item.id}}</td>
                                                    <td>{{item.product}}</td>
                                                    <td>{{item.size}}</td>
                                                    <td>{{item.color}}</td>
                                                    <td class="text-right">{{item.amount}} </td>
                                                    <td class="text-right"> {{item.price}} </td>
                                                    <td class="text-right"> {{item.price * item.amount}} </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="pull-right mt-4 text-right">
<!--                                            <p>Sub - Total amount: $13,848</p>-->
<!--                                            <p>vat (10%) : $138 </p>-->
                                            <hr>
                                            <h3><b>الحساب الكلى  :</b> {{order.total}}</h3>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <div class="text-right">
                                            <button class="btn btn-danger" type="submit">{{payment.name}} </button>
<!--                                            <button class="btn btn-default print-page" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>-->
                                        </div>
                                    </div>
                                </div>
                            </div>  <!-- ./(1) -->

                        </div>
                    </div>


            <!-- ./Right Part -->



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
        this.GetDelivery(this.$route.params.id);
    },
    data() {
        return {
            products:{},
            order:{},
            user:{},
            payment:{}

        }
    },
    methods: {
        GetDelivery($id){
                axios.get('admin/orders_details/'+$id).then(res => {
                this.products = res.data.products
                this.order = res.data.order
                this.user = res.data.user
                this.payment = res.data.payment
                    console.log(this.products);

            })
        },
        printInvoice(){
            // var newWindow = window.open();
            // newWindow.document.write(document.getElementById("invoicetable").innerHTML);
            // //newWindow.print();
            window.print()

        }

    },

}
</script>
