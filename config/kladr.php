<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 18.05.17
 * Time: 13:31
 */

return [

    'kladr' => [

        'url'        => 'http://kladr-api.ru/api.php',
        'secret-key' => '',

        'log' => [
            'enabled' => env( 'KLADR_LOG', true ),
            'driver'  => [
                'class'   => \Requester\Logger\Develop::class,
                'options' => [
                    'channel' => 'kladr',
                    'path'    => env( 'KLADR_PATH', storage_path( 'logs/kladr/' . date( 'Y/m/d' ) ) ),
                ],
            ],
        ],

    ],

];