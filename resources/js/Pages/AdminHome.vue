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
                            <li class="breadcrumb-item"><inertia-link href="/home">Home</inertia-link></li>
                            <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
        </div>  

        <Footer />
    </div>              
</template>

<script>
import Navbar from '../Shared/Navbar.vue'
import Sidebar from '../Shared/AdminSidebar.vue'
import Footer from '../Shared/Footer.vue'
export default {
    components: { Navbar, Sidebar, Footer },
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
    },
    props: ['name']
}
</script>

<style>

</style>