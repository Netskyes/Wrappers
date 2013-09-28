<?php
	
	class xmlns {

		private static $INSTANCE;
		private $DOM;
		private $XMLNS;


		private function __construct($xl_name = NULL, $username = NULL, $password = NULL) {
			
			if( !$xl_name || !$username || !$password ) {
				throw new Exception("Incorrect parameters. ( XL NAME, USERNAME, PASSWORD )");
			}

			$this->XMLNS = ['xl_name' => $xl_name, 'username' => $username, 'password' => $password];

			$this->DOM = new DOMDocument('1.0', 'UTF-8');
			$this->DOM->load("database/".$this->XMLNS['xl_name']);
			$this->DOM->formatOutput = true;
			$this->DOM->preserveWhiteSpace = false;
			
		}

		public static function init($xl_name = NULL, $username = NULL, $password = NULL) {
			if( self::$INSTANCE instanceof self ) {
				return false;
			}

			self::$INSTANCE = new self($xl_name, $username, $password);
		}

		/*
		//////////////////////////////////////////////////////////////////////////
		With parameters fetches specific <node> child at specified sector
		Without parameters fetches all <node> childs and outputs them as array
		Output usage example: $ [CHILD NAME] [SECTOR ID]
		//////////////////////////////////////////////////////////////////////////
		*/

		public static function getData($el_name = NULL, $id = NULL) {
			$dom = self::$INSTANCE->DOM;
			$xp = new DOMXPath($dom);

			$nodes = $dom->getElementsByTagName("node");

			if( !$el_name ) {
				$temp_storage = array();

				foreach( $nodes as $node ) {
					$ID = $node->getAttribute("id");
				
					$childsStorage = array();
					foreach( $node->childNodes as $child ) {

						if( $child->nodeType == 1 ) {
							$childsStorage += [$child->nodeName => $child->nodeValue];
						}
						
					}
					$temp_storage[] = $childsStorage;
					
				}

				return $temp_storage;

			}

			if( !$id ) {
				$id = $nodes->length;
			}
			$ex = $xp->query("//node[@id='".abs($id)."']");

			if( $ex->length == 0 ) {
				throw new Exception("Sector #". $id ." does not exist.");
			}

			if( $ex->item(0)->getElementsByTagName(strtolower($el_name))->length == 0 ) {
				throw new Exception("Element ". strtolower($el_name) ." does not exist.");
			}

			return $ex->item(0)->getElementsByTagName(strtolower($el_name))->item(0)->nodeValue;
			
		}

		/*
		//////////////////////////////////////////////////////////////////////////
		Cannot be left without parameters, creates a new node with max id and
		custom structure of childs with data
		Basic usage: Parse array as parameter array(childName => childValue, ...)
		//////////////////////////////////////////////////////////////////////////
		*/

		public static function addData($el_structure = NULL) {
			if( !$el_structure ) {
				throw new Exception("You need to specify a new node structure.");
			}

			$dom = self::$INSTANCE->DOM;

			$nodes = $dom->getElementsByTagName("node");
			$next = $nodes->length;

			$element = $dom->createElement('node');
			$element->setAttribute('id', $next);

			foreach( $el_structure as $childName => $childValue ) {
				$child = $dom->createElement($childName, $childValue);
				$element->appendChild($child);
			}
			
			$dom->firstChild->appendChild($element);

			return $dom->save('database/main.xml');

		}


		/*
		//////////////////////////////////////////////////////////////////////////
		Cannot be left without parameters, deletes whole node with specified ID
		//////////////////////////////////////////////////////////////////////////
		*/

		public static function delData($id = NULL) {
			if( !$id ) {
				throw new Exception("You haven't specified which sector to delete.");
			}

			$dom = self::$INSTANCE->DOM;
			$xp = new DOMXPath($dom);

			$target = $xp->query("//node[@id='".abs($id)."']");

			if( $target->length == 0 ) {
				throw new Exception("Sector #". $id ." does not exist.");
			}

			$node = $target->item(0);
			$node->parentNode->removeChild($node);

			$dom->save('database/main.xml');
		}




	}

?>
