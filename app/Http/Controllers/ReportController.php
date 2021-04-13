<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PDF;
use Inertia\Inertia;

class ReportController extends Controller
{   

    public $incomes;
    public $expenses;
    public $amountIncome;
    public $amountExpense;
    public $balance;


    public function __construct()
    {
        $this->middleware('user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('User/Report/Index');
    }

    public function getReport(Request $request){
         // dd($request->year);
        $id = Auth::id();
        $this->incomes = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Income')
                    ->where('created_by', $id)
                    ->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year)
                    ->orderByDesc('date')
                    ->get();

        // dd($incomes);
                    
        $this->amountIncome = $this->incomes->sum('amount') ;

        $this->expenses = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Expense')
                    ->where('created_by', $id)
                    ->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year)
                    ->orderByDesc('date')
                    ->get();
        $this->amountExpense = $this->expenses->sum('amount') ;

        $this->balance = $this->amountIncome - $this->amountExpense;
    }

    public function report(Request $request)
    {   
        $this->getReport($request);

        return Inertia::render('User/Report/Index', [        
            'incomes'       => $this->incomes,
            'amountIncome'  => $this->amountIncome,
            'expenses'      => $this->expenses,
            'amountExpense' => $this->amountExpense,
            'balance'       => $this->balance
        ]);
    }

    // public function printReport(Request $request){
    //     $this->getReport($request);

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
        
        // $pdf = PDF::loadView('User/Report/Index', [
        //     'incomes'       => $this->incomes,
        //     'amountIncome'  => $this->amountIncome,
        //     'expenses'      => $this->expenses,
        //     'amountExpense' => $this->amountExpense,
        //     'balance'       => $this->balance
        // ]);

        // DD($PDF);
        // return $pdf->download('report.pdf');
    // }

    
}
