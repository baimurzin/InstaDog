<?php

namespace App\Http\Controllers\Dashboard\Instagram;

use App\Account;
use App\InstagramAccountData;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    /**
     * AccountController constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        return view('dashboard.instagram.index');
    }

    public function all()
    {
        //todo auth
        $accounts = Account::where('user_id', Auth::id())
            ->with('accData')
            ->get();
        foreach ($accounts as $account) {
            $account->state = false;
        }

        return $accounts;
    }

    public function create(Request $request)
    {
        return [
            'status' => 'Ok',
            'title' => 'Create account',
            'body' => view('dashboard.instagram.ajax_forms.acc_create')->render()
        ];
    }

    public function store(Request $request) {
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
                return redirect()->route('instagram.accounts.create')
                    ->withErrors($valid)
                    ->withInput();
            }
            DB::beginTransaction();
            $account = new Account();
            $account = $account->fill($account_data);
            $account->user_id = $user->id;
            $account->save();

            $accData = new InstagramAccountData();
            $accData->account_id = $account->id;
            $accData->account_username = $account->login;
            $accData->save();
            DB::commit();


            if ($account)
                return [
                    'status' => 'Ok',
                    'notify' => [
                        'type' => 'success',
                        'message' => 'Account added successfully'
                    ]
                ];
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage()."\nFile: ".$e->getFile().":".$e->getLine());
        }
        return response('Error when saving account', 500);
    }


    public function delete($ids) {
        $ids = explode(",", $ids);

        if (count($ids)) {
            Account::where('user_id', '=', Auth::user()->id)
                ->whereIn('id', $ids)
                ->delete();
        }

        return [
            'status' => 'Ok'
        ];
    }
}
