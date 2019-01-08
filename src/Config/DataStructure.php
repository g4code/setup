<?php

namespace G4\Setup\Config;

use G4\Setup\ParamsConsts;

class DataStructure
{

    public static function getMysqlData()
    {
        return [
            'resources' => [
                'db' => [
                    'adapter'               => 'PDO_mysql',
                    'charset'               => 'utf8',
                    'wrap_in_transactions'  => true,
                    'params' => [
                        'host'              => '10.20.0.10',
                        'port'              => 3306,
                        'dbname'            => ParamsConsts::REQUEST_INPUT,
                        'username'          => ParamsConsts::REQUEST_INPUT,
                        'password'          => ParamsConsts::REQUEST_INPUT,
                        'charset'           => 'utf8',
                        'driver_options'    => [
                            1002 => 'SET NAMES utf8mb4;'
                        ]
                    ]
                ]
            ]
        ];
    }
}