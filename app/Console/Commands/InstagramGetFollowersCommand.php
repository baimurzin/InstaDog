<?php

namespace App\Console\Commands;

use App\InstagramAccountData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use InstagramAPI\Instagram;
use InstagramAPI\InstagramException;

class InstagramGetFollowersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:followers';

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
        $login = "sweet_home_prod";
        $password = "Notepad123";
        $debug = false;
        $userNameId = 3623830696;

        try {
            $instagram = new Instagram($login, $password, $debug);
            if (!$instagram->isLoggedIn)
                $instagram->login();


//            $username = "baimurzinv";
//
            $userNameId = $instagram->getSelfUsernameInfo();

//            $d = $instagram->getv2Inbox();
            var_dump($userNameId->getMediaCount());
//            $followers = Cache::remember($userNameId.'followers',50, function() use ($instagram, $userNameId) {
//                return $instagram->getUserFollowers($userNameId);
//            });
//
//            $followings = Cache::remember($userNameId.'followings',50, function() use ($instagram, $userNameId) {
//                return $instagram->getUserFollowings($userNameId);
//            });
//
//            $iad = new InstagramAccountData();
//            $iad->account_username_id = $userNameId;
//            $iad->account_username = $username;
//
//            $data = [];
//            $data['followers'] = [];
//            $data['followings'] = [];
//            $folls = $followers->getFollowers();
//            $followings = $followings->getFollowings();
//            foreach ($folls as $getFollower) {
//                $follower = [
//                    'username' => $getFollower->getUsername(),
//                    'profile_pic_url' => $getFollower->getProfilePicUrl(),
//                    'username_id' => $getFollower->getUsernameId(),
//                    'full_name' => $getFollower->getFullName()
//                ];
//                array_push($data['followers'], $follower);
//            }
//
//            foreach ($followings as $getFollower) {
//                $follower = [
//                    'username' => $getFollower->getUsername(),
//                    'profile_pic_url' => $getFollower->getProfilePicUrl(),
//                    'username_id' => $getFollower->getUsernameId(),
//                    'full_name' => $getFollower->getFullName()
//                ];
//                array_push($data['followings'], $follower);
//            }
//
//            $this->info(count($data['followers']));
//
//            $iad->account_data = json_encode($data);
//            $result = $iad->save();
//            $this->info($result);

        } catch (InstagramException $e) {
            Log::error($e->getMessage() . "\ninFile\:" . $e->getFile());
        } catch (\Exception $e) {
            Log::error($e->getMessage() . "\ninFile\:" . $e->getFile());
        }

    }
}
