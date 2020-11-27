import ShowRegions from './components/admin/region/ShowAll'
import ShowCities from './components/admin/city/ShowAll'
import ShowDistricts from './components/admin/district/ShowAll'
import ShowCategories from './components/admin/category/ShowAll'
import ShowSubCategories from './components/admin/subcategory/ShowAll'
import ShowSlider from './components/admin/slider/ShowAll'
import ShowSetting from './components/admin/setting/ShowAll'
import ShowBranch from './components/admin/branch/ShowAll'
import ShowProduct from './components/admin/product/Index'
import ShowColor from './components/admin/color/ShowAll'
import ShowSize from './components/admin/size/ShowAll'
import CreateProduct from './components/admin/product/Create'
import ProductDetails from './components/admin/product/Product'
import EditProduct from './components/admin/product/Edit'
import BranchProduct from './components/admin/branch/Prouducts'
import AllOrders from './components/admin/order/Order'
import OrderStatus from './components/admin/order/Status'
import Dashboard from './components/admin/Dashboard'
import Users from './components/admin/users/Index'
import Delivery from './components/admin/delivery/Index'
import Deliveries from './components/admin/delivery/Delivery'
import OrderDetails from './components/admin/order/Details'
import Report from './components/admin/reports/Index'
import Stock from './components/admin/stock/Index'


export default {
    mode:'history',
    routes:[
        {
            path:'/admin/regions',
            component:ShowRegions,
        },
        {
            path:'/admin/dashboard',
            component:Dashboard,
        },
        {
            path:'/admin/cities',
            component:ShowCities,

        },
        {
            path:'/admin/districts',
            component:ShowDistricts,

        },
        {
            path:'/admin/categories',
            component:ShowCategories,

        },
        {
            path:'/admin/sub_categories',
            component:ShowSubCategories,

        },
        {
            path:'/admin/sliders',
            component:ShowSlider,

        },
        {
            path:'/admin/settings',
            component:ShowSetting,

        },
        {
            path:'/admin/branches',
            component:ShowBranch,
        },

        {
            path:'/admin/colors',
            component:ShowColor,
        },
        {
            path:'/admin/sizes',
            component:ShowSize,
        },
        {
            path:'/admin/products',
            component:ShowProduct,

        },
        {
            path:'/admin/createProduct',
            component:CreateProduct,
            name:'createProduct'
        },
        {
            path: '/admin/productDetails/:id',
            component: ProductDetails,
            name:'ProductDetails'
        },
        {
            path: '/admin/EditProduct/:id',
            component: EditProduct,
            name:'EditProduct'
        },
        {
            path: '/admin/branchProducts/:id',
            component: BranchProduct,
            name:'BranchProduct'
        },
        {
            path: '/admin/orders',
            component: AllOrders,
            name:'allOrders'
        },
        {
            path: '/admin/order_status/:status',
            component: OrderStatus,
            name:'orderStatus'
        },
        {
            path: '/admin/users',
            component: Users,
            name:'users'
        },
        {
            path: '/admin/delivery',
            component: Delivery,
        },
        {
            path: '/admin/deliveries/:id',
            component: Deliveries,
            name: 'deliveries',
        },
        {
            path: '/admin/order_details/:id',
            component: OrderDetails,
            name: 'orderDetails',
        },
        {
            path: '/admin/report/',
            component: Report,
            name: 'report',
        },
        {
            path: '/admin/stock/',
            component: Stock,
            name: 'stock',
        }
    ]

}
