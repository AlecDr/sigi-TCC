<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    

    use ResetsPasswords;

    /**
     * 
     *
     * @var string
     */
    protected $redirectTo = '/todos_imoveis';

    /**
     * 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
