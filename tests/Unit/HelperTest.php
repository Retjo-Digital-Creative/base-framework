<?php

namespace Tests\Unit;

use \App\Helpers\FormatHelper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * Date Format Helper
     *
     * @return void
     */
    public function test_date_1()
    {
        $date = "12-12-2002";
        $fmt = FormatHelper::date($date);
        $this->assertTrue($fmt === '12 Desember 2002');
    }
    public function test_date_2()
    {
        $date = "8-06-2002";
        $fmt = FormatHelper::date($date,'m d, Y');
        $this->assertTrue($fmt === 'Juni 08, 2002');
    }
    public function test_date_3()
    {
        $date = "12-";
        $fmt = FormatHelper::date($date, 'Y-m-d');
        $this->assertTrue($fmt === '-');
    }
    public function test_date_4()
    {
        $date = null;
        $fmt = FormatHelper::date($date, 'Y-m-d');
        $this->assertTrue($fmt === '-');
    }
    public function test_date_5()
    {
        $date = 123;
        $fmt = FormatHelper::date($date, 'Y-m-d');
        $this->assertTrue($fmt === '-');
    }

    /**
     * Currency Format Helper
     *
     * @return void
     */
    public function test_currency_1()
    {
        $money = 4000;
        $fmt = FormatHelper::currency($money);
        $this->assertTrue($fmt === 'Rp 4.000');
    }
    public function test_currency_2()
    {
        $money = 40;
        $fmt = FormatHelper::currency($money, '$', '00');
        $this->assertTrue($fmt === '$ 40 00');
    }
    public function test_currency_3()
    {
        $money = "aaa";
        $fmt = FormatHelper::currency($money, '');
        $this->assertTrue($fmt === '-');
    }
    public function test_currency_4()
    {
        $money = null;
        $fmt = FormatHelper::currency($money);
        $this->assertTrue($fmt === '-');
    }
    public function test_currency_5()
    {
        $money = 0;
        $fmt = FormatHelper::currency($money);
        $this->assertTrue($fmt === 'Rp 0');
    }

    /**
     * Datetime Format Helper
     */

    public function test_datetime_1()
    {
        $date = "2020-07-14 15:50:37";
        $fmt = FormatHelper::datetime($date);
        $this->assertTrue($fmt === '03:50 PM, 14 Juli 2020');
    }
    public function test_datetime_2()
    {
        $date = "2020-07-14 23:50:37";
        $fmt = FormatHelper::datetime($date,false);
        $this->assertTrue($fmt === '23:50 AM, 14 Juli 2020');
    }
    public function test_datetime_3()
    {
        $date = "2020-07-14 23:50:37";
        $fmt = FormatHelper::datetime($date,false,'m d, Y');
        $this->assertTrue($fmt === '23:50 AM, Juli 14, 2020');
    }
    public function test_datetime_4()
    {
        $date = "2020-07-14";
        $fmt = FormatHelper::datetime($date);
        $this->assertTrue($fmt === '12:00 AM, 14 Juli 2020');
    }
    public function test_datetime_5()
    {
        $date = "23:50:37";
        $fmt = FormatHelper::datetime($date);
        $now = date('d-m-Y');

        $this->assertTrue($fmt === '11:50 PM, '. FormatHelper::date($now) );
    }
}
