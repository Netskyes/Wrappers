<?php
	
define('ERROR', '<strong>Error:</strong>');

class Mailer {

	private $settings = [];

	public function __construct($array = NULL) {

		$options = ['SMTP', 'SMTP_PORT', 'SEND_FROM', 'TYPE'];

		if( is_array($array) ) {
			
			foreach( $array as $key => $value ) {
				if( in_array($key, $options) && !is_numeric($key) ) {

					$this->settings += [$key => $value];
				}
				else exit(ERROR." configuration variables are incorrect.");
			}
		}

	}

	public function send($subject = NULL, $message = NULL, $to = NULL) {
	
	(isset($this->settings['SMTP']) && !empty($this->settings['SMTP'])) ? ini_set("SMTP", $this->settings['SMTP']) : "";
	(isset($this->settings['SMTP_PORT']) && !empty($this->settings['SMTP_PORT'])) ? ini_set("smtp_port", $this->settings['SMTP_PORT']) : "";
	(isset($this->settings['SEND_FROM']) && !empty($this->settings['SEND_FROM'])) ? ini_set("sendmail_from", $this->settings['SEND_FROM']) : "";

	$headers = array('MIME-Version: 1.0');

		if( isset($this->settings['TYPE']) && !empty($this->settings['TYPE']) ) {
			switch($this->settings['TYPE']) {
				case 'html':
					$headers[] = 'Content-type: text/html; charset=iso-8859-1';
				break;

				default:
					$headers[] = 'Content-type: text/plain; charset=iso-8859-1';
			}
		}

		if( !isset($subject) || !isset($subject) || !isset($to) ) {
			exit(ERROR." missing arguments.");
		}


		if( empty($subject) || preg_match("/^[\s]+$/i", $subject) ) {
			exit(ERROR." subject is not set.");

		} elseif( empty($message) || preg_match("/^[\s]+$/i", $message) ) {
			exit(ERROR." message is not set.");

		} elseif( empty($to) ) {
			exit(ERROR." recipient(s) is not set.");
		}


		if( !is_array($to) ) {
			$recipients = $to;
		
		} else {

			$recipientsNum = count($to) - 1;
			$recipients = "";

			foreach( $to as $num => $address ) {
				$separator = ($num < $recipientsNum) ? "," : "";

				$recipients .= $address.$separator." ";
			}

		}

		return mail($recipients, $subject, $message, implode("\r\n", $headers));
	}

	public function info() {
		return (object) array(
			'SMTP' => ini_get("SMTP"),
			'SMTP_PORT' => ini_get("smtp_port"),
			'SEND_FROM' => ini_get("sendmail_from")
		);
	}

}



?>

	

