<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Hai {{name}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{transaction}}</h3>

                                <p>Total Transactions</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <inertia-link :href="$route('admin.transactions.index')" class="small-box-footer">
                                More info 
                                <i class="fas fa-arrow-circle-right"></i>
                            </inertia-link>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{category}}</h3>

                                <p>Total Categories</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <inertia-link :href="$route('admin.categories.index')" class="small-box-footer">
                                More info 
                                <i class="fas fa-arrow-circle-right"></i>
                            </inertia-link>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{user}}</h3>

                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <inertia-link :href="$route('admin.users')" class="small-box-footer">
                                More info 
                                <i class="fas fa-arrow-circle-right"></i>
                            </inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>  

        <Footer />
    </div>              
</template>

<script>
import Navbar from '../../Shared/Navbar'
import Sidebar from '../../Shared/AdminSidebar'
import Footer from '../../Shared/Footer'
export default {
    name: 'Dashboard',
    title: 'Dahsboard | BooKeeping',
    components: { Navbar, Sidebar, Footer },
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
    },
    props: ['name', 'transaction', 'category', 'user' ]
}
</script>



<style>

</style>