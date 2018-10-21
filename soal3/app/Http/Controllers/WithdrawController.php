<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('withdraw');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $data = [
                'account_id'        =>  auth()->user()->account->id,
                'amount'            =>  $request->amount
            ];

            if (auth()->user()->account->balance < $request->amount) {
                $request->session()->flash('error', 'Balance is not enough');
                return redirect('/home');
            }
            
            Withdraw::create($data);

            DB::commit();

            $request->session()->flash('success', 'Success Withdraw Balance');

            return redirect('/home');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            
            $errorCode = $e->errorInfo[1];
            if ($errorCode == '1062') {
                return response()->view('errors.error', [
                    'errorCode'         =>  $errorCode,
                    'errorMessage'      =>  'Duplicate entry'
                ], 403);
            } elseif ($errorCode == '1064') {
                return response()->view('errors.error', [
                    'errorCode'         =>  $errorCode,
                    'errorMessage'      =>  'Some fields are required'
                ], 422);
            }
            return response()->view('errors.error', [
                'errorCode'     =>  $errorCode,
                'errorMessage'  =>  'Something wrong'
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdraw $withdraw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdraw $withdraw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        //
    }
}
