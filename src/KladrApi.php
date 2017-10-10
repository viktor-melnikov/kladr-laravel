<?php
/**
 * Created by viktor.
 * E-mail: vik.melnikov@gmail.com
 * GitHub: Viktor-Melnikov
 * Date: 10.10.2017
 */

namespace Kladr;

use Kladr\Handler\KladrHandler;
use Requester\Http;
use Requester\Request;

class KladrApi
{
    protected $request;

    private $query = null;

    /**
     * PepsicoCrm constructor.
     *
     * @param $config
     */
    public function __construct( $config )
    {
        $this->query = new Query();

        $this->request = ( new Request() )
            ->setMethod( Http::GET )
            ->setConfig( $config )
            ->setHandler( KladrHandler::class );
    }

    public function get()
    {
        return $this->request
            ->setAlias( 'kladr_' . $this->query->contentType )
            ->body( $this->query->request )
            ->send();
    }

    public function __call( $name, $arguments )
    {
        if ( method_exists( $this->query, $name ) )
        {
            call_user_func_array( [ $this->query, $name ], $arguments );

            return $this;
        }

        //throw new MethodNotFoundException( 'Method not found', 'Query', $name );
    }
}