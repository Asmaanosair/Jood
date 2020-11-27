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
            <div class="col-12 ">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" @submit.prevent="GetReport" enctype="multipart/form-data">

                            <div class="col-4 filter-form">
                                <label>التاريخ</label>
                            <input type="date" class="form-control" v-model="theDate" min="2020-01-01" placeholder="البدايه ">
                            </div>
                            <div class="col-4 filter-form">
                                <label>ترتيب بحسب </label>
                            <select class="form-control"  v-model="arrange">
                                <option value="d">اليوم  </option>
                                <option value="m">الشهر </option>
                                <option value="y">السنه </option>
                            </select>
                            </div>
                            <div class="col-4 filter-form">
                                <label>  </label>
                                <button type="submit" class="col-12 btn  btn-success"> تصفية <i class="fa fa-search"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
                    </div>

            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <h4 class="card-title">    التقارير    </h4>
                        <h6 class="card-subtitle">رؤية التقارير  </h6>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>التاريخ </th>
                                    <th>الحساب الكلى </th>
                                    <th> العنوان </th>
                                    <th>تفاصيل الطلب </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in delivery">
                                    <td>{{stringToDate(item.created_at)}}</td>
                                    <td>{{item.total}}</td>
                                    <td>{{item.address}}</td>
                                    <td><router-link  type="button" class="btn btn-warning   m-l-10  m-t-10 mb-2 float-right" :to="{ name: 'orderDetails',params: { id: item.id }}"> <i class="fa fa-eye-slash"></i> </router-link></td>

                                </tr>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>التاريخ </th>
                                    <th>الحساب الكلى </th>
                                    <th> العنوان </th>
                                    <th>تفاصيل الطلب </th>
                                </tr>
                                </tfoot>
                            </table>
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
import moment from 'moment'
export default {

    mounted() {
        this.GetReport();
    },
    data() {
        return {
            arrange:'y',
            theDate:'2020-01-01',
            delivery:{},

        }
    },
    methods: {
        GetReport() {
            let self = this;
            let formData = new FormData();
            formData.append('arrange', this.arrange);
            formData.append('theDate', this.theDate);
            console.log(formData)
            axios.post('admin/report', formData, {headers:{'Content-Type': 'multipart/form-data'}})
                .then(res => {
                    this.delivery=res.data
                   console.log(this.delivery)
                }

            )

        },
        stringToDate(value) {

            return moment(String(value)).format('MM/DD/YYYY    hh:mm')
            }

    },

}
</script>
