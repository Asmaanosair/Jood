<template>

        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal form-material" @submit.prevent="UpdateProduct(id)"  enctype="multipart/form-data">
                                <div class="modal-body">

                                    <div class="form-group">

                                        <div class="col-md-12 m-b-20">
                                            <label>اسم المنتج </label>
                                            <input type="text" class="form-control" v-model="product" placeholder=" الاسم  ">
                                            <div v-if="allErrors.product" class="alert-danger form-control">{{ allErrors.product[0] }}</div>
                                        </div>
                                        <div class="col-md-12 m-b-20">
                                            <label>  تفاصيل المنتج   </label>
                                            <textarea type="text" class="form-control" v-model="description" placeholder=" تفاصيل المنتج   " rows="4"></textarea>
                                            <div v-if="allErrors.description" class="alert-danger form-control">{{ allErrors.description[0] }}</div>
                                        </div>
                                        <div class="col-md-12 m-b-20">
                                            <label> السعر    </label>
                                            <input type="text" class="form-control" v-model="price" placeholder=" السعر   ">
                                            <div v-if="allErrors.price" class="alert-danger form-control">{{ allErrors.price[0] }}</div>
                                        </div>



                                        <div class="col-md-12 m-b-20">
                                            <div class="form-group mb-4">
                                                <label for="exampleFormControlSelect1"> اختر القسم التابع له </label>
                                                <select class="form-control" id="exampleFormControlSelect1" v-model="subCategoryId">
                                                    <option  v-for="category in subCategory" :value="category.id">{{category.name}}</option>
                                                </select>
                                            </div>
                                            <div v-if="allErrors.subCategoryId" class="alert-danger form-control">{{ allErrors.subCategoryId[0] }}</div>

                                        </div>


                                        <div class="col-md-12 m-b-20">
                                            <label> الصوره   </label>
                                            <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Image</span>
                                                <input  type="file" @change="UploadImage" class="upload">
                                                <img :src="showImage" width="50px" height="50px">
                                            </div>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <label> الفيديو   </label>
                                            <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Video</span>
                                                <input  type="file" @change="UploadVideo" class="upload">
                                                <video width="400" controls>

                                                    <source :src="showVideo" type="video/mp4">
                                                    <source :src="showVideo" type="video/ogg">
                                                </video>
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
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
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
        this.GetProduct(this.$route.params.id);
    },

    data() {
        return {
            product: '',
            image:'',
            description:'',
            video:'',
            price:'',
            allErrors:[],
            subCategory:'',
            subCategoryId:[],
            showImage:'',
            showVideo:'',

        };
    },

    methods: {
        GetProduct($id){
            axios.get('admin/product/'+$id+'/edit').then(res => {
                this.product=res.data.product.product
                this.subCategoryId=res.data.product.sub_category_id
                this.description=res.data.product.description
                this.price=res.data.product.price
                this.showImage=res.data.product.image
                this.showVideo=res.data.product.video
                this.id=res.data.product.id
                this.subCategory=res.data.subCategory

            })
        },
        UpdateProduct($id){
            let self = this;
            let formData = new FormData();
            formData.append('product', this.product);
            formData.append('description', this.description);
            formData.append('price', this.price);
            formData.append('subCategoryId', this.subCategoryId);
            formData.append('image', this.image);
            formData.append('video', this.video);
            formData.append('_method',"PUT")
            axios.post('/admin/product/'+$id, formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(res){
                    self.GetProduct($id);
                    self.$swal({
                        text:'تم التعديل بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function(error){
                self.allErrors = error.response.data.errors
                console.log(self.allErrors)
            });
        },
        UploadImage(e){
            this.image = e.target.files[0];
        },
        UploadVideo(e){
            this.video = e.target.files[0];

        },
    },

}
</script>
