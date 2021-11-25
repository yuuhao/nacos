<?php
namespace tests;

use Yoka\Nacos\Nacos;

class NacosTest
{
    public function init()
    {
        return Nacos::init('xx','xx','xx','xx','xx')->runOnce();
    }
}