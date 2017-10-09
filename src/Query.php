<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 19.05.17
 * Time: 15:58
 */

namespace Kladr;

class Query
{

    private $request = [];

    public function __construct( $token )
    {
        /*if ( empty( $token ) ) {
            abort( 400, 'Token is empty' );
        }*/

        $this->request[ 'token' ] = $token;
    }

    /**
     * Что искать
     *
     * @param $name
     *
     * @return $this
     */
    public function find( $name )
    {
        $this->request[ 'query' ] = $name;

        return $this;
    }

    /**
     * Что искать
     *
     * @param $name
     *
     * @return $this
     */
    public function findByZip( $name )
    {
        $this->request[ 'zip' ] = $name;

        return $this;
    }

    /**
     * Объект для поиска
     *
     * @param $type
     *
     * @return $this
     */
    public function type( $type )
    {
        $this->request[ 'contentType' ] = $type;

        return $this;
    }

    public function parent( $name, $value )
    {
        $this->request[ mb_convert_case( $name, MB_CASE_LOWER ) . 'Id' ] = $value;

        return $this;
    }

    /**
     * Set option cURL request (timeout, ssl_verify, etc..)
     *
     * @return $this
     */
    public function options()
    {
        $args = func_get_args();

        $options = [];

        if ( is_array( $args[ 0 ] ) ) {
            foreach ( $args[ 0 ] as $key => $value )
                $options[ $key ] = $value;
        }
        else {
            $options[ $args[ 0 ] ] = $args[ 1 ];
        }

        $this->request += $options;

        return $this;
    }

    public function __get( $name )
    {
        if ( array_key_exists( $name, $this->request ) ) {
            return $this->request[ $name ];
        }

        if ( $name=='request' ) {
            return $this->request;
        }

        return null;
    }
}