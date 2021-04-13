<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roleUser       = Auth::user()->role;    
        $userId         = Auth::id();   
        // dd($userId);

        $income = Category::query()->where('added_by', $userId)->where('type_of_transaction', 'Income')->orderByDesc('category_id')->get();
        $expenditure = Category::query()->where('added_by', $userId)->where('type_of_transaction', 'Expense')->orderByDesc('category_id')->get();

        $uIncome = Category::query()->whereIn('added_by', [$userId, 1])->where('type_of_transaction', 'Income')->orderByDesc('category_id')->get();
        $uExpenditure = Category::query()->whereIn('added_by', [$userId, 1])->where('type_of_transaction', 'Expense')->orderByDesc('category_id')->get();

        $transactions = [
            'Income',
            'Expense'
        ];

        if ($roleUser == 'Admin') {      
            $return = Inertia::render('Admin/Category', [
                'income' => $income,
                'expenditure' => $expenditure,
                'transactions' => $transactions
            ]);
        } else {
            $return = Inertia::render('User/Category', [
                'income' => $uIncome,
                'expenditure' => $uExpenditure,
                'transactions' => $transactions
            ]);
        }
        
        return $return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $id = Auth::id();
        // dd($request);

        $this->validate($request, [
            'type_of_category'      => 'required',
            'type_of_transaction'   => 'required',
        ]);

        Category::create([
            'type_of_category'      => $request->type_of_category,
            'type_of_transaction'   => $request->type_of_transaction,
            'added_by'              => $id,
        ]);

        $roleUser = Auth::user()->role; 
        
        if ($roleUser == 'Admin') {     
            $return = redirect()->route('admin.categories.index')->with('message', 'Data Added Successfully');
        } else {
            $return = redirect()->route('user.categories.index')->with('message', 'Data Added Successfully');
        }

        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'type_of_category' => 'required',
            'type_of_transaction' => 'required',
        ]);

        $category->update($request->all());

        $roleUser = Auth::user()->role; 
        
        if ($roleUser == 'Admin') {     
            $return = redirect()->route('admin.categories.index')->with('message', 'Data Changed Successfully');
        } else {
            $return = redirect()->route('user.categories.index')->with('message', 'Data Changed Successfully');
        }

        return $return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        $roleUser = Auth::user()->role; 
        
        if ($roleUser == 'Admin') {     
            $return = redirect()->route('admin.categories.index')->with('message', 'Data Deleted Successfully');
        } else {
            $return = redirect()->route('user.categories.index')->with('message', 'Data Deleted Successfully');
        }

        return $return;
    }
}
