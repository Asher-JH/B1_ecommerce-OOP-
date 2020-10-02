<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/interfaces/Database.php');

	class Model implements Database {
		public static function get_db($query) {
			$host = 'localhost';
			$username = 'root';
			$password = '';
			$db = 'b1_ecom';

			// Online Database
			// $host = 'db4free.net';
			// $username = 'qazwsxedcrfv123';
			// $password = 'qwerty123';
			// $db = 'b1ecomasher';

			$cn = mysqli_connect($host, $username, $password, $db);
			return mysqli_query($cn, $query);
		}

		public static function get_cn() {
			$host = 'localhost';
			$username = 'root';
			$password = '';
			$db = 'b1_ecom';

			// Online Database
			// $host = 'db4free.net';
			// $username = 'qazwsxedcrfv123';
			// $password = 'qwerty123';
			// $db = 'b1ecomasher';

			$cn = mysqli_connect($host, $username, $password, $db);
			return $cn;
		}

		public static function send_email($post) {
			// Create the Transport
			$transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
			  ->setUsername('ecomownerb1@gmail.com')
			  ->setPassword('Qwerty123_')
			;

			// Create the Mailer using your created Transport
			$mailer = new Swift_Mailer($transport);

			// Create a message
			$message = (new Swift_Message('Registration Succesfull'))
			  ->setFrom(['ecomownerb1@gmail.com' => 'John Doe'])
			  ->setTo([$post['email'] => $post['firstname']])
			  ->setBody('Thank you regisering on B1_ecom')
			  ;

			// Send the message
			$result = $mailer->send($message);
		}
	}

 ?>