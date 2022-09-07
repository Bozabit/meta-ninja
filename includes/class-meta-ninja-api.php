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
    protected $_operations;
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
        $this->_operations = new Meta_Ninja_Operations();
    }


    public function add_api_routes()
    {
        $this->_register_user_routes();
        $this->_register_post_routes();
        $this->_register_bulk_operations_routes();
    }

    private function _register_bulk_operations_routes()
    {
        register_rest_route(
            'meta-ninja',
            '/bulk-trash-post-key',
            array(
                'methods' => 'POST',
                'callback' => array($this, 'bulk_trash_post_key'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );
        register_rest_route(
            'meta-ninja',
            '/bulk-permanent-delete-post-key',
            array(
                'methods' => 'POST',
                'callback' => array($this, 'bulk_permanent_delete_post_key'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );

        register_rest_route(
            'meta-ninja',
            '/bulk-key-with-id-value',
            array(
                'methods' => 'POST',
                'callback' => array($this, 'bulk_key_with_id_value'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );
    }

    private function _register_user_routes()
    {
        register_rest_route(
            'meta-ninja',
            '/get-user-meta',
            array(
                'methods' => 'POST',
                'callback' => array($this, 'get_user_data'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );
    }

    private function _register_post_routes()
    {
        register_rest_route(
            'meta-ninja',
            '/get-post-meta',
            array(
                'methods' => 'POST',
                'callback' => array($this, 'get_post_data'),
                'permission_callback' => array($this, 'check_permissions')
            )
        );

        register_rest_route(
            'meta-ninja',
            '/post-meta',
            array(
                array(
                    'methods' => 'POST',
                    'callback' => array($this, 'update_post_meta_value'),
                    'permission_callback' => array($this, 'check_permissions')
                ),
                array(
                    'methods' => 'DELETE',
                    'callback' => array($this, 'delete_post_meta_value'),
                    'permission_callback' => array($this, 'check_permissions')
                )
            )
        );
    }


    public function check_permissions()
    {
        return true;
    }

    public function bulk_key_with_id_value(WP_REST_Request $request)
    {
        $body = json_decode($request->get_body());

        if (!$body->metaKey) return rest_ensure_response("metaKey is a required field");
        if (!$body->idValues) return rest_ensure_response("idValues is a required field");

        $response =  $this->_operations->bulk_key_with_id_value($body->metaKey, $body->idValues, $body->idType);

        return $response;
    }

    public function bulk_trash_post_key(WP_REST_Request $request)
    {
        $body = json_decode($request->get_body());

        if (!$body->metaKey) return rest_ensure_response("metaKey is a required field");

        $response = $this->_operations->bulk_trash_post_key($body->metaKey);

        return rest_ensure_response(array("affected rows" => $response));
    }

    public function bulk_permanent_delete_post_key(WP_REST_Request $request)
    {
        $body = json_decode($request->get_body());

        if (!$body->metaKey) return rest_ensure_response("metaKey is a required field");

        $response = $this->_operations->bulk_permanent_delete_post_key($body->metaKey);

        return rest_ensure_response(array("affected rows" => $response));
    }

    public function update_post_meta_value(WP_REST_Request $request)
    {

        $body = json_decode($request->get_body());

        if (!$body->postId) return rest_ensure_response("postId is a required field");
        if (!$body->metaKey) return rest_ensure_response("metaKey is a required field");
        if (!$body->value) return rest_ensure_response("value is a required field");

        $response = $this->_operations->update_post_meta_value($body->postId, $body->metaKey, $body->value);
        return rest_ensure_response(array("meta_data_updated" => $response));
    }
    public function delete_post_meta_value(WP_REST_Request $request)
    {
        $body = json_decode($request->get_body());

        if (!$body->postId) return rest_ensure_response("postId is a required field");
        if (!$body->metaKey) return rest_ensure_response("metaKey is a required field");

        $response  = $this->_operations->delete_post_meta_value($body->postId, $body->metaKey);
        return rest_ensure_response(array("meta_data_deleted" => $response));
    }

    public function get_post_data(WP_REST_Request $request)
    {
        $body = json_decode($request->get_body());

        if (!$body->postId) return rest_ensure_response("postId is required");

        $_id = $body->postId;
        $response = array();

        $response['type'] = $this->_operations->get_meta_post_type($_id, $body->idType);
        $response['data'] = $this->_operations->get_data($_id, $body->metaKey, 'post', $body->idType);

        return rest_ensure_response($response);
    }

    public function get_user_data(WP_REST_Request $request)
    {
        $body = json_decode($request->get_body());

        if (!$body->userId) return rest_ensure_response("userId is required");

        $_id = $body->userId;
        $response = array();

        $response['type'] = "user";
        $response['data'] = $this->_operations->get_data($_id, $body->metaKey, 'user');

        return rest_ensure_response($response);
    }
}