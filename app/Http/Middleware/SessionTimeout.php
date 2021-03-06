<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminController;
use App\Models\Logs_safety;
use Closure;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SessionTimeout {

    /**
     * Instance of Session Store
     * @var session
     */
    protected $session;

    /**
     * Time for user to remain active, set to 900secs( 15minutes )
     * @var timeout
     */
    protected $timeout = 5;

    public function __construct(Store $session){
        $this->session        = $session;
        $this->redirectUrl    = 'auth/login';
        $this->sessionLabel   = 'warning';
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $this->session->has('lastActivityTime'))
        {
            $this->session->put('lastActivityTime', time());
        }
        else if( time() - $this->session->get('lastActivityTime') > (Logs_safety::first()->time_session)*60)
        {
            $this->session->forget('lastActivityTime');

            AdminController::log_record('Пользователь' .Auth::user()->name. ' отключен из-за простоя более '.$this->getTimeOut(). ' секунд');

            Auth::logout();

           // return redirect($this->getRedirectUrl())->with([ $this->getSessionLabel() => 'You have been inactive for '. $this->timeout/60 .' minutes ago.']);
            return redirect('/');
        }

        $this->session->put('lastActivityTime',time());

        return $next($request);
    }

    /**
     * Get timeout from laravel default's session lifetime, if it's not set/empty, set timeout to 15 minutes
     * @return int
     */
    private function getTimeOut()
    {

        return  ((Logs_safety::first()->time_session)*60) ?: $this->timeout;
    }

    /**
     * Get redirect url from env file
     * @return string
     */
    private function getRedirectUrl()
    {
        return  (env('SESSION_TIMEOUT_REDIRECTURL')) ?: $this->redirectUrl;
    }

    /**
     * Get Session label from env file
     * @return string
     */
    private function getSessionLabel()
    {
        return  (env('SESSION_LABEL')) ?: $this->sessionLabel;
    }

}
