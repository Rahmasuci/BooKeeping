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
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">BALANCE</span>
                                <span class="info-box-number">{{balance | currency }}</span>
                            </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-arrow-down"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">INCOME</span>
                                <span class="info-box-number">{{amountIncome | currency }}</span>
                            </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-arrow-up"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">EXPENSE</span>
                                <span class="info-box-number">{{amountExpense | currency }}</span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">                            
                            <apexchart :width="transactionChart.width" :height="300" :type="transactionChart.type" :options="transactionChart.options" :series="transactionChart.series"></apexchart>
                        </div>
                        <div class="col-12">                            
                            <apexchart :width="categoryChart.width" :height="300" :type="categoryChart.type" :options="categoryChart.options" :series="categoryChart.series"></apexchart>
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
import Sidebar from '../../Shared/UserSidebar'
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
    props: ['name', 'balance', 'amountIncome', 'amountExpense', 'transactionChart', 'categoryChart']
}
</script>

<style>

</style>