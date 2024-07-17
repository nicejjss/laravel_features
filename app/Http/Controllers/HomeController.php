<?php

namespace App\Http\Controllers;

use Exception;

class HomeController extends Controller
{
    public function index() {
        $tried = 1;
        $maxTries = 3;

        try {
            throw new Exception('new Exception');
            Mail::to('locdaoduc2002@gmail.com')->send((new \App\Mail\MyMail()));
        } catch (Throwable $e) {
            // $message = $e->getMessage();
            // $isRetryException = $this->isRetryException($message);
            // logError($logPrefix . ' failed time: ' . $tried . ' ' . $message);

            if ($tried) {
               dd(123);
            } else {
                throw $e;
            }
        }
        return 'ok';
    }
}
