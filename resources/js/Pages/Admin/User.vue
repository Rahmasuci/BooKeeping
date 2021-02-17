<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="'/admin'"> Dashboard</inertia-link></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">List of Users</h3>
                                <div class="card-tools">
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="list_user" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Added on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(user, index) in users" :key="index">     
                                            <td>{{index+1}}</td>
                                            <td>{{user.name}}</td>
                                            <td>{{user.email }}
                                            </td>
                                            <td>{{user.created_at | formatDate }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
    name: 'User',
    title: 'User | BooKeeping',
    components: { Navbar, Sidebar, Footer },
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
        $("#list_user").DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [],
            'columnDefs': []
        });
    },
    props: ['users']
}
</script>

<style>
</style>