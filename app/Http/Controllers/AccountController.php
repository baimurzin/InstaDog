<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Account::get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $account_data = $request->only(['login', 'password']);

            $account = new Account();
            $account = $account->fill($account_data);
            $account->user_id = $user->id;
            $account->save();

            if ($account)
                return response()->json($account, 302);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $account = Account::findOrFail((int) $id);
            if ($account)
                return response()->json($account);
            else
                throw new \Exception;
        } catch (\Exception $e) {
            return $this->composeError($e);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            //todo
        } catch (\Exception $e) {
            return $this->composeError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $account = Account::findOrFail((int) $id);
            $removed = $account->delete();
            if ($account && $removed)
                return response()->json([
                    'status' => 'ok',
                    'removed' => $removed
                ]);
            else
                throw new \Exception;
        } catch (\Exception $e) {
            return $this->composeError($e);
        }
    }

    private function composeError($e)
    {
        return response()->json([
            'message' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
}
