<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Topup;
use Illuminate\Http\Request;

use App\Account;

class TopupController extends Controller
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
        return view('topup');
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
            
            Topup::create($data);

            DB::commit();

            $request->session()->flash('success', 'Success Top Up Balance');

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
     * @param  \App\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function show(Topup $topup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function edit(Topup $topup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topup $topup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topup  $topup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topup $topup)
    {
        //
    }
}
