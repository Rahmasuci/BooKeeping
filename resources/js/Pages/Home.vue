<template>
    <!-- <layout> -->
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blank Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                        </ol>
                    </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </div>  

        <Footer />
    </div>               
    <!-- </layout> -->
</template>

<script>
import Navbar from '../Shared/Navbar.vue'
import Sidebar from '../Shared/Sidebar.vue'
import Footer from '../Shared/Footer.vue'
// import Layout from '../Shared/Layout.vue'
export default {
    components: { Navbar, Sidebar, Footer },
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
    }
}
</script>

<style>

</style>