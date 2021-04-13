<template>
    <div class="wrapper">
        <Navbar />
        <Sidebar />

         <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Transaction {{month}} {{year}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><inertia-link :href="'/user'"> Dashboard</inertia-link></li>
                                <li class="breadcrumb-item active">Transaction</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">                
                <div class="container-fluid">
                    <Flash />
                    <div class="mb-3">    
                        <inertia-link :href="$route('user.transactions.create')" class="btn btn-primary btn-sm"> <i class="fas fa-plus"></i>  Transaction</inertia-link>
                    </div>  
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
    name: 'Transaction',
    title: 'Transaction | BooKeeping',
    components: { Navbar, Sidebar, Footer, Flash},
    props: ['month', 'year', 'incomes', 'amountIncome', 'expenses', 'amountExpense', 'balance'],
    data(){
        return{
            
        }
    },
    methods:{
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
        }
    }
}
</script>