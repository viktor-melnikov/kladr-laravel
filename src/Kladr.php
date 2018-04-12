<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 19.05.17
 * Time: 15:06
 */

namespace Kladr;

/**
 * Class Kladr
 *
 * @method Query find
 */
class Kladr
{
    private $api = null;

    public function __construct()
    {
        $this->api = new KladrApi( config( 'kladr' ) );
    }

    public function search( $q = null, $type = null, $parent_id = null, $parent_type = ObjectType::Region )
    {
        $search = $this->api->find( $q )->type( $type );

        if ( $parent_id )
        {

            if ( str_contains( $parent_id, ';' ) )
            {
                $parent_id = explode( ';', $parent_id )[ 0 ];
            }

            $search = $search->parent( $parent_type, (string)$parent_id );
        }

        $search = $search->options( [
                                        'limit' => 15,
                                        //'WithParent' => true
                                    ] )->get();

        $data = [];

        dd($search[ 'result' ]);

        foreach ( $search[ 'result' ] as $item )
        {
            $data[] = [
                'text' => isset( $item[ 'type' ] ) ? $item[ 'name' ] . ' ' . $item[ 'type' ] : $item[ 'name' ],
                'id'   => $item[ 'id' ] . ';' . $item[ 'name' ] . ';' . $item[ 'type' ],
            ];
        }

        return response()->json( [ 'q' => $q, 'results' => $data ] );
    }
}
