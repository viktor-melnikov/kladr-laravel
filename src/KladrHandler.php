<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 18.05.17
 * Time: 13:30
 */

namespace Kladr;

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

        /*$this->log->add( 'Отправляется запрос в Kladr... ' . $this->aliasLogString() . ' ' . $this->hashLogString(), [
            'payload' => $converted,
            'alias'   => $this->request->alias,
            'hash'    => $this->request->hash,
            'method'  => $this->request->method,
            'headers' => $this->request->headers,
            'options' => $this->request->options,
        ] );*/

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
        /*$this->log->add( 'Получен ответ из Kladr... ' . $this->aliasLogString() . ' ' . $this->hashLogString(), [
            'response' => (string)$body,
            'alias'    => $this->request->alias,
        ] );*/

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
        /*$this->log->add( 'Получен ответ из Kladr с ошибкой... ' . $this->aliasLogString() . ' ' . $this->hashLogString(), [
            'response' => $message,
            'alias'    => $this->request->alias,
        ] );*/

        throw new ErrorException( 'При выполнении запроса "' . $this->request->alias . '" произошла ошибка, ' . $message, 400 );
    }
}