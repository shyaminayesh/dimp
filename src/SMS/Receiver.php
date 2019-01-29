<?php

/**
 *
 * DIMP = A Simple PHP Wrapper for Dialog IdeaMart API's.
 *
 * @package     DIMP
 * @copyright   Copyright (C) 2018 Shyamin Ayesh, All rights reserved.
 * @author      Shyamin Ayesh (https://twitter.com/shyaminayesh)
 * @license     GPL-3.0
 *
 */

namespace DIMP\SMS;


use Exception;


/**
 *
 * This class will handle the SMS Receive actions. Just pass the php://input
 * of the SMS Receving API callback to the constructor and then we can access
 * every property of the response using registry bridge method.
 *
 * @copyright   Copyright (C) 2018 Shyamin Ayesh, All rights reserved.
 * @license     GPL-3.0
 *
 */
class Receiver {


    /**
     *
     * This property will act as a registry that simply store
     * data retrived by SMS receiver.
     *
     * @var Array
     *
     */
    private $_registry = Null;



    public function __construct($input) {
        foreach ( json_decode(file_get_contents($input), true) AS $key => $value ):
            $this->_registry[$key] = $value;
        endforeach;
    }



    /**
     *
     * This will be the bridge for registry. We can retrive
     * data stored in registry using this. Will raise a Exception
     * if there is no data present for specified key.
     *
     * @param   String          key for retrive data
     * @throws  Exception       If key is not found in registry
     * @return  Mixed           Data for the specified key
     *
     */
    public function __get($key) {
        if ( isset($this->_registry[$key]) ):
            return $this->_registry[$key];
        else:
            throw new Exception("No property called ".$key." in the registry.");
        endif;
    }
}

?>