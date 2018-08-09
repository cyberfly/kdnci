<?php

class Notification {

	public function __construct()
	{
		$this->ci =& get_instance();

		$this->ci->load->library('email');
		$this->ci->load->model('user_model');

		$this->from_email = 'noreply@kdncodeigniter.dev';
		$this->from_name = 'System';

	}

	private function email_config()
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.mailtrap.io',
			'smtp_port' => 2525,
			'smtp_user' => '1561f8a7e82f29',
			'smtp_pass' => '942d2ab4e2b310',
			'crlf' => "\r\n",
			'newline' => "\r\n"
		);

		return $config;
	}

	public function newTicketNotification($ticket_data)
	{
		// get ticket user info

		$user_id = $ticket_data['user_id'];

		$user = $this->ci->user_model->get($user_id);

		// end of get ticket user info

		$this->ci->email->initialize($this->email_config());

		$this->ci->email->from($this->from_email, $this->from_name);

		$this->ci->email->to('someone@example.com');

		// $this->ci->email->cc('another@another-example.com');
		// $this->ci->email->bcc('them@their-example.com');

		$this->ci->email->subject('New ticket was opened');

 		$message = 'Dear admin, there is new ticket that was opened

 			Here is the details:

 			Submitted by : ' . $user->email . '

 			Subject ' . $ticket_data['subject'] . '

 			Description : ' . $ticket_data['description'] . '

 			Created At : ' . gov_datetime($ticket_data['created_at']) . '

 		';

		$this->ci->email->message($message);

		$this->ci->email->send();
	}

}