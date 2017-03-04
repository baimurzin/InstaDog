<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use InstagramAPI\Instagram;
use Psy\Exception\Exception;

class TestController extends Controller
{

    /**
     * TestController constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    public function upload()
    {

        $username = '';
        $password = '';
        $debug = true;

        $photo = '';     // path to the photo
        $caption = 'test';     // caption
        //////////////////////

        $i = new Instagram($username, $password, $debug);

        try {
            $i->login();
        } catch (Exception $e) {
            $e->getMessage();
            exit();
        }
        $file = Input::file('image');
        $ext = Input::file('image')->getClientOriginalExtension();
        $path = $file->getRealPath();


        try {
            $i->uploadPhoto($path, $caption);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

}
