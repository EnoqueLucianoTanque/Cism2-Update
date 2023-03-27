<?php

namespace App\Exceptions;

use Exception;

class TooManyRequestsHttpException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        // return ()->view('auth.too_many_atresponsetempts');
        return 'teste';
    }
}
