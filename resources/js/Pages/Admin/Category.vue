<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="'/admin'"> Dashboard</inertia-link></li>
                                <li class="breadcrumb-item active">Category</li>
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
                                <h3 class="card-title">List of Categories</h3>
                                <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal()"><i class="fas fa-plus"></i> Add Category </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="list_toc" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Category</th>
                                            <th>Transaction</th>
                                            <th>Added by</th>
                                            <th>Added on</th>
                                            <th>Changed on</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(category, index) in categories" :key="index">     
                                            <td>{{index+1}}</td>
                                            <td>{{category.type_of_category}}</td>
                                            <td>{{category.transaction.type_of_transaction}}</td>
                                            <td>{{category.user.name}}</td>
                                            <td>{{category.created_at | formatDate}}
                                            </td>
                                            <td>{{category.updated_at | formatDate}}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" @click="editModal(category)"><i class="fas fa-pencil-alt"></i> Edit </button>
                                                <button class="btn btn-danger btn-sm" type="button" @click="deleteCategory(category.id)"><i class="fas fa-trash-alt"></i> Delete </button>
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
                                <h3 class="card-title" v-show="!editmode" id="addNewLabel">Add Category</h3> 
                                <h3 class="card-title" v-show="editmode" id="addNewLabel">Change Category</h3> 
                                <div class="card-tools">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="toc">Type of Category</label>
                                        <input type="text" class="form-control" placeholder="Enter type of category" id="toc" v-model="form.type_of_category">
                                        <p id="erorr_toc" class="erorr">
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label for="tot">Type of Transaction</label>
                                        <select class="form-control" name="" id="tot" v-model="form.type_of_transaction" >
                                            <option value="" disabled>Select Transaction</option>
                                            <option v-for="transaction in transactions" :key="transaction.id" v-bind:value="transaction.id">{{transaction.type_of_transaction}}</option>
                                        </select>
                                        <p id="erorr_tid" class="erorr">
                                        </p>
                                    </div>
                                    <button class="btn btn-success" v-show="!editmode" @click="save" type="button">Create</button>
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
    name: 'Category',
    title: 'Category | BooKeeping',
    components: { Navbar, Sidebar, Footer, Flash },
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
        $("#list_toc").DataTable({
            "responsive": true,
            "autoWidth": false,
            "order": [],
            'columnDefs': [ {
                    'targets': [5],
                    'orderable': false,
                }]
        });
    },
    props: ['categories', 'transactions'],
    data() {
        return{
            form: new Form ({
                id : '',
                type_of_category : '',
                type_of_transaction: ''
            }),
            editmode: false
        }
    },
    methods: {
        showErorr(errors){
            var erorr_toc = errors.type_of_category
            var erorr_tid = errors.type_of_transaction
            console.log(errors);
            if (erorr_toc != null && erorr_tid != null){
                document.getElementById("erorr_toc").innerHTML = erorr_toc;
                document.getElementById("erorr_toc").style.display = "block";
                document.getElementById("erorr_tid").innerHTML = erorr_tid;
                document.getElementById("erorr_tid").style.display = "block";
            } else if (erorr_toc != null){
                document.getElementById("erorr_toc").innerHTML = erorr_toc;
                document.getElementById("erorr_toc").style.display = "block";
            }            
        },
        hideErorr(){
            document.getElementById("erorr_toc").style.display = "none";
            document.getElementById("erorr_tid").style.display = "none";
        },
        newModal(){        
            this.editmode = false; 
            this.form.reset();
            this.hideErorr();
            $('#modal').modal('show');
        },
        editModal(transaction){   
            console.log(transaction)  ;
            this.editmode = true; 
            this.hideErorr();
            $('#modal').modal('show');
            this.form.fill(transaction);  
        },
        async save() {
            let response = await this.$inertia.post('/admin/category', this.form, {
                onSuccess: () => {
                    console.log("Success")
                    $('#modal').modal('hide');
                },
                onError: (errors) => {                    
                    this.showErorr(errors);
                },
            })
            
        },
        async update() {
            let response = await this.$inertia.patch('/admin/category/'+this.form.id, this.form, {
                onSuccess: () => {
                    console.log("Success")
                    $('#modal').modal('hide');
                },
                onError: (errors) => {
                    this.showErorr(errors); 
                },
            })            
        },
        async deleteTransaction(id){
            if (!confirm('Are you sure want to remove?')) return;
            let response = await this.$inertia.delete('/admin/category/'+id, {
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