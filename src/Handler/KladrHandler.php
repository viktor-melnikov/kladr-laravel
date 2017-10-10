<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 18.05.17
 * Time: 13:30
 */

namespace Kladr\Handler;

use ErrorException;
use Requester\Handler\DefaultHandler;

class KladrHandler extends DefaultHandler
{
    /**
     * Сериализует body (payload) в строку для запроса.
     * Все что передали в метод body, попадет сюда.
     *
     * @param mixed $payload
     *
     * @return string
     */
    public function serialize( $payload )
    {
        $converted = $payload;

        return $converted;
    }

    /**
     * Парсит API Response и возвращает нормальные данные
     *
     * @param string $body
     *
     * @return mixed
     */
    public function parse( $body )
    {
        $parsed = json_decode( $body, true );

        return $parsed;
    }

    /**
     * обработчик ошибок реквеста
     *
     * @param       $message
     * @param array $context
     *
     * @return mixed
     * @throws ErrorException
     */
    public function error( $message, array $context = [] )
    {
        throw new ErrorException( 'При выполнении запроса "' . $this->request->alias . '" произошла ошибка, ' . $message, 400 );
    }
}