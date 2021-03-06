<?php

namespace App\Http\Controllers;

use App\Account;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::where('user_id', Auth::id())->get();
        return response()->json($accounts);
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

            $valid = Validator::make($account_data, [
                'login' => 'required',
                'password' => 'required'
            ]);

            if ($valid->fails()) {
                $messages = $valid->messages()->getMessages();
                $messages['status'] = 'bad';
                return response()->json($messages, 500);
            }
            $account = new Account();
            $account = $account->fill($account_data);
            $account->user_id = $user->id;
            $account->save();

            if ($account)
                return response()->json($account);
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
            $account = Account::findOrFail((int)$id);
            if ($account)//todo fix Auth search by user id
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
            $account = Account::where('user_id', Auth::id())
                ->where('account_id', $id)
                ->first();
            if ($account)
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

    public function activateAccount(Request $request, $account_id)
    {
        try {
            $user = Auth::user();
            $account = Account::where('id', '=', $account_id)
                ->where('user_id', '=', $user->id)
                ->first();

            if ($account) {
                DB::beginTransaction();
                $account->active = true;
                $account->save();

                Account::where('user_id', $user->id)
                    ->where('id', '!=', $account_id)
                    ->update([
                        'active' => false
                    ]);


                DB::commit();
                return response()->json($account);
            } else {
                throw new \Exception;
            }

        } catch (\Exception $e) {
            DB::rollback();
            $this->composeError($e);
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
