<?
namespace Service\Classes;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;

class Game{


    private $api;
    private $basic;
    private $secret;


    const status_ok = 0;

    
    public function __construct()
    {
        $this->api      = config("game.api");
        $this->basic    = config('game.url');
        $this->secret   = config('game.secret');
        
        loadLibrary('curl.class');
    }

     /**
     * call game command
     * @param string $method get|post
     * @param string $command
     * @param array $params
     * @return false|object
     */
    protected function command($method, $command, $params = [])
    {
        $curl = new \Curl();
        $curl->setSsl();
        $curl->setTimeout(5, 30);

        $params['sign_time'] = time();
        ksort($params);
        $params['sign'] = md5(http_build_query($params) . $this->secret);

        $url = $this->basic . $this->api[$command];

        $data = call_user_func([$curl, $method], $url, $params);
        $statusCode = $curl->getHttpCode();
        $curl->close();

        $result = json_decode($data);
        if ($this->check($result)) {
            return $result;
        }
        logger(
            "The {$command} interface call failed!httpCode={$statusCode}",
            [$params, objectToArray($result)]
        );
        return false;
    }

     /**
     * check result success
     * @param object $result
     * @return boolean
     */
    public function check($result)
    {
        if (is_object($result)) {
            if (isset($result->status)) {
                return $result->status == self::status_ok;
            }
        }
        return false;
    }

}