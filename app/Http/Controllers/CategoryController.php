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
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::query()->with('transaction')->with('user')->orderByDesc('id')->get();

        $transaction = DB::table('transactions')->get();

        return Inertia::render('Admin/Category', [
            'categories' => $data,
            'transactions' => $transaction
        ]);
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
            'type_of_category'  => 'required',
            'type_of_transaction'    => 'required',
        ]);

        Category::create([
            'type_of_category'  => $request->type_of_category,
            'type_of_transaction'    => $request->type_of_transaction,
            'user_id'           => $id,
        ]);

        return redirect()->route('admin.category.index')->with('message', 'Data Added Successfully');
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

        return redirect()->route('admin.category.index')->with('message', 'Data has been Changed Successfully');
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

        return redirect()->route('admin.category.index');
    }
}
