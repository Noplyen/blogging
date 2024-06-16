<?php
namespace App\Filters;
use App\Exceptions\SessionNotFoundExceptions;
use App\Libraries\AppLogger;
use App\Services\SessionLoginServices;
use CodeIgniter\Filters\FilterInterface;
use DateTime;
use DateTimeZone;
use Monolog\Logger;

class LoginAuth implements FilterInterface
{
    protected Logger $myLogger;
    protected SessionLoginServices $sessionLoginServices;

    public function __construct()
    {
        $this->myLogger             = AppLogger::LoggerCreations(LoginAuth::class);
        $this->sessionLoginServices = new SessionLoginServices();
    }

    public function before(\CodeIgniter\HTTP\RequestInterface $request, $arguments = null)
    {
        // mendapatkan time saat ini untuk perbandingan cookie expired
        $dateTime = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
        $currentTime = $dateTime->format('Y-m-d');

        $cookie = request()->getCookie('authorization');

        // jika request tidak memiliki cookie auth
        if(empty($cookie)){

            $this->myLogger->debug('empty cookie from request');

            return redirect()->to(base_url());

        }else{

            try{
                // try to find user cookie
                $result = $this->sessionLoginServices->findSessionId($cookie);

                // when cookie expired
                if($currentTime>$result['date_expire']){

                    $this->myLogger->debug('cookie date expired',
                        [
                            'current time'=>$currentTime,
                            'session user time'=>$result['date_expire']
                        ]);

                    return redirect()->to(base_url());
                }

            }catch (SessionNotFoundExceptions $exception){

                $this->myLogger->debug($exception->getMessage());

                return redirect()->to(base_url());
            }
        }
    }

    public function after(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}