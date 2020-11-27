<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="{{AdminAssets()}}image/png" sizes="16x16" href="{{AdminAssets()}}/images/favicon.png">
    <title>Material pro admin Template - The Ultimate Multipurpose admin template</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/" />
    <!-- This Page CSS -->
    <link href="{{AdminAssets()}}/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="{{AdminAssets()}}/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<style>
    .filter-form{
        float: right;
    }
</style>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="index.html">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                        <!-- Dark Logo icon -->
                        <img src="{{AdminAssets()}}/images/logo-icon.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo icon -->
                        <img src="{{AdminAssets()}}/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{AdminAssets()}}/images/logo-text.png" alt="homepage" class="dark-logo" />
                        <!-- Light Logo text -->
                            <img src="{{AdminAssets()}}/images/logo-light-text.png" class="light-logo" alt="homepage" />
                        </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                   data-toggle="collapse" data-target="#navbarSupportedContent"
                   aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                        class="ti-more"></i></a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto float-left">
                    <!-- This is  -->
                    <li class="nav-item"> <a
                            class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                            href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    <!-- ============================================================== -->
                    <!-- Search -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- Mega Menu -->
                    <!-- ============================================================== -->

                    <!-- ============================================================== -->
                    <!-- End Mega Menu -->
                    <!-- ============================================================== -->
                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->

            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- User profile -->
            <div class="user-profile position-relative" style="background: url({{AdminAssets()}}/images/background/user-info.jpg) no-repeat;">
                <!-- User profile image -->
                <div class="profile-img"> <img src="{{AdminAssets()}}/images/users/profile.png" alt="user" class="w-100" /> </div>
                <!-- User profile text-->
                <div class="profile-text pt-1">
                    <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe</a>
                    <div class="dropdown-menu animated flipInY">
                        <a href="#" class="dropdown-item"><i class="ti-user"></i>
                            My Profile</a>
                        <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My
                            Balance</a>
                        <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{AdminUrl('logout')}}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
            <!-- End User profile text-->
            <!-- Sidebar navigation-->

            <nav class="sidebar-nav">
                <ul id="sidebarnav">


                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                                 href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">المناطق والمدن والاحياء</span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{AdminUrl('regions')}}" class="sidebar-link"><i
                                        class="mdi mdi-layers"></i><span class="hide-menu"> المناطق </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{AdminUrl('cities')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu">المدن
                                            </span></a></li>
                            <li class="sidebar-item"><a href="{{AdminUrl('districts')}}" class="sidebar-link"><i
                                        class="mdi mdi-weather-fog"></i><span class="hide-menu">الاحياء
                                            </span></a></li>

                        </ul>
                    </li>




                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                                                 href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">  الاقسام الرئيسيه والفرعيه </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="{{AdminUrl('categories')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu">الاقسام الرئيسيه
                                            </span></a></li>
                            <li class="sidebar-item"><a href="{{AdminUrl('sub_categories')}}" class="sidebar-link"><i
                                        class="mdi mdi-weather-fog"></i><span class="hide-menu">الاقسام الفرعية
                                            </span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark"
                                                 href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">  المتاجر   </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{AdminUrl('branches')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> المتاجر
                                            </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark"
                           href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-label"></i><span class="hide-menu"> خصائص المنتجات  </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">

                            <li class="sidebar-item"><a href="{{AdminUrl('colors')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> الالوان
                                            </span></a></li>
                            <li class="sidebar-item"><a href="{{AdminUrl('sizes')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> الاحجام
                                            </span></a></li>


                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark"
                           href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-projector"></i><span class="hide-menu">  المنتجات  </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{AdminUrl('createProduct')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> اضافة منتجات
                                            </span></a></li>

                            <li class="sidebar-item"><a href="{{AdminUrl('products')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> مشاهده جميع المنتجات
                                            </span></a></li>

                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark"
                           href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-projector"></i><span class="hide-menu">  الطلبات   </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{AdminUrl('orders')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> مشاهده جميع الطلبات
                                            </span></a></li>

                            @php
                            $status=['  الطلبات الجديده ',
                '  طلبات تم قبولها',
                '  طلبات  تمت '
                ,' طلبات ملغيه'];
                            @endphp
                            @foreach($status as $key=>$value)
                            <li class="sidebar-item"><a href="{{AdminUrl('order_status').'/'.$key}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu"> {{ $value}}
                                            </span></a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark"
                           href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-projector"></i><span class="hide-menu">  ادارة المخازن   </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{AdminUrl('stock')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu">  المخازن
                                            </span></a></li>



                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark"
                           href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-projector"></i><span class="hide-menu">   التقارير    </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{AdminUrl('report')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu">  تقارير المبيعات
                                            </span></a></li>



                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark"
                           href="javascript:void(0)" aria-expanded="false"><i
                                class="mdi mdi-projector"></i><span class="hide-menu">   المستخدمين     </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{AdminUrl('users')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu">   المستخدمين
                                            </span></a></li>
                            <li class="sidebar-item"><a href="{{AdminUrl('delivery')}}" class="sidebar-link"><i
                                        class="mdi mdi-credit-card-scan"></i><span class="hide-menu">   الموصلين والطلبات
                                            </span></a></li>

                        </ul>
                    </li>
                </ul>
            </nav>


            <nav class="sidebar-nav">
                <ul  id="sidebarnav">

                    <li class="sidebar-item"><a  href="{{AdminUrl('sliders')}}" class="sidebar-link"><i class="mdi mdi-image-album"></i><span class="hide-menu">      الصور المتحركه    </span></a></li>
                    <li class="sidebar-item"><a  href="{{AdminUrl('settings')}}" class="sidebar-link"><i class="mdi mdi-settings"></i><span class="hide-menu">       اعدادات الموقع     </span></a></li>
                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        <!-- Bottom points-->
        <div class="sidebar-footer">
            <!-- item-->
            <a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
            <!-- item-->
            <a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
            <!-- item-->
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <!-- End Bottom points-->
    </aside>
@yield('content')

</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- customizer Panel -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('js/app.js')}}"></script>
<script src="{{AdminAssets()}}/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{AdminAssets()}}/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="{{AdminAssets()}}/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<script src="{{AdminAssets()}}/dist/js/app.min.js"></script>
<script src="{{AdminAssets()}}/dist/js/app.init.js"></script>
<script src="{{AdminAssets()}}/dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{AdminAssets()}}/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="{{AdminAssets()}}/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="{{AdminAssets()}}/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{AdminAssets()}}/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="{{AdminAssets()}}/dist/js/custom.min.js"></script>
<script src="{{AdminAssets()}}/extra-libs/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="{{AdminAssets()}}/libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="{{AdminAssets()}}/dist/js/pages/datatable/custom-datatable.js"></script>
<script src="{{AdminAssets()}}/extra-libs/jquery-datatables-editable/jquery.dataTables.js"></script>
<script src="{{AdminAssets()}}/libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="{{AdminAssets()}}/dist/js/pages/datatable/custom-datatable.js"></script>
<script src="{{AdminAssets()}}/extra-libs/tiny-editable/mindmup-editabletable.js"></script>
<script src="{{AdminAssets()}}/extra-libs/tiny-editable/numeric-input-example.js"></script>
<script src="{{AdminAssets()}}/dist/js/pages/samplepages/jquery.PrintArea.js"></script>
<script src="{{AdminAssets()}}/dist/js/pages/invoice/invoice.js"></script>
<script>
    $(document).ready( function () {
        $('#zero_config').DataTable();
    } );
</script>
</body>

</html>
