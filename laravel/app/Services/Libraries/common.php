<?php

/**
 *  屏蔽电话号码中间四位
 */
function mobile_hide($num, $start= 3, $length=4)
{
    $str = '';
    if ($num) {
        $str = substr_replace($num, str_repeat('*', $length), $start, $length);
    }
    return $str;
}

/**
 *	只显示金额数字的位数
 */
function number_hide($str, $show)
{
    $size = strlen($str);
    if ($show >= $size) {
        return $str;
    }

    $ret = substr($str, 0, $show);
    for ($i = $show; $i < $size; $i++) {
        $tmp = substr($str, $i, 1);
        if ($tmp == '.') {
            $ret .= $tmp;
        } else {
            $ret .= '*';
        }
    }
    return $ret;
}

/**
* 把数字1-1亿换成汉字表述，如：123->一百二十三
* @param [num] $num [数字]
* @return [string] [string]
*/
function numToWord($num)
{
    $chiNum = array('零', '一', '二', '三', '四', '五', '六', '七', '八', '九');
    $chiUni = array('','十', '百', '千', '万', '亿', '十', '百', '千');

    $chiStr = '';

    $num_str = (string)$num;

    $count = strlen($num_str);
    $last_flag = true; //上一个 是否为0
    $zero_flag = true; //是否第一个
    $temp_num = null; //临时数字

    $chiStr = '';//拼接结果
    if ($count == 2) {//两位数
        $temp_num = $num_str[0];
        $chiStr = $temp_num == 1 ? $chiUni[1] : $chiNum[$temp_num].$chiUni[1];
        $temp_num = $num_str[1];
        $chiStr .= $temp_num == 0 ? '' : $chiNum[$temp_num];
    } elseif ($count > 2) {
        $index = 0;
        for ($i=$count-1; $i >= 0; $i--) {
            $temp_num = $num_str[$i];
            if ($temp_num == 0) {
                if (!$zero_flag && !$last_flag) {
                    $chiStr = $chiNum[$temp_num]. $chiStr;
                    $last_flag = true;
                }
            } else {
                $chiStr = $chiNum[$temp_num].$chiUni[$index%9] .$chiStr;

                $zero_flag = false;
                $last_flag = false;
            }
            $index ++;
        }
    } else {
        $chiStr = $chiNum[$num_str[0]];
    }
    return $chiStr;
}

/**
 * 转换字节表示方式
 */
function formatBytes(float $size, string $decimalPoint = ",", string $thousandsSeparator = " ") : string{
    static $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    foreach ($units as $unit) {
        if ($size < 1024) {
            break;
        }
        $size = $size / 1024;
    }
    $decimals = ('B' === $unit) || ('KB' === $unit) ? 0 : 1;
    return number_format($size, $decimals, $decimalPoint, $thousandsSeparator) . ' ' . $unit;
}

/**
 * 是否为一个合法的url
 * @param string $url
 * @return boolean
 */
function is_url($url){
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return true;
    }else {
        return false;
    }
}

/**
 * 是否为正整数
 * @param int $number
 * @return boolean
 */
function is_positive_number($number){
	if(preg_match('/^[0-9]*[1-9][0-9]*$/' ,$number)){
		return true;
	}else{
		return false;
	}
}

/**
 * 是否为正小数
 * @param float $number
 * @return boolean
 */
function is_positive_decimal($number){
	if(preg_match('/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/',$number)){
		return true;
	}else{
		return false;
	}
}

/**
 * 是否为一个合法的字符串
 * @param sting $str
 * @return boolean
 */
function is_valid_string($str){
    if (!is_string($str)) return false;  //是否是字符串类型
    if (empty($str)) return false;       //是否已设定
    if ($str=='') return false;          //是否为空
    return true;
}

/**
 * 是否为一个合法的数组
 * @param array $arr
 * @return boolean
 */
function is_valid_array($arr){
    if (!is_array($arr)) return false;
    if (empty($arr)) return false;
    if (count($arr) <= 0) return false;
    return true;
}

/**
 * 验证日期格式是否正确
 * @param string $date
 * @param string $format
 * @return boolean
 */
function is_date($date, $format = 'Y-m-d')
{
    $t = date_parse_from_format($format, $date);
    return empty($t['errors']);
}

function is_qq_number($qq) 
{
    return preg_match('/^[1-9][0-9]{4,14}$/', $qq) ? TRUE : FALSE;
}

function is_mobile($mobile)
{
    if (!is_numeric($mobile)) {
        return false;
    }
    return preg_match('#^1\d{10}$#', $mobile) ? true : false;
}

function is_email($email)
{
    return preg_match('#^[a-zA-Z0-9][a-zA-Z0-9._-]*\@[a-zA-Z0-9]+\.[a-zA-Z0-9\.]+$#', $email) ? true : false;
}

/**
 * 判断文本串是否为json格式
 * @param string $string
 * @return boolean
 */
function is_json($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
 }

function is_serialized($data){
    if (is_valid_string($data)){
        $data = trim($data);
        if ('N;' == $data)
            return true;
        if (!preg_match('/^([adObis]):/', $data, $bad))
            return false;
        switch ($bad[1]) {
            case 'a' :
            case 'O' :
            case 's' :
                if (preg_match("/^{$bad[1]}:[0-9]+:.*[;}]\$/s", $data))
                    return true;
                break;
            case 'b' :
            case 'i' :
            case 'd' :
                if (preg_match("/^{$bad[1]}:[0-9.E-]+;\$/", $data))
                    return true;
                break;
        }
    }
    return false;
}

/**
* 隔字隐藏字符
*/
function hide_char($str)
{
    $str_arr = str_split_unicode($str);
    array_walk($str_arr, function (&$val, $key) {
        if ($key % 2) $val = '*';
    });
    return implode('', $str_arr);
}

/**
 * 隐藏中间部分字符串
 * @param string $str
 * @param string $mark
 * @return string
 */
function hide_middle($str, $mark = '*')
{
    $str_arr = str_split_unicode($str);
    $hide_count = ceil(count($str_arr) / 2);        //隐藏的字符数量
    $show_count = count($str_arr) - $hide_count;    //显示的字符数量

    $left = ceil($show_count / 2);                  //左边显示的字符数量
    $right = floor($show_count / 2);                //右边显示的字符数量

    $fill = array_fill(0, $hide_count, $mark);
    array_splice($str_arr, $left, $hide_count, $fill);
    return implode('', $str_arr);
}

/**
* 拆分汉字字符
* @param string $str
* @param int $l
* @return array
*/
function str_split_unicode($str, $l = 0)
{
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

function unicodeDecode($data)
{
    function replace_unicode_escape_sequence($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }
    $rs = preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $data);
    return $rs;
}

function binary_search(array $a, $first, $last, $key, $compare) {
    $lo = $first;
    $hi = $last - 1;

    while ($lo <= $hi) {
        $mid = (int)(($hi - $lo) / 2) + $lo;
        $cmp = $compare($a[$mid], $key);

        if ($cmp < 0) {
            $lo = $mid + 1;
        } elseif ($cmp > 0) {
            $hi = $mid - 1;
        } else {
            return $mid;
        }
    }
    return -($lo + 1);
}

function time_tran($the_time)
{
    $now_time = time();
    $show_time = $the_time;
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        switch ($dur) {
            case $dur > 0 && $dur < 60:
                return $dur . '秒前';
            case $dur >= 60 && $dur < 3600:
                return floor($dur / 60) . '分钟前';
            case $dur >= 3600 && $dur < 86400:
                return floor($dur / 3600) . '小时前';
            case $dur >= 86400:
                return floor($dur / 86400) . '天前';
            default:
                break;
        }
    }
}

function mkdirs($dir, $mode = 0777)
{
    if (is_dir($dir) || @mkdir($dir, $mode)) {
        return true;
    }
    if (!mkdirs(dirname($dir), $mode)) {
        return false;
    }
    return @mkdir($dir, $mode);
}

/**
 * 对象转换为数组
 * @param object $object
 * @return array
 */
function objectToArray($object)
{
    if (!is_object($object) && !is_array($object)) {
        return $object;
    }
    return array_map('objectToArray', (array)$object);
}

/**
 * 数组转换为对象
 * @param array $array
 * @return object
 */
function arrayToObject($array) {
    if (gettype($array) != 'array') return;
    foreach($array as $k => $v) {
        if (gettype($v) == 'array' || getType($v) == 'object') $array[$k] = (object) arrayToObject($v);
    }
    return (object)$array;
}

function decimal_precision($number ,$precision = 2)
{
    ++$precision;
    return substr(sprintf("%0.{$precision}f", $number),0,-1);
}

/**
 * 随机生成一定长度的字符串
 * @param integer $length
 * @return string
 */
function quickRandom($length = 16)
{
    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}

/**
 * 获取网页中的charset
 * @param string $data
 * @return string|false
 */
function get_charset($data){
    if (preg_match("/<meta.+?charset=[^\w]?([-\w]+)/i", $data, $match)) {
        return $match[1];
    }
    return false;
}

/**
 * 校验身份证号码是否合格
 * @return bool
 */
function is_idCard($id)
{
    $id = strtoupper($id);
    $regex = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
    $arr_split = array();
    if (!preg_match($regex, $id)) {
        return false;
    }
    if (15==strlen($id)) { //检查15位
        $regex = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
        @preg_match($regex, $id, $arr_split);
        $dtm_birth = "19".$arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
        if (!strtotime($dtm_birth)) {
            return false;
        } else {
            return true;
        }
    } else {
        $regex = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
        @preg_match($regex, $id, $arr_split);
        $dtm_birth = $arr_split[2] . '/' . $arr_split[3]. '/' .$arr_split[4];
        if (!strtotime($dtm_birth)) {
            return false;
        } else {
            $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
            $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
            $sign = 0;
            for ($i = 0; $i < 17; $i++) {
                $b = (int) $id[$i];
                $w = $arr_int[$i];
                $sign += $b * $w;
            }
            $n = $sign % 11;
            $val_num = $arr_ch[$n];
            if ($val_num != substr($id, 17, 1)) {
                return false;
            } else {
                return true;
            }
        }
    }
}

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function numberAvg($number, $avgNumber)
{
    if ($number == 0) {
        $array = array_fill(0, $avgNumber, 0);
    } else {
        $avg     = floor($number / $avgNumber);
        $ceilSum = $avg * $avgNumber;
        $array   = array();
        for ($i = 0; $i < $avgNumber; $i++) {
            if ($i < $number - $ceilSum) {
                array_push($array, $avg + 1);
            } else {
                array_push($array, $avg);
            }
        }
    }
    return $array;
}

function unique_rand($min, $max, $num) {
    $count = 0;
    $return = array();
    while ($count < $num) {
        $return[] = mt_rand($min, $max);
        $return = array_flip(array_flip($return));
        $count = count($return);
    }
    shuffle($return);
    return $return;
}

function http_post_contents($url, $content, $timeout = 10){
    $header = array(
        "Content-Type: application/x-www-form-urlencoded",
        "Content-Length: " . strlen($content)
    );
    $options = array(
        'http' => array(
            'method' => 'POST',
            'content' => $content,
            'header' => implode("\r\n", $header),
            'timeout' => $timeout,
        )
    );
    return file_get_contents($url, false, stream_context_create($options));
}

function http_get_contents($url, $timeout = 10)
{
    $options = array(
        'http' => array(
            'method'  => "GET",
            'timeout' => $timeout
        )
    );
    return file_get_contents($url, false, stream_context_create($options));
}

function get_url_headers($url, $timeout = 5){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

    $data = curl_exec($ch);
    $data = preg_split('/\n/', $data);

    $data = array_filter(array_map(function ($data) {
        $data = trim($data);
        if ($data) {
            $data = preg_split('/:\s/', trim($data), 2);
            $length = count($data);
            switch ($length) {
                case 2:
                    return array($data[0] => $data[1]);
                case 1:
                    return $data;
                default:
                    break;
            }
        }
    }, $data));

    sort($data);

    foreach ($data as $key => $value) {
       
        /** @var array $value */
        $itemKey = array_keys($value)[0];
        if (is_int($itemKey)) {
            $data[$key] = $value[$itemKey];
        } elseif (is_string($itemKey)) {
            $data[$itemKey] = $value[$itemKey];
            unset($data[$key]);
        }
    }
    return $data;
}

//文本逻辑转逻辑值
function stringToBool($string){
    return (mb_strtoupper(trim( $string)) === mb_strtoupper ("true")) ? TRUE : FALSE;
}

//移除特殊控制字符
function rm_control_char($str)
{
    return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $str);
}

/**
 * PHP随机生成国内IP地址
 * @return string
 */
function rand_ip()
{
    $ip_long = array(
        array('607649792', '608174079'), //36.56.0.0-36.63.255.255
        array('975044608', '977272831'), //58.30.0.0-58.63.255.255
        array('999751680', '999784447'), //59.151.0.0-59.151.127.255
        array('1019346944', '1019478015'), //60.194.0.0-60.195.255.255
        array('1038614528', '1039007743'), //61.232.0.0-61.237.255.255
        array('1783627776', '1784676351'), //106.80.0.0-106.95.255.255
        array('1947009024', '1947074559'), //116.13.0.0-116.13.255.255
        array('1987051520', '1988034559'), //118.112.0.0-118.126.255.255
        array('2035023872', '2035154943'), //121.76.0.0-121.77.255.255
        array('2078801920', '2079064063'), //123.232.0.0-123.235.255.255
        array('-1950089216', '-1948778497'), //139.196.0.0-139.215.255.255
        array('-1425539072', '-1425014785'), //171.8.0.0-171.15.255.255
        array('-1236271104', '-1235419137'), //182.80.0.0-182.92.255.255
        array('-770113536', '-768606209'), //210.25.0.0-210.47.255.255
        array('-569376768', '-564133889'), //222.16.0.0-222.95.255.255
    );
    $rand_key = mt_rand(0, 14);
    $ip = long2ip(mt_rand($ip_long[$rand_key][0], $ip_long[$rand_key][1]));
    return $ip;
}

function os_info($ua){
    $oses = array(
        'Windows' => 'Windows',
        'OpenBSD' => 'OpenBSD',
        'SunOS'   => 'SunOS',
        'Ubuntu'  => 'Ubuntu',
        'Android' => 'Android',
        'Linux'   => '(Linux)|(X11)',
        'iPhone'  => 'iPhone',
        'iPad'    => 'iPad',
        'MacOS'   => '(Mac_PowerPC)|(Macintosh)',
        'QNX'     => 'QNX',
        'BeOS'    => 'BeOS',
        'OS2'     => 'OS/2',
    );
    foreach ($oses as $os => $pattern)
        if (preg_match('/' . $pattern . '/i', $ua))
            return $os;
    return 'Unknown';
}

function number_format_($number,$decimals = 2){
    return sprintf("%.{$decimals}f",$number);
}

function isValidTimestamp($timestamp){
    return ((string)(int)$timestamp === $timestamp)
        && ($timestamp <= PHP_INT_MAX)
        && ($timestamp >= ~PHP_INT_MAX);
}

function  createIdentityCode(){
    $dict = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $scale = 62;

    $uniqid = str_replace('.', '', uniqid('', true));
    $serial = crc32(rtrim(chunk_split($uniqid, 6, '-'), '-'));

    $identity = '';

    do {
        $identity = $dict[bcmod($serial, $scale)] . $identity;
        $serial = bcdiv($serial, $scale);
    } while ($serial > 0);

    return $identity;
}

/**
 * 是否是银行号
 * @param $str
 * @return bool
 */
function is_bank($str){
    $pattern = '/^[1-9][\d]{5,18}$/';
    return preg_match($pattern, $str);
}

/**
 * Generate a querystring url for the application.
 *
 * Assumes that you want a URL with a querystring rather than route params
 * (which is what the default url() helper does)
 *
 * @param  string  $path
 * @param  mixed   $qs
 * @param  bool    $secure
 * @return string
 */
function qs_url($path = null, $qs = array(), $secure = null)
{
    $url = app('url')->to($path, $secure);
    if (count($qs)){
        foreach($qs as $key => $value){
            $qs[$key] = sprintf('%s=%s',$key, urlencode($value));
        }
        $url = sprintf('%s?%s', $url, implode('&', $qs));
    }
    return $url;
}

function division($a, $b)
{
    $c = @($a / $b);
    if ($b === 0)
        $c = null;
    return $c;
}

function ip_addr($ip)
{
    require_once(__DIR__.'/ip/ip.php');
    return (new ip())->ip2addr($ip);
}