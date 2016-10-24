<?php

namespace App\Console\Commands;

use App\Account;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InstagramAPI\Instagram;
use InstagramAPI\InstagramException;

class InstFirstAuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inst:auth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $accounts = Account::where('status', Account::STATUS_WAIT_LOGIN)->get();

            if (!$accounts || !count($accounts)) {
                return false;
            }

            foreach ($accounts as $account) {
                $authInst = new Instagram($account->login, $account->password);
                if (!$authInst->isLoggedIn) {
                    $authInst->login();
                }

                $selfInfo = $authInst->getSelfUsernameInfo();


                DB::beginTransaction();

                $accData = $account->accData;
                $accData->account_username_id = $authInst->username_id;
                $accData->account_username = $authInst->username;
                $accData->followings_count = $selfInfo->getFollowingCount();
                $accData->followers_count = $selfInfo->getFollowerCount();
                $accData->media_count = $selfInfo->getMediaCount();
                $accData->save();
                $account->status = Account::STATUS_OK;
                DB::commit();
            }
        } catch (InstagramException $e) {
            DB::rollback();
            Log::error($e->getMessage() . "\ninFile\:" . $e->getFile());
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage() . "\ninFile\:" . $e->getFile());
        }
    }
}
