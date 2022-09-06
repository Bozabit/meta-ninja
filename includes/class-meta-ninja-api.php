<?php

/**
 * The API Endpoints for REST Communication
 *
 * A class that registers and checks all te RESTful endpoints
 * communication to use with the react application
 * 
 * @link       https://luckyseed.io/people/bozabit
 * @since      1.0.0
 *
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/includes
 */

/**
 * The API Endpoints for REST Communication
 *
 * A class that registers and checks all te RESTful endpoints
 * communication to use with the react application
 *
 * @since      1.0.0
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/includes
 * @author     bozabit <bozabit@luckyseed.io>
 */
class Meta_Ninja_API
{

    /**
     *
     * Adds Api Routes.
     * 
     * Register all the routes needed for RESTfull communication
     * 
     * @since       1.0.0
     * 
     */
    public function __construct()
    {
    }


    public function add_api_routes()
    {

        register_rest_route(
            'meta-ninja',
            '/settings',
            array(
                'methods' => 'GET',
                'callback' => array($this, 'get_meta_data'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );
    }

    public function check_permissions()
    {
        return true;
    }

    public function get_alternativos_by_product(WP_REST_Request $request)
    {
    }
}