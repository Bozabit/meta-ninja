<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://luckyseed.io/people/bozabit
 * @since      1.0.0
 *
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Meta_Ninja
 * @subpackage Meta_Ninja/includes
 * @author     Bozabit <bozabit@luckyseed.com>
 */
class Meta_Ninja_Operations
{

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
	}

	public function get_meta_post_type($id, $idType = 'post_id')
	{
		$_id = $this->_get_id($id, $idType);
		return get_post_type($_id);
	}

	public function get_data($id, $meta_key, $meta_type = 'post', $idType = 'post_id')
	{
		$_id = $this->_get_id($id, $idType);
		if ($meta_key) :
			return array("{$meta_key}" => get_metadata($meta_type, $_id, $meta_key, true));
		else :
			return get_metadata($meta_type, $_id);
		endif;
	}

	public function update_post_meta_value($id, $meta_key, $value)
	{
		return update_post_meta($id, $meta_key, $value);
	}

	public function delete_post_meta_value($id, $meta_key)
	{
		return delete_post_meta($id, $meta_key);
	}

	public function bulk_trash_post_key($meta_key)
	{
		global $wpdb;

		$result = $wpdb->get_results("SELECT * from {$wpdb->prefix}postmeta where meta_key = '{$meta_key}'");
		$records = count($result);
		if ($records > 0) {
			$trash_key = "_meta_ninja_trash_{$meta_key}";
			foreach ($result as $row) {
				$_id = $row->post_id;
				$current_value = get_post_meta($_id, $meta_key, true);
				update_post_meta($_id, $trash_key, $current_value);
				delete_post_meta($_id, $meta_key);
			}
		}

		wp_reset_postdata();

		return $records;
	}

	public function bulk_permanent_delete_post_key($meta_key)
	{
		global $wpdb;

		$result = $wpdb->get_results("SELECT * from {$wpdb->prefix}postmeta where meta_key = '{$meta_key}'");
		$records = count($result);
		if ($records > 0) {
			foreach ($result as $row) {
				$_id = $row->post_id;
				delete_post_meta($_id, $meta_key);
			}
		}

		wp_reset_postdata();

		return $records;
	}

	public function bulk_key_with_id_value($key, $id_values_object, $id_type = 'post_id')
	{
		$records = 0;
		foreach ($id_values_object as $id => $value) {
			$_id = $this->_get_id($id, $id_type);

			update_post_meta($_id, $key, $value);
			$records++;
		}
		return $records;
	}

	protected function _get_id($id, $id_type)
	{
		switch ($id_type) {
			case 'sku':
				return wc_get_product_id_by_sku($id);
			case 'post_id':
				return $id;
			default:
				return $id;
				break;
		}
	}
}