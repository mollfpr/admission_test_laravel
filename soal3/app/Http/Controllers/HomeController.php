<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/** MODELS */
use App\Account;
use App\Transaction;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = auth()->user()->account;
        $transactions = Transaction::where('account_id', auth()->user()->account->id)->orderBy('id', 'desc')->get();

        return view('home', [
            'account'       =>  $account,
            'transactions'   =>  $transactions
        ]);
    }

    public function download()
    {
        $transactions = Transaction::where('account_id', auth()->user()->account->id)->orderBy('id', 'desc')->get();

        return view('report', [
            'transactions'  =>  $transactions
        ]);
    }
}
