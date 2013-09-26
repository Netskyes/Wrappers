<?php
	

class Mail {

	private $mail = array();

	public function info() {
		return (object) array(
			'SMTP' => ini_get("SMTP"),
			'SMTP_PORT' => ini_get("smtp_port"),
			'SEND_FROM' => ini_get("sendmail_from")
		);
	}

	public function prepare($message = NULL, $options = NULL) {
		$reqs = array('subject', 'message', 'type');
		$reqsNum = 0;

		if( $message ) {
			if( is_array($message) ) {

				foreach( $message as $key => $value ) {

					if( in_array($key, $reqs) ) {
						if( $key == "subject" || $key == "message" ) {
							$reqsNum++;
						}

						$this->mail += [$key => $value];
					}

				}

				if( $reqsNum != 2 ) {
					exit("<strong>Error:</strong> sending options must include subject and message!");
				}
				
				if( $options && is_array($options) ) {

					ini_set("SMTP", (!empty($options['SMTP'])) ? $options['SMTP'] : ini_get("SMTP"));
					ini_set("smtp_port", (!empty($options['SMTP_PORT'])) ? $options['SMTP_PORT'] : ini_get("smtp_port"));
					ini_set("sendmail_from", (!empty($options['SEND_FROM'])) ? $options['SEND_FROM'] : ini_get("sendmail_from"));

				}

				return $this;
			} 
			else exit("<strong>Error:</strong> sending options must be in a form of array!");

		} 
		else exit("<strong>Missing argument 1:</strong> sending options must be specified!");

	}

	public function send($list = NULL) {
		$subject = trim($this->mail['subject']);
		$message = trim($this->mail['message']);

		if( !isset($subject) || !isset($message) ) {
			exit("<strong>Error:</strong> mailOpts() must be initialized before sending a mail!");

		} elseif( empty($subject) || empty($message) ) {
			exit("<strong>Missing argument 1:</strong> you cannot leave subject or message empty!");
		}

		if( !$list ) {
			exit("<strong>Missing argument 1:</strong> recipient(s) must be specified!");
		}

		if( !is_array($list) ) {
			$recipients = $list;

		} else {

			$recipientsNum = count($list) - 1;
			$recipients = "";

			foreach( $list as $num => $address ) {
				$separator = ($num < $recipientsNum) ? "," : "";

				$recipients .= $address.$separator." ";
			}
		}

		// Recipients, Subject, Message, Headers
		return mail($recipients, $this->mail['subject'], $this->mail['message']);
		
	}

}

?>

	

