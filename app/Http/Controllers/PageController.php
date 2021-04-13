<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Transaction;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use LarapexChart;
use Inertia\Inertia;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        // dd($user);        
        $userId = Auth::id(); 
        $name = Auth::user()->name;
        $year = '20'.date('y');
        $incomes = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Income')
                    ->where('created_by', $userId)
                    ->whereYear('date', $year)
                    ->get();    
        $amountIncome = $incomes->sum('amount') ;        
        $expenses = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Expense')
                    ->where('created_by', $userId)
                    ->whereYear('date', $year)
                    ->get();
        $amountExpense = $expenses->sum('amount') ;
        $balance = $amountIncome - $amountExpense;

        $incomeYear = [];
        for ($i = 1; $i <= 12; $i++) { 
            $incomeMonth = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Income')
                    ->whereMonth('date', $i)
                    ->whereYear('date', $year)
                    ->get();               
            $totalIncomeMonth = $incomeMonth->sum('amount');
            array_push($incomeYear, $totalIncomeMonth);
        }

        $expenseYear = [];
        for ($i = 1; $i <= 12; $i++) { 
            $expenseMonth = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Expense')
                    ->whereMonth('date', $i)
                    ->whereYear('date', $year)
                    ->get();  
            $totalExpenseMonth = $expenseMonth->sum('amount'); 
            array_push($expenseYear, $totalExpenseMonth);
        }     

        $transactionChart = LarapexChart::areaChart()
                    ->setTitle('Transactions This Year')
                    ->addArea('Income', $incomeYear)
                    ->addArea('Expense', $expenseYear)
                    ->setColors(['#28A745', '#ff455f', '#17A2B7'])
                    ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'])
                    ->toVue();

        $category = Transaction::query()
                    ->leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->whereIn('added_by', [$userId, 1])
                    ->where('created_by', [$userId])
                    ->groupBy('type_of_category')
                    ->pluck('type_of_category')
                    ->toArray();
        
        $length=count($category);
        $totalCategory = [];
        foreach ($category as $key ) {
            $amountCategory = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->whereIn('added_by', [$userId, 1])
                    ->where('created_by', [$userId])
                    ->where('type_of_category', $key)
                    ->get();
            $sumCategory = $amountCategory->sum('amount');
            array_push($totalCategory, $sumCategory);        
        }   
        
        $categoryChart = LarapexChart::pieChart()
                    ->setTitle('Category')
                    ->addData($totalCategory)
                    ->setColors(['#008FFB', '#00E396', '#feb019', '#ff455f', '#775dd0', '#80effe',
                                '#0077B5', '#ff6384', '#c9cbcf', '#0057ff', '00a9f4', '#2ccdc9', '#5e72e4'])
                    ->setLabels($category)
                    ->toVue();    
               
        return Inertia::render('User/Index', [
            'name' => $name,
            'amountIncome' => $amountIncome,
            'amountExpense' => $amountExpense,
            'balance' => $balance,
            'transactionChart' => $transactionChart,
            'categoryChart' => $categoryChart,
        ]);
    }
}
