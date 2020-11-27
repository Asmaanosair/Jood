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
                            <form class="form-horizontal form-material" @submit.prevent="AddProduct()"  enctype="multipart/form-data">
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
                                            <label >  اختر الالوان</label>
                                            <div class="form-check form-check-inline"  v-for="color in colors">
                                                <input class="form-check-input material-inputs" :id="color.color" type="checkbox" :value="color.id"
                                                       v-model="checkedColor" >
                                                <label class="form-check-label" :for="color.color">{{color.color}}</label>
                                            </div>
                                        </div>


                                        <div class="col-md-12 m-b-20">
                                            <label > اختر الاحجام</label>
                                            <div class="form-check form-check-inline"  v-for="size in sizes">
                                                <input class="form-check-input material-inputs" :id="size.size" type="checkbox" :value="size.id"
                                                       v-model="checkedSize" >
                                                <label class="form-check-label" :for="size.size">{{size.size}}</label>
                                            </div>
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
                                            </div>
                                        </div>

                                        <div class="col-md-12 m-b-20">
                                            <label> الفيديو   </label>
                                            <div class=" btn  btn-rounded waves-effect waves-light btn-sm">
                                                                <span><i class="ion-upload m-r-5"></i>Upload
                                                                    Video</span>
                                                <input  type="file" @change="UploadVideo" class="upload">
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
       this.GetData();
    },
    data() {
        return {
            product: '',
            image:'',
            description:'',
            video:'',
            price:'',
            allErrors:[],
            colors:'',
            sizes:'',
            subCategory:'',
            checkedColor:[],
            checkedSize:[],
            subCategoryId:[],

        };
    },

    methods: {

        GetData(){
            axios.get('admin/product/create').then(res => {
                this.sizes=res.data.sizes
                this.colors=res.data.colors
                this.subCategory=res.data.subCategories
            })
        },
        AddProduct(){
            let self = this;
            let formData = new FormData();
            formData.append('checkedColor', this.checkedColor);
            formData.append('checkedSize', this.checkedSize);
            formData.append('product', this.product);
            formData.append('description', this.description);
            formData.append('price', this.price);
            formData.append('subCategoryId', this.subCategoryId);
            formData.append('image', this.image);
            formData.append('video', this.video);
            formData.append('images', this.images);
            axios.post('admin/product', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(function(){
                    self.allErrors=[]
                    self.$swal({
                        text:'تم الاضافه بنجاح   !!!',
                        icon: "success",
                    });
                }).catch(function (error) {
                    self.allErrors = error.response.data.errors
                console.log( self.allErrors)
                }
            )

        },
        UploadImage(e){
            this.image = e.target.files[0];

        },
        UploadVideo(e){
            this.video = e.target.files[0];

        },

    }

}
</script>
