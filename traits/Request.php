<?php
trait Request{
    
    /**
     * @param mixed $params 
     * Get param dari url
     * 
     * ex. localhost/test?id=20
     * 
     * akan memunculkan 20
     * @return string
     */
    public function get($params)
    {
        
        return $_GET[$params];
    }


    /**
     * @param mixed $formName
     * Get form value
     * 
     * Sama kaya $_POST['formName'];
     * @return string
     */
    public function post($formName)
    {
        return $_POST[$formName];
    }
}