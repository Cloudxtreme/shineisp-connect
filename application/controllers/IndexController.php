<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        try{
	    	// initialize SOAP client
	    	$options = array(
	    			'location' 	=> 'http://demo.shineisp.com/api/products.soap',
	    			'uri'      	=> 'http://demo.shineisp.com/api/products.soap',
	    			'login' 	=> 'api@shineisp.com',
	    			'password' 	=> '123456789'
	    	);
	    	 
	    	// action body
	        $client = new Zend_Soap_Client(null, $options);
	        $result = $client->get(array(1));
	        Zend_Debug::dump($result);
	        
        }catch(SoapFault $e){
        	echo $e->getMessage();
        }
    }


}

