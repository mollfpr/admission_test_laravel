<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Transfer;
use App\Account;
use Illuminate\Http\Request;

class TransferController extends Controller
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
        $accounts = Account::whereNotIn('number', [auth()->user()->account->number])->pluck('number', 'id');
        return view('transfer', [
            'accounts'      =>  $accounts
        ]);
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
                'from'      =>  auth()->user()->account->id,
                'to'        =>  $request->account_id,
                'amount'    =>  $request->amount
            ];

            if (auth()->user()->account->balance < $request->amount) {
                $request->session()->flash('error', 'Balance is not enough');
                return redirect('/home');
            }
            
            Transfer::create($data);

            DB::commit();

            $request->session()->flash('success', 'Success Transfer Balance');

            return redirect('/home');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();

            return $e;
            
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
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
