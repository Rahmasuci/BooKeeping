<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Transaction</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="'/user'"> Dashboard</inertia-link></li>
                                <li class="breadcrumb-item"><inertia-link :href="$route('user.transactions.index')"> Transaction</inertia-link></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title"> <i class="fas fa-pencil-alt"> </i> Transaction</h3>
                            </div>
                            <div class="card-body">
                                <form action="" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="tot" class="col-sm-3 col-form-label">Category *</label>
                                        <select class="form-control col-sm-9" v-model='transaction.category_id' id="toc">
                                            <option value="0" disabled> Select category</option>                                            
                                            <option v-for="data in categories" :key="data.category_id"  v-bind:value='data.category_id' :selected="data.category_id == transaction.category_id">{{ data.type_of_category }}</option>    
                                        </select>
                                        <div class="col-sm-3"></div>
                                        <p id="error_toc" class="error col-sm-9"></p> 
                                    </div>   
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Amount *</label>
                                        <currency-input class="form-control col-sm-9" v-model="transaction.amount" id="amount"/>
                                        <div class="col-sm-3"></div>
                                        <p id="error_amount" class="error col-sm-9"></p> 
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Date *</label>
                                        <input type="date" class="form-control col-sm-9" v-model="transaction.date" id="date">
                                        <div class="col-sm-3"></div>
                                        <p id="error_date" class="error col-sm-9"></p> 
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Note</label>
                                        <input type="text" class="form-control col-sm-9" v-model="transaction.note" placeholder="Input note">
                                    </div>
                                     <button class="btn btn-success float-right" @click="update" type="button">Save</button>
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
import Navbar from '../../../Shared/Navbar'
import Sidebar from '../../../Shared/UserSidebar'
import Footer from '../../../Shared/Footer'
import Flash from '../../../Shared/Flash'

export default {    
    name: 'EditTransaction',
    title: 'Transaction | BooKeeping',
    components: { Navbar, Sidebar, Footer, Flash},
    props: ['transaction', 'categories', 'tot'],
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
    },
    data(){
        return { 
        }
    },
    methods:{               
        hideError(){
            var dis_toc = document.getElementById("error_toc").style.display
            var dis_amount = document.getElementById("error_amount").style.display
            var dis_date = document.getElementById("error_date").style.display
            if (dis_toc == "block" || dis_amount == "block" || dis_date == "block" ) {
                document.getElementById("error_toc").style.display = "none";
                document.getElementById("error_amount").style.display = "none";
                document.getElementById("error_date").style.display = "none";
            }
        },
        checkForm(){
            var toc = document. getElementById("toc").value
            var amount = document. getElementById("amount").value
            var date = document. getElementById("date").value
            if(toc == 0 && amount == "$0.00" && date ==""){                         
                document.getElementById("error_toc").innerHTML = "Choose type of category";
                document.getElementById("error_toc").style.display = "block";
                document.getElementById("error_amount").innerHTML = "Value of amount cannot be $0.00";
                document.getElementById("error_amount").style.display = "block";
                document.getElementById("error_date").innerHTML = "Specify the transaction date";
                document.getElementById("error_date").style.display = "block"; 
            }else if(toc == 0){
                document.getElementById("error_toc").innerHTML = "Choose type of category";
                document.getElementById("error_toc").style.display = "block";  
            }else if(amount == "$0.00"){
                document.getElementById("error_amount").innerHTML = "Value of amount cannot be $0.00";
                document.getElementById("error_amount").style.display = "block";  
            }else if(date == ""){
                document.getElementById("error_date").innerHTML = "Specify the transaction date";
                document.getElementById("error_date").style.display = "block";  
            }

            
        },
        async getCategories() {            
            let response = axios.get('/user/getCategories',{ params: {
                type_of_transaction: this.transactions                            
            }}).then(function(response){
                this.categories = response.data;
                console.log(this.categories);
            }.bind(this));
        },
        async update() {                    
            this.hideError()
            this.checkForm();  
            var amount = document. getElementById("amount").value
            if (amount != "$0.00"){
                let response = await this.$inertia.patch('/user/transactions/'+this.transaction.transaction_id, this.transaction, {
                    onSuccess: () => {
                        console.log("Success")
                    },
                    onError: (errors) => {                    
                        console.log(errors);
                    },
                })        
            }              
        }      
    },
}
</script>

<style>
.error{
    color: red;
    font-size: 14px;
    margin-block-end: 0;
}
</style>


