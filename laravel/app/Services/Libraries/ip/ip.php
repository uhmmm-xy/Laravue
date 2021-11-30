<?php
class ip
{
    var $fh;
    var $first;
    var $last;
    var $total;

    function __construct()
    {
        $this->fh = fopen(__DIR__ . "/qqwry.dat", 'rb');
        $this->first = $this->getLong4();
        $this->last = $this->getLong4();
        $this->total = ($this->last - $this->first) / 7;
    }

    function checkIp($ip)
    {
        $arr = explode('.', $ip);
        if (count($arr) != 4) {
            return false;
        }
        else {
            for ($i = 0; $i < 4; $i++) {
                if ($arr[$i] < '0' || $arr[$i] > '255') {
                    return false;
                }
            }
        }
        return true;
    }

    function getLong4()
    {
        $result = unpack('Vlong', fread($this->fh, 4));
        return $result['long'];
    }

    function getLong3()
    {
        $result = unpack('Vlong', fread($this->fh, 3) . chr(0));
        return $result['long'];
    }

    function getInfo($data = "")
    {
        $char = fread($this->fh, 1);
        while (ord($char) != 0) {
            $data .= $char;
            $char = fread($this->fh, 1);
        }
        return $data;
    }

    function getArea()
    {
        $byte = fread($this->fh, 1);
        switch (ord($byte)) {
            case 0 :
                $area = '';
                break;
            case 1 :
                fseek($this->fh, $this->getLong3());
                $area = $this->getInfo();
                break;
            case 2 :
                fseek($this->fh, $this->getLong3());
                $area = $this->getInfo();
                break;
            default :
                $area = $this->getInfo($byte);
                break;
        }
        return $area;
    }

    function ip2addr($ip)
    {
        if (!$this->checkIp($ip)) {
            return false;
        }

        $ip = pack('N', intval(ip2long($ip)));

        $l = 0;
        $r = $this->total;

        while ($l <= $r) {
            $m = floor( ($l + $r) / 2);
            fseek($this->fh, $this->first + $m * 7);
            $beginip = strrev(fread($this->fh, 4));
            fseek($this->fh, $this->getLong3());
            $endip = strrev(fread($this->fh, 4));

            if ($ip < $beginip) {
                $r = $m - 1;
            }
            else {
                if ($ip > $endip) {
                    $l = $m + 1;
                }
                else {
                    $findip = $this->first + $m * 7;
                    break;
                }
            }
        }

        fseek($this->fh, $findip);
        $location['beginip'] = long2ip($this->getLong4());
        $offset = $this->getlong3();
        fseek($this->fh, $offset);
        $location['endip'] = long2ip($this->getLong4());
        $byte = fread($this->fh, 1);
        switch (ord($byte)) {
            case 1 :
                $countryOffset = $this->getLong3();
                fseek($this->fh, $countryOffset);
                $byte = fread($this->fh, 1);
                switch (ord($byte)) {
                    case 2 :
                        fseek($this->fh, $this->getLong3());
                        $location['country'] = $this->getInfo();
                        fseek($this->fh, $countryOffset + 4);
                        $location['area'] = $this->getArea();
                        break;
                    default :
                        $location['country'] = $this->getInfo($byte);
                        $location['area'] = $this->getArea();
                        break;
                }
                break;

            case 2 :
                fseek($this->fh, $this->getLong3());
                $location['country'] = $this->getInfo();
                fseek($this->fh, $offset + 8);
                $location['area'] = $this->getArea();
                break;

            default :
                $location['country'] = $this->getInfo($byte);
                $location['area'] = $this->getArea();
                break;
        }

        foreach ($location as $k => $v) {
            $location[$k] = str_replace('CZ88.NET', '', iconv('gb2312', 'utf-8', $v));
        }

        return $location;
    }

    function __destruct()
    {
        fclose($this->fh);
    }
}
?>