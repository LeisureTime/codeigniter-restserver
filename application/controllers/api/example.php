<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{
	function user_get()
	{
		if(!$this->get('id'))
		{
			$this->response(NULL, 400);
		}

		$this->load->model('User_model',"user");
		$user = $this->user->get_user($this->get('id'));
		if($user)
		{
			$this->response($user, 200); // 200 being the HTTP response code
		}

		else
		{
			$this->response(array('error' => 'User could not be found'), 404);
		}
	}

	function user_post()
	{
		$data = array(
   			'name' => $this->post('name'), 'email' => $this->post('email')
		);

		$this->db->insert('user', $data);
		$message = array('message' => 'ADDED!');		
		$this->response($message, 200); // 200 being the HTTP response code
	}

	function user_delete($id)
	{		
		$this->db->delete('user', array('id' => $id)); 
		//$this->some_model->deletesomething( $this->get('id') );
		$message = array('id' => $this->get('id'), 'message' => 'DELETED!');

		$this->response($message, 200); // 200 being the HTTP response code
	}

	function users_get()
	{
		 
		//$users = $this->some_model->getSomething( $this->get('limit') );
		$users = array(
		array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
		array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
		3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
		);

		if($users)
		{
			$this->response($users, 200); // 200 being the HTTP response code
		}

		else
		{
			$this->response(array('error' => 'Couldn\'t find any users!'), 404);
		}
	}


	public function send_post()
	{
		
		var_dump($this->request->body);
	}


	public function send_put()
	{
		var_dump($this->put('foo'));
	}
}