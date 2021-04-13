<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Report</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="'/user'"> Dashboard</inertia-link></li>
                                <li class="breadcrumb-item active">Report</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <form action="" method="">
                        <select name="month" id="" class="btn btn-default mb-4" v-model="form.month">
                            <option value="0">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">Juny</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="year" id="" class="btn btn-default mb-4" v-model="form.year">
                            <option value="0">Select Year</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                        <button class="btn btn-primary mb-4" type="button" @click="report"> <i class="fas fa-search"></i> Search</button>
                    </form>                   
                    <Flash />
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">BALANCE</span>
                                <span class="info-box-number">{{balance | currency}}</span>
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
                        <div class="col-6">
                            <div class="callout callout-success" >
                                <h4>Incomes</h4>
                                <div class="row mb-2" v-for="(e, index) in incomes" :key="index">
                                    <div class="col-7">                               
                                        <span class="bold">{{e.date | formatDate}}</span> |
                                        <span>{{e.type_of_category}}</span>
                                        <span>| {{e.note}}</span>
                                    </div>
                                    <div class="col-3 text-right">
                                        <span class="">{{e.amount | currency }}</span>
                                    </div>
                                    <div class="col-2">
                                        <div class="btn-group float-right">
                                            <inertia-link :href="$route('user.transactions.edit', e.transaction_id)" class="btn btn-warning btn-sm"> <i class="fas fa-pencil-alt"></i></inertia-link>
                                            <button class="btn btn-danger btn-sm" type="button" @click="deleteTransaction(e.transaction_id)"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="callout callout-danger" >
                                <h4>Expenses</h4>
                                <div class="row mb-2" v-for="(e, index) in expenses" :key="index">
                                    <div class="col-7">                               
                                        <span class="bold">{{e.date | formatDate}}</span> |
                                        <span>{{e.type_of_category}}</span>
                                        <span>| {{e.note}}</span>
                                    </div>
                                    <div class="col-3 text-right">
                                        <span class="">{{e.amount | currency }}</span>
                                    </div>
                                    <div class="col-2">
                                        <div class="btn-group float-right">                                        
                                             <inertia-link :href="$route('user.transactions.edit', e.transaction_id)" class="btn btn-warning btn-sm"> <i class="fas fa-pencil-alt"></i></inertia-link>
                                            <button class="btn btn-danger btn-sm" type="button" @click="deleteTransaction(e.transaction_id)"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <button class="btn btn-info float-right d-none" id="print-btn" @click="print"><i class="fas fa-print"></i> Print</button> -->
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
    name: 'Report',
    title: 'Report | BooKeeping',
    components: { Navbar, Sidebar, Footer, Flash},
    mounted() {
        window.$('body').Layout();
        window.$('[data-widget="pushmenu"]').PushMenu();
        window.$('[data-widget="control-sidebar"]').ControlSidebar();
        window.$('ul[data-widget="treeview"]').Treeview('init');
        window.$('.dropdown').Dropdown();
        window.$('ul[data-widget="treeview"]').overlayScrollbars();
    },
    props: ['incomes', 'amountIncome', 'expenses', 'amountExpense', 'balance'],
    data(){
        return {
            form: new Form ({
                year : 0,
                month: 0,
            }),  
        }
    },
    methods:{
        async report() {
            let response = await this.$inertia.post('/user/report', this.form, {
                onSuccess: () => {
                    console.log("Success")
                    $("#print-btn").removeClass("d-none");
                    $("#print-btn").addClass("d-block");
                },
                onError: (errors) => {                    
                    console.log(errors);
                },
            })            
        },
        async deleteTransaction(id){
            if (!confirm('Are you sure want to remove?')) return;
            let response = await this.$inertia.delete('/user/transactions/'+id, {
                onSuccess: () => {
                    console.log("Success")
                },
                onError: (errors) => {
                    console.log(errors)
                },
            })            
        },        
        // async print() {
        //     let response = await this.$inertia.post('/user/report/print', this.form, {
        //         onSuccess: () => {
        //             console.log("Success")
        //         },
        //         onError: (errors) => {                    
        //             console.log(errors);
        //         },
        //     })            
        // },
        
    },
}
</script>

<style>

</style>