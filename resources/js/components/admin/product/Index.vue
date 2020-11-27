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
                            <router-link  type="button" class="btn btn-info btn-rounded m-t-10 mb-2 float-right" :to="{ name: 'createProduct'}">اضافه المنتج </router-link>
                            <h4 class="card-title"> المنتجات  </h4>
                            <h6 class="card-subtitle">رؤية جميع المنتجات  </h6>

                                <table class="table table-striped table-bordered" id="zero_config">
                                <thead>
                                <tr>
                                    <th>  المنتجات</th>
                                    <th> الاقسام الفرعية</th>
                                    <th>  التفاصيل </th>

                                    <th>  Actions</th>


                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="product in products">

                                    <td :id="product.id"> {{product.product || ''}}</td>
                                    <td>

                                        {{product.sub_category.name || ''}}

                                    </td>
                                    <td>
                                <span class="btn btn-orange  m-t-10 mb-2" @click="GetImages(product.id)"  data-toggle="modal" data-target="#add-images"
                                >   الصور  </span>
                                        <span class="btn btn-success m-t-10 mb-2" @click="GetColors(product.id)"  data-toggle="modal" data-target="#add-color"
                                        >   الالوان  </span>

                                        <span class="btn btn-danger  m-t-10 mb-2"   @click="GetSizes(product.id)"  data-toggle="modal" data-target="#add-size"
                                        >     الاحجام   </span>
                                        <span  class="btn btn-light-warning  m-t-10 mb-2" @click="GetSale(product.id)"  data-toggle="modal" data-target="#add-sale"
                                        >       الخصم     </span>
                                    </td>

                                    <td style="width: 20%">
                                        <router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 float-right" :to="{ name: 'ProductDetails',params: { id: product.id }}"> <i class="fa fa-eye-slash"></i> </router-link>
                                        <router-link  type="button" class="btn btn-success   m-l-10  m-t-10 mb-2 float-right" :to="{ name: 'EditProduct',params: { id: product.id }}"> <i class="fa fa-edit"></i> </router-link>


                                        <button type="button" class="btn btn-danger   m-l-10  m-t-10 mb-2 float-right" @click="DeleteProduct(product.id)">  <i class="fa fa-trash"></i>  </button></td>
                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>  المنتجات</th>
                                    <th> الاقسام الفرعية</th>
                                    <th> الصوره</th>
                                    <th> Actions </th>
                                </tr>
                                </tfoot>
                            </table>
                            <div id="add-images"  class="modal fade in" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" >إضافة صور جديده  </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                        </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 mb-3" v-for="attach in ProductImages"><img :src="attach.image" alt="user" class="img-fluid rounded">
                                                        <button type="button" class="btn btn-danger  m-t-10 mb-2 float-right" @click="DeleteImage(attach.id)">  <i class="fa fa-trash"></i>  </button></div>

                                                </div>
                                                <form class="form-horizontal form-material" @submit.prevent="AddImages(id)" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label>تحميل صور المنتج </label>

                                                    <div class="col-md-12 m-b-20">
                                                        <input type="file" class="form-control"   @change="UploadImages" >
                                                        <div v-if="allErrors.images" class="alert-danger form-control">{{ allErrors.images[0] }}</div>


                                                    </div>

                                                </div>
                                                    <button type="submit" class="btn btn-info waves-effect"
                                                    >Save</button>
                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect"
                                                        data-dismiss="modal">Cancel</button>
                                            </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <div id="add-color"  class="modal fade in" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">إضافة الوان  جديده  </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                        </div>


                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 mb-3" v-for="color in productColors"><div :src="color.color" v-bind:style="{ backgroundColor: color.code, width: 50 + 'px',height: 50 + 'px' }" alt="user" class="img-fluid rounded"></div>
                                                        <button type="button" class="btn btn-danger  m-t-10 mb-2 " @click="DeleteColor(color.id)">  <i class="fa fa-trash"></i>  </button></div>

                                                </div>
                                                <form class="form-horizontal form-material" @submit.prevent="AddColor(id)"enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-12 m-b-20">
                                                        <label >  اختر الالوان</label>
                                                        <div class="form-check form-check-inline"  v-for="item in colors">
                                                            <input class="form-check-input material-inputs" :id="item.color" type="checkbox" :value="item.id"
                                                                   v-model="checkedColor" >
                                                            <label class="form-check-label" :for="item.color">{{item.color}}</label>
                                                            <div v-if="allErrors.checkedColor" class="alert-danger form-control">{{ allErrors.checkedColor[0] }}</div>
                                                        </div>
                                                    </div>

                                                </div>

                                                    <button type="submit" class="btn btn-info waves-effect"
                                                    >Save</button>
                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect"
                                                        data-dismiss="modal">Cancel</button>

                                            </div>



                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <div id="add-size"  class="modal fade in" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabe">إضافة حجم    </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                        </div>


                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 mb-3" v-for="size in productSizes"><div><h4>{{size.size}}</h4></div>

                                                        <button type="button" class="btn btn-danger  m-t-10 mb-2 " @click="DeleteSize(size.id)">  <i class="fa fa-trash"></i>  </button></div>

                                                </div>
                                                <form class="form-horizontal form-material" @submit.prevent="AddSize(id)"enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-12 m-b-20">
                                                        <label >  اختر الحجم</label>
                                                        <div class="form-check form-check-inline"  v-for="item in sizes">
                                                            <input class="form-check-input material-inputs" :id="item.size" type="checkbox" :value="item.id"
                                                                   v-model="checkedSize" >
                                                            <label class="form-check-label" :for="item.size">{{item.size}}</label>
                                                            <div v-if="allErrors.checkedSize" class="alert-danger form-control">{{ allErrors.checkedSize[0] }}</div>
                                                        </div>
                                                    </div>

                                                </div>

                                                    <button type="submit" class="btn btn-info waves-effect"
                                                    >Save</button>
                                                </form>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect"
                                                        data-dismiss="modal">Cancel</button>

                                            </div>



                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <div id="add-sale"  class="modal fade in" tabindex="-1" role="dialog"
                                 aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLab"> تعديل قيمه الخصم او اضافه الى الخصم    </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                        </div>


                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <button type="button" class="btn btn-danger  m-t-10 mb-2 " v-if="productSale.sale==0">  <i class="fa fa-share"></i> الخصم غير مفعل  </button>
                                                        <button type="button" class="btn btn-success  m-t-10 mb-2 " v-else>  <i class="fa fa-share"></i> الخصم  مفعل  </button>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 mb-3">
                                                        <div>  <h6>قيمه الخصم</h6>   {{productSale.price_sale}}  </div>

                                                    </div>

                                                </div>
                                                <form class="form-horizontal form-material" @submit.prevent="UpdateSale(productSale.id)"enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <div class="col-md-12 m-b-20">
                                                        <label for="exampleFormContolSelect1">  قيمه الخصم  </label>
                                                        <input type="text" class="form-control" v-model="price">
                                                        <div v-if="allErrors.price" class="alert-danger form-control">{{ allErrors.price[0] }}</div>


                                                    </div>

                                                </div>
                                                    <div  class="form-group">
                                                        <div class="col-md-12 m-b-20">
                                                            <div class="form-group mb-4">
                                                                <label for="exampleFormControlSelect1"> اختر الحاله </label>
                                                                <select class="form-control" id="exampleFormControlSelect" v-model="sale">

                                                                    <option  v-for="(test,index) in allStatus" :value="index">{{test}}</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-info waves-effect"
                                                    >Save</button>
                                                </form>
                                            </div>

                                            <div class="modal-footer">


                                                <button type="button" class="btn btn-default waves-effect"
                                                        data-dismiss="modal">Cancel</button>

                                            </div>

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



</template>
<script>
    export default {

        mounted() {
            this.GetProduct();
        },
        data() {
            return {
                products:{},
                productId:'',
                name: '',
                id: '',
                allErrors:[],
                image: '',
                images:'',
                ProductImages:'',
                productColors:{},
                color:'',
                colors:'',
                checkedColor:[],
                checkedSize:[],
                sizes:'',
                productSizes:{},
                productSale:'',
                price:'',
                saleSelect:'',
                allStatus:['    غير مفعل   ',
                    '     مفعل  ',
                ],
                sale:''
            }
        },
        methods: {
            GetProduct(){
                axios.get('admin/product').then(res => {
                   this.products=res.data.products
                   this.colors=res.data.colors
                   this.sizes=res.data.sizes
                })
            },
            DeleteProduct($id) {
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/admin/product/' + $id).then(res => {
                            this.GetProduct()
                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },
            GetImages($id){
                axios.get('admin/productImages/'+$id).then(res => {
                    this.id=$id
                    this.ProductImages=res.data
                })
            },
            UploadImages(e){
                this.images=e.target.files[0]
            },
            AddImages($id){
                let self = this;
                let formData = new FormData();
                formData.append('id', $id);
                formData.append('images',this.images);

                axios.post('admin/productImages', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(){
                        self.allErrors=[]
                        self.GetImages($id);
                        self.$swal({
                            text:'تم الاضافه بنجاح   !!!',
                            icon: "success",
                        });
                    }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                    }
               )
            },
            DeleteImage($id) {
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/admin/productImages/' + $id).then(res => {
                            this.GetImages(this.id)
                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },

            GetColors($id){
                axios.get('admin/productColors/'+$id).then(res => {
                    this.id=$id
                    this.productColors=res.data
                })
            },
            AddColor($id){
                let self = this;
                let formData = new FormData();
                formData.append('id', $id);
                formData.append('checkedColor',this.checkedColor);

                axios.post('admin/productColors', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(){
                        self.allErrors=[]
                        self.GetColors($id);
                        self.$swal({
                            text:'تم الاضافه بنجاح   !!!',
                            icon: "success",
                        });
                    }).catch(function (error) {
                        self.allErrors = error.response.data.errors
                    }

                )
            },
            DeleteColor($id) {
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                }).then((result) => {
                    if (result.value) {
                        axios.get('/admin/deleteColors/' + $id+'_'+this.id ).then(res => {
                            this.GetColors(this.id)
                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },
            DeleteSize($id) {
                console.log(this.id)
                this.$swal({
                    text: "هل انت متاكد من الحذف",
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                }).then((result) => {
                    if (result.value) {
                        axios.get('/admin/deleteSizes/' + $id+'_'+this.id).then(res => {
                            this.GetSizes(this.id)
                        })
                        this.$swal(
                            'تم الحذف بنجاح ',
                        )
                    }
                });

            },
            GetSizes($id){
                axios.get('admin/productSizes/'+$id).then(res => {
                    this.id=$id
                    this.productSizes=res.data
                })
            },
            AddSize($id){
                let self = this;
                let formData = new FormData();
                formData.append('id', $id);
                formData.append('checkedSize',this.checkedSize);
                axios.post('admin/productSizes', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(){
                        self.allErrors=[]
                        self.GetSizes($id);
                        self.$swal({
                            text:'تم الاضافه بنجاح   !!!',
                            icon: "success",
                        });
                    }).catch(function (error) {
                        self.allErrors = error.response.data.errors
                    }

                )
            },
            UpdateSale($id){
                let self = this;
                //this.id=$id
                let formData = new FormData();
                formData.append('id', $id);
                formData.append('price',this.price);
                formData.append('sale',this.sale);
                formData.append('_method',"PUT")
                axios.post('admin/productSale/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                    .then(function(){
                        self.GetSale($id);
                        self.allErrors=[]
                        self.$swal({
                            text:'تم التعديل  بنجاح   !!!',
                            icon: "success",
                        });

                    }).catch(function (error) {
                        self.allErrors = error.response.data.errors
                    }

                )
            },
            GetSale($id){
                axios.get('admin/productSale/'+$id).then(res => {
                    this.productSale = res.data
                    this.sale=res.data.sale
                    this.price=res.data.price_sale
                })
            },

        },

    }
</script>
