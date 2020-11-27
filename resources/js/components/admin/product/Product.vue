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
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">اسم المنتج </h3>
                            <h6 class="card-subtitle">{{product.product}}</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="white-box text-center"> <img :src="product.image" class="img-fluid"> </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-6">
                                    <h4 class="box-title mt-5">وصف المنتج </h4>
                                    <p>{{product.description}}</p>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="box-title mt-5">General Info</h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td width="390">الفيديو </td>
                                                <td> <video width="400" controls>

                                                    <source :src="product.video" type="video/mp4">
                                                    <source :src="product.video" type="video/ogg">
                                                </video> </td>
                                            </tr>
                                            <tr>
                                                <td width="390">السعر</td>
                                                <td> {{product.price}} </td>
                                            </tr>
                                            <tr>
                                                <td width="390">القسم </td>
                                                <td> {{sub_category.name}} </td>
                                            </tr>
                                            <tr>
                                                <td width="390">السعر فى الخصم </td>
                                                <td> {{product.price_sale}} </td>
                                            </tr>
                                            <tr>
                                                <td width="390">  الخصم </td>
                                                <td>    <button type="button" class="btn btn-danger  m-t-10 mb-2 " v-if="product.sale==0">  <i class="fa fa-share"></i> الخصم غير مفعل  </button>
                                                    <button type="button" class="btn btn-success  m-t-10 mb-2 " v-else>  <i class="fa fa-share"></i> الخصم  مفعل  </button> </td>
                                            </tr>
                                            <tr>
                                                <td width="390">  الالوان  </td>
                                                <td>

                                                        <div class="col-lg-3 " style="float: left" v-for="color in product.color"><div :src="color.color" v-bind:style="{ backgroundColor: color.code, width: 50 + 'px',height: 50 + 'px' }" alt="user" class="img-fluid rounded"></div>
                                                            <span> {{color.color}} </span></div>


                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="390">  الاحجام  </td>
                                                <td>

                                                    <div class="col-lg-3 " style="float: left" v-for="size in product.size">
                                                        <span> {{size.size}} </span></div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="390">  الصور   </td>
                                                <td>
                                                    <div class="col-lg-3 col-md-6 mb-3" style="float: left" v-for="attach in product.product_images"><img :src="attach.image" alt="user" class="img-fluid rounded">
                                                        </div>
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>

        </div>


    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->


</template>
<script>

export default {
    name:"productDetails",
    mounted() {
         this.GetProduct(this.$route.params.id);
    },
    data() {
        return {
            product:{},
            sub_category:{}
        };
    },

    methods: {
        GetProduct($id){
            axios.get('admin/product/'+$id).then(res => {
                this.product=res.data
                this.sub_category=res.data.sub_category
            })
        },
    },

}


</script>
