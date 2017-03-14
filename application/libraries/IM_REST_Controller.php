<?php
/**
* Voji API controller
*
* @author mvh 3/20/2015
* @copyright Grooters Productions
*
*/

require_once(APPPATH.'/libraries/REST_Controller.php');

class IM_REST_controller extends REST_Controller {

	protected $user_id;	

	// all API calls that do not require user credentials   
	// format class->method 
	protected $exempt_from_login = array(
            'adminLogin->login',
            'adminDashboard->dashboard',
            'adminUser->users',
            'adminUser->addUser',
            'adminUser->updateUser',
            'adminUser->userDetails',
            'adminUser->exportUsers',
            'adminUser->changeStatus',
            'adminUser->uploadAvatar',
            'adminUser->assignCluster',
            'adminOrder->orders',
            'adminOrder->ordersDetails',
            'adminOrder->exportOrders',
            'adminPayments->paymentsFromCustomers',
            'adminPayments->exportPaymentsFromCustomers',
            'adminPayments->paymentsToDrivers',
            'adminPayments->paymentPendingOrders',
            'adminPayments->processPayment',
            'adminPayments->exportPendingPayments',
            'adminPayments->completedDriverpayments',
            'adminPayments->paymentCompletedOrders',
            'adminCustomerSupport->tickets',
            'adminCustomerSupport->updateSolution',
            'adminCustomerSupport->changeTicketStatus',
            'adminCustomerSupport->exportTickets',
            'adminSettings->settings',
            'adminSettings->updateSettings',
            'adminSettings->paymentSettings',
            'adminSettings->updatePaymentSettings',
            'adminSettings->rideRates',
            'adminSettings->newRideRate',
            'adminSettings->updateRideRate',
            'adminSettings->deliveryRates',
            'adminSettings->newDeliveryRate',
            'adminSettings->updateDeliveryRate',
            'adminSettings->exportDeliveryRates',
            'adminSettings->importDeliveryRates',
            'adminSettings->discountOnDelivery',
            'adminSettings->newDiscountOnDelivery',
            'adminSettings->updateDiscountOnDelivery',
            'adminSettings->exportDiscountOnDelivery',
            'adminSettings->importDiscountOnDelivery',
            'adminLocalization->countries',
            'adminLocalization->newCountry',
            'adminLocalization->updateCountry',
            'adminLocalization->states',
            'adminLocalization->newState',
            'adminLocalization->updateState',
            'adminLocalization->cities',
            'adminLocalization->newCity',
            'adminLocalization->updateCity',
            'adminLocalization->zones',
            'adminLocalization->newZone',
            'adminLocalization->updateZone',
            'adminLocalization->clusters',
            'adminLocalization->newCluster',
            'adminLocalization->updateCluster',
            'adminSettings->adminUsers',
            'adminSettings->addAdminUser',
            'adminSettings->adminUserDetails',
            'adminSettings->updateAdminUser',
            'adminSettings->changePassword',
            'adminSettings->documents',
        );

       

	function __construct() {
		parent::__construct();
	}

	function index() { 
		redirect('/');
	}

	/**
	 * respond with error text
	 */
	function api_respond_with_error($msg,$data = '') {

		log_message('debug', 'API error response sent: '.$msg);

		$this->response(array( 'type' => $data,
 			config_item('rest_status_field_name') => false,
			config_item('rest_message_field_name') => $msg
		), 200);
	}

	/**
	 * override _log_request to remove base64 encoding
	 */
	function _log_request($authorized = false)
	{
		// don't log all the data for base64 strings
		if ($this->_args) {
			$args = json_decode(json_encode($this->_args),true);
			foreach ($args as $key=>$val) {
				if (is_string($val)) {
					if (preg_match('/data:([^;]*);base64,(.*)/', $val, $matches) || contains($key,'base64')) {
						$args[$key] = substr($val,0,100);
					}
				}
			}
		} else {
			$args=null;
		}

		$status = $this->rest->db->insert(config_item('rest_logs_table'), array(
					'uri' => $this->uri->uri_string(),
					'method' => $this->request->method,
					'params' => $args ? (config_item('rest_logs_json_params') ? json_encode($args) : serialize($args)) : null,
					'api_key' => isset($this->rest->key) ? $this->rest->key : '',
					'ip_address' => $this->input->ip_address(),
					'time' => function_exists('now') ? now() : time(),
					'authorized' => $authorized
				));

		$this->_insert_id = $this->rest->db->insert_id();

		return $status;
	}

	/**
	 * override _prepare_basic_auth() function to check our voji user table
	 */
	function _prepare_basic_auth()
	{
		// If whitelist is enabled it has the first chance to kick them out
		if (config_item('rest_ip_whitelist_enabled')) {
			$this->_check_whitelist_auth();
		}

		// check credentials (if required)
		if  (!in_array($this->router->class."->".$this->router->method, $this->exempt_from_login)) {
			
			$headers = apache_request_headers();
			$accessKey = isset($headers['accessKey']) ? $headers['accessKey'] : '';

			// last ditch effort
			if (!$accessKey) $accessKey = $this->input->get_post('accessKey');			

			// check session data (for people already logged in on website)
			if (!$accessKey) {
				$this->response(array(
						config_item('rest_status_field_name') => FALSE,
						config_item('rest_message_field_name') => 'User not authorized'
					), 401);
			}else{
				$this->load->model('accesskey_model');
				if ( $accessKey_data = $this->accesskey_model->checkAccessKey($accessKey)) {
					if($accessKey_data['status'] == TRUE){
						$this->user_id = $accessKey_data['userid'];						
					}else{
						log_message('debug', $accessKey_data['msg']);
						$this->response(array(
							config_item('rest_status_field_name') => FALSE,
							config_item('rest_message_field_name') => $accessKey_data['msg']
						), 401);
					}					
				}
			}			
		}
	}

	/**
	 * override _detect_api_key() function to disable requiring API key for non-cross-domain requests
	 */
	function _detect_api_key()
	{
		// added by MVH 7/13/2015 to disable requiring API key for non-cross-domain requests
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			log_message('debug', 'Local request - API key not needed');
			$_SERVER['HTTP_X_API_KEY']='WPHO1E8KFKC00C4JCGXINFGSFBRWAYYK19IGZ4DH';
		}

		// Get the api key name variable set in the rest config file
		$api_key_variable = config_item('rest_key_name');

		// Work out the name of the SERVER entry based on config
		$key_name = 'HTTP_'.strtoupper(str_replace('-', '_', $api_key_variable));

		$this->rest->key = null;
		$this->rest->level = null;
		$this->rest->user_id = null;
		$this->rest->ignore_limits = false;

		// Find the key from server or arguments
		if (($key = isset($this->_args[$api_key_variable]) ? $this->_args[$api_key_variable] : $this->input->server($key_name))) {
			if ( ! ($row = $this->rest->db->where(config_item('rest_key_column'), $key)->get(config_item('rest_keys_table'))->row())) {
				return false;
			}

			$this->rest->key = $row->{config_item('rest_key_column')};

			isset($row->user_id) and $this->rest->user_id = $row->user_id;
			isset($row->level) and $this->rest->level = $row->level;
			isset($row->ignore_limits) and $this->rest->ignore_limits = $row->ignore_limits;

			$this->_apiuser =  $row;

			/*
			 * If "is private key" is enabled, compare the ip address with the list
			 * of valid ip addresses stored in the database.
			 */
			if (!empty($row->is_private_key)) {
				// Check for a list of valid ip addresses
				if (isset($row->ip_addresses)) {
					// multiple ip addresses must be separated using a comma, explode and loop
					$list_ip_addresses = explode(",", $row->ip_addresses);
					$found_address = false;

					foreach ($list_ip_addresses as $ip_address) {
						if ($this->input->ip_address() == trim($ip_address)) {
							// there is a match, set the the value to true and break out of the loop
							$found_address = true;
							break;
						}
					}
					return $found_address;
				} else {
					// There should be at least one IP address for this private key.
					return false;
				}
			}

			return $row;
		}

		// No key has been sent
		return false;
	}


	// in development, make json output more readable
	function _format_json($x) {
		if (defined('ENVIRONMENT') && ENVIRONMENT=='development') {
			return json_encode($x, JSON_PRETTY_PRINT);
		}else{
			return json_encode($x);
		}
	}
	// disable xss cleaning
	// avoid "preg_replace(): Compilation failed: regular expression is too large at offset" errors
	function _xss_clean($val, $process) {
		return $val;
	}
}
