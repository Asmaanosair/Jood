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
                                    data-toggle="modal" data-target="#add-contact" >إضافة منتج  جديد </button>
                            <!-- Add Contact Popup Model -->
                            <div id="add-contact"  class="modal fade in" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">إضافة منتج   جديد </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                        </div>

                                        <form class="form-horizontal form-material" @submit.prevent="AddProduct(id)" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div  class="form-group">
                                                    <div class="col-md-12 m-b-20">
                                                        <div class="form-group mb-4">
                                                            <label for="exampleFormntrolSelect1"> اختر القسم   </label>
                                                            <select class="form-control"  v-model="subId" @change="GetAllProduct()">

                                                                <option  v-for="sub in subCategories" :value="sub.id">{{sub.name}}</option>

                                                            </select>
                                                            <div v-if="allErrors.sub" class="alert-danger form-control">{{ allErrors.sub[0] }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div  class="form-group" v-show="show">
                                                    <div class="col-md-12 m-b-20">
                                                        <div class="form-group mb-4">
                                                            <label for="exampleFormntrolSelect1"> اختر المنتج  </label>
                                                            <select class="form-control"  v-model="productId">

                                                                <option  v-for="product in products" :value="product.id">{{product.product}}</option>

                                                            </select>
                                                            <div v-if="allErrors.productId" class="alert-danger form-control">{{ allErrors.productId[0] }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>الكميه او العدد</label>
                                                    <div class="col-md-12 m-b-20">
                                                        <input type="text" class="form-control" v-model="amount"  placeholder=" الكميه او العدد   ">
                                                        <div v-if="allErrors.amount" class="alert-danger form-control">{{ allErrors.amount[0] }}</div>
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

                            <h4 class="card-title"> المنتجات لمتجر {{branch.branch}} </h4>
                            <h6 class="card-subtitle">رؤية جميع المنتجات  لمتجر {{branch.branch}} </h6>
                            <table class="table table-striped table-bordered" id="zero_config">
                                <thead>
                                <tr>
                                    <th>  المنتجات  </th>
                                    <th> الكميه او العدد  </th>
                                    <th>حذف  </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in productsBranch">
                                    <td> {{item.product}}</td>
                                    <td>
                                        {{item.pivot.amount}}
                                    </td>
                                    <td class="center"> <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteProduct(item.id)"> <i class="fa fa-trash"></i>  </button></td>

                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>  المنتجات  </th>
                                    <th> الكميه او العدد  </th>
                                    <th>حذف  </th>

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

    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</template>
<script>

export default {
    mounted() {

        this.GetProducts(this.$route.params.id);
        this.id=this.$route.params.id;
    },
    data() {
        return {
            productsBranch:{},
            subCategories:{},
            products:{},
            amount: '',
            productId: '',
            id: '',
            allErrors:[],
            branch:'',
            subId:'',
            show:false,


        };
    },

    methods: {
        GetProducts($id){
            axios.get('/admin/branchProduct/'+$id).then(res => {
                this.productsBranch=res.data.productsBranch
                this.subCategories=res.data.subCategories
                this.branch=res.data.branch
            })
        },
        AddProduct($id) {
            let self = this;
            let formData = new FormData();
            formData.append('id', $id);
            formData.append('amount', this.amount);
            formData.append('productId', this.productId);
            axios.post('/admin/branchProduct/', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.GetProducts($id);
                    self.$swal({
                        text:'تم الاضافه بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                }

            )
        },
        GetAllProduct() {
            axios.get('/admin/sub_category/'+this.subId)
            .then(res => {
                this.show=true
                this.products=res.data


            })


        },
        DeleteProduct($id) {
            this.$swal({
                text: "هل انت متاكد من الحذف",
                showCancelButton: true,
                confirmButtonText: 'نعم !',
            }).then((result) => {
                if (result.value) {
                    axios.get('/admin/deleteProduct/' +this.id+'_'+ $id).then(res => {
                        this.GetProducts(this.id)
                    })
                    this.$swal(
                        'تم الحذف بنجاح ',
                    )
                }
            });

        },

    },

}
</script>
