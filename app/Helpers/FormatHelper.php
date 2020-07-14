<?php
namespace App\Helpers;

class FormatHelper
{
    /**
     * Format currency
     *
     * @param int $val
     * @param string $prefix
     * @return string
     */
    public static function currency($val, $prefix = "Rp", $suffix = "")
    {
        if ($val == null || gettype($val) != 'integer') {
            if((string)$val !== "0"){
                return "-";
            }
        }

        $val = strrev(join(".", str_split(
            strrev(
                (string) $val
            ), 3)));

        if ($suffix != "") {
            $val .= " " . $suffix;
        }

        return $prefix . " " . $val;
    }

    /**
     * Format date
     *
     * @param string $date
     * @param string $format
     * @return string $result
     */
    public static function date($date, $format = 'd m Y')
    {
        if( $date == null  || gettype($date) !== "string" ) return "-";
        $val = strtotime($date);
        
        if($val == null) return "-";

        $val = date('d-m-Y', $val);

        $date = explode('-', $val);

        $bulan = array(1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );
        $result = str_replace('d', $date[0], $format); //date
        $result = str_replace('m', $bulan[(int) $date[1]], $result); //month
        $result = str_replace('Y', $date[2], $result); //year

        return $result;

    }

    /**
     * Format datetime
     *
     * @param string $date -> Y-m-d H:i:s
     * @param boolean $militarytime
     * @param string $format
     * @return string $result
     */
    public static function datetime($date,$militarytime = true, $format = 'd m Y')
    {
        if( $date == null || gettype($date) !== "string" ) return "-";
        
        $val = strtotime($date);

        $date = date('d-m-Y',$val);
        $date = self::date($date,$format);
        
        $fmt = 'h:i A';
        if( !$militarytime ) $fmt = "H:i";
        
        $times = date($fmt, $val);
        
        if( !$militarytime ) $times .= " AM";

        return $times . ", " . $date;
    }

}
