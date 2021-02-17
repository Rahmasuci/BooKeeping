<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Transaction</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="'/admin'"> Dashboard</inertia-link></li>
                                <li class="breadcrumb-item active">Transaction</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <Flash />
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">List of Transactions</h3>
                                <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal()"><i class="fas fa-plus"></i> Add Transaction </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="list_tot" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Type of Transaction</th>
                                            <th>Added on</th>
                                            <th>Changed on</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(transaction, index) in transactions" :key="index">     
                                            <td>{{index+1}}</td>
                                            <td>{{transaction.type_of_transaction}}</td>
                                            <td>{{transaction.created_at | formatDate }}
                                            </td>
                                            <td>{{transaction.updated_at | formatDate}}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" @click="editModal(transaction)"><i class="fas fa-pencil-alt"></i> Edit </button>
                                                <button class="btn btn-danger btn-sm" type="button" @click="deleteTransaction(transaction.id)"><i class="fas fa-trash-alt"></i> Delete </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal  -->
                <div class="modal fade" id="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">  
                            <div class="card-header">
                                <h3 class="card-title" v-show="!editmode" id="addNewLabel">Add Transaction</h3> 
                                <h3 class="card-title" v-show="editmode" id="addNewLabel">Change Transaction</h3> 
                                <div class="card-tools">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="tot">Type of Transaction</label>
                                        <input type="text" class="form-control" placeholder="Enter type of transaction" id="tot" v-model="form.type_of_transaction">
                                        <p id="erorr_tot" class="erorr">
                                        </p>
                                    </div>
                                    <button class="btn btn-success" v-show="!editmode" type="button" @click="save">Create</button>
                                    <button class="btn btn-success" v-show="editmode" @click="update" type="button">Update</button>
                                </form>
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
import Flash from '../../Shared/Flash'
export default {
    name: 'Transaction',
    title: 'Transaction | BooKeeping',
    components: { Navbar, Sidebar, Footer, Flash },
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
        $("#list_tot").DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [],
            'columnDefs': [ {
                    'targets': [4],
                    'orderable': false,
            }]
        });
    },
    props: ['transactions'],
    data() {
        return{
            form: new Form ({
                id : null,
                type_of_transaction : null,
                remember: false,
            }),
            editmode: false
        }
    },
    methods: {
        newModal(){        
            this.editmode = false; 
            this.form.reset();
            $('#modal').modal('show');
            $('#erorr').hide();
        },
        editModal(transaction){     
            this.editmode = true; 
            $('#modal').modal('show');
            this.form.fill(transaction);  
        },
        async save() {
            let response = await this.$inertia.post('/admin/transaction', this.form, {
                onSuccess: () => {
                    console.log("Success")
                    $('#modal').modal('hide');
                },
                onError: (errors) => {
                    var erorr = errors.type_of_transaction
                    document.getElementById("erorr").innerHTML = erorr;
                    document.getElementById("erorr").style.display = "block";
                },
            })
            
        },
        async update() {
            let response = await this.$inertia.patch('/admin/transaction/'+this.form.id, this.form, {
                onSuccess: () => {
                    console.log("Success")
                    $('#modal').modal('hide');
                },
                onError: (errors) => {
                    var erorr = errors.type_of_transaction
                    document.getElementById("erorr_tot").innerHTML = erorr;
                    document.getElementById("erorr_tot").style.display = "block";
                },
            })            
        },
        async deleteTransaction(id){
            if (!confirm('Are you sure want to remove?')) return;
            let response = await this.$inertia.delete('/admin/transaction/'+id, {
                onSuccess: () => {
                    console.log("Success")
                    $('#modal').modal('hide');
                },
                onError: (errors) => {
                    console.log(errors)
                },
            })            
        }
    }
}
</script>

<style>
.erorr{
    color: red;
}
</style>