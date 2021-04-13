<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 v-show="!editmode" >Create Transaction</h1>
                            <h1 v-show="editmode" >Edit Transaction</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="'/user'"> Dashboard</inertia-link></li>
                                <li class="breadcrumb-item"><inertia-link :href="$route('user.transactions.index')"> Transaction</inertia-link></li>
                                <li class="breadcrumb-item active">Create</li>
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
                                <h3 class="card-title"> <i class="fas fa-plus"> </i> Transaction</h3>
                            </div>
                            <div class="card-body">
                                <form action="" class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="tot" class="col-sm-3 col-form-label" >Type of transaction *</label>
                                        <select name="" id="" class="form-control col-sm-9" v-model='transaction' @change="getCategories()">
                                            <option value="0" disabled> Select transaction</option>
                                            <option value="Income">Income</option>
                                            <option value="Expense">Expense</option>
                                        </select>         
                                    </div>
                                    <div class="form-group row">
                                        <label for="tot" class="col-sm-3 col-form-label">Category *</label>
                                        <select class="form-control col-sm-9"  v-model='form.category_id'>
                                            <option value="0" disabled> Select category</option>                                            
                                            <option v-for="data in categories" :key="data.category_id"  v-bind:value='data.category_id'>{{ data.type_of_category }}</option>    
                                        </select>
                                    </div>   
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Amount *</label>
                                        <currency-input class="form-control col-sm-9" v-model="form.amount"/>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Date *</label>
                                        <input type="date" class="form-control col-sm-9" v-model="form.date">
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-3 col-form-label">Note</label>
                                        <input type="text" class="form-control col-sm-9" v-model="form.note" placeholder="Input Note">
                                    </div>
                                     <button class="btn btn-success float-right" @click="save" type="button">Create</button>
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
    name: 'CreateTransaction',
    title: 'Transaction | BooKeeping',
    components: { Navbar, Sidebar, Footer, Flash},
    props: [],
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
            form: new Form ({
                id : '',
                amount: 0,
                date:'',
                category_id : 0,
                note:'',
            }),
            transaction: 0,
            categories: [],            
            editmode: false    
        }
    },
    methods:{
        async getCategories() {            
            let response = axios.get('/user/getCategories',{ params: {
                type_of_transaction: this.transaction                            
            }}).then(function(response){
                this.categories = response.data;
                console.log(this.categories);
            }.bind(this));
        },
        async save() {
            let response = await this.$inertia.post('/user/transactions', this.form, {
                onSuccess: () => {
                    console.log("Success")
                },
                onError: (errors) => {                    
                    console.log(errors);
                },
            })            
        }      
    },
}
</script>

