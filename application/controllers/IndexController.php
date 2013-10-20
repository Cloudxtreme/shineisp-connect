<?php

class IndexController extends Zend_Controller_Action {
	
	public function init() {
		/* Initialize action controller here */
	}
	
	
	public function indexAction() {
		
		/*
		 * The HTTP Authentication hooks in PHP are only available when it is running as an Apache module and is hence not available in the CGI version. 
		 *  If you are using apache with mod fcgid in your ShineISP installation you have to add this options
		 * 
		 * <IfModule fcgid_module>
		 *	    FcgidPassHeader Authorization
		 *	</IfModule>
		 *
		 *  in /etc/httpd/conf.d/fcgid.conf is working.
		 */
		
		// initialize SOAP client
		
		try {
		    
		    // How to get a specific product .../api/resellers/products.soap
			$client = new Zend_Soap_Client ( null, array ('location' 	=> 'http://www.shineisp.it/api/resellers/products.soap',
                                            			   'uri' 		=> 'http://www.shineisp.it/api/resellers/products.soap', 
                                            			   'login' 	=> 'lromanov@shineisp.com', 
                                            			   'password' 	=> '123456789'));
			$result = $client->get (array(1));

			$this->view->result = $result;
			
		} catch ( SoapFault $s ) {
			Zend_Debug::dump($s);
			die ( 'ERROR: [' . $s->faultcode . '] ' . $s->faultstring );
			
		} catch ( Exception $e ) {
			die ( 'ERROR: ' . $e->getMessage () );
		}
	}
}

