<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Category;
use Inertia\Inertia;

class TransactionController extends Controller
{   
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
        $now = Carbon::now();
        $month = Carbon::parse($now)->format('F');
        $year = Carbon::parse($now)->year;

        $id = Auth::id();

        $incomes = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Income')
                    ->where('created_by', $id)
                    ->whereMonth('date', date('m'))
                    ->orderByDesc('date')
                    ->get();
                    
        $amountIncome = $incomes->sum('amount') ;

        $expenses = Transaction::leftJoin('categories', 'categories.category_id', '=', 'transactions.category_id')
                    ->where('type_of_transaction', 'Expense')
                    ->where('type_of_transaction', $id)
                    ->whereMonth('date', date('m'))
                    ->orderByDesc('date')
                    ->get();
        $amountExpense = $expenses->sum('amount') ;

        $balance = $amountIncome - $amountExpense;
        // dd($incomes);
        // dd($month);
        
        return Inertia::render('User/Transaction/Index', [            
            'month' => $month,
            'year' => $year,
            'incomes' => $incomes,
            'amountIncome' => $amountIncome,
            'expenses' => $expenses,
            'amountExpense' => $amountExpense,
            'balance' => $balance
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        return Inertia::render('User/Transaction/Create');
    }
    
    public function getCategories(Request $request)
    {
        $data = Category::where('type_of_transaction', $request->type_of_transaction)->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        // dd($request);
        $id = Auth::id();
        $this->validate($request, [
            'amount'        => 'required|numeric',
            'date'          => 'required|date',
            'category_id'   => 'required',
            'note'          => 'nullable'
        ]);

        Transaction::create([
            'amount'        => $request->amount,
            'date'          => $request->date,
            'category_id'   => $request->category_id,
            'created_by'    => $id,
            'note'          => $request->note,
        ]);

        return redirect()->route('user.transactions.index')->with('message', 'Data Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {   
        // dd($transaction);
        $tot = ['Income', 'Expense'];
        $categories = Category::all();
        return Inertia::render('User/Transaction/Edit', [
            'transaction' => $transaction,
            'categories' => $categories,
            'tot' => $tot,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
       $this->validate($request, [
            'amount'        => 'required|numeric',
            'date'          => 'required|date',
            'category_id'   => 'required',
            'note'          => 'nullable'
        ]);

        $transaction->update($request->all());

        return redirect()->route('user.transactions.index')->with('message', 'Data has been Changed Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('user.transactions.index')->with('message', 'Data Deleted Successfully');
    }
}
