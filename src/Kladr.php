<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 19.05.17
 * Time: 15:06
 */

namespace Kladr;

use Illuminate\Support\Facades\Config;
use Requester\Http;
use Requester\Request;


/**
 * Class Kladr
 *
 * @method Query find
 */
class Kladr
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
        $this->query = new Query( $config['secret-key'] );

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
        if ( method_exists( $this->query, $name ) ) {
            call_user_func_array( [ $this->query, $name ], $arguments );

            return $this;
        }

        //throw new MethodNotFoundException( 'Method not found', 'Query', $name );
    }
}