<?php
// namespace Traits;
// namespace traits\Request;
trait Request
{

    public function input()
    {
        return $this;
    }
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


    /**
     * @param mixed $formName
     * Get form value
     * 
     * Sama kaya $_FILES['formName'];
     * @return string
     */
    public function files($formName)
    {
        return $_FILES[$formName];
    }

    /**
     * @param mixed $formName
     * Get form value
     * 
     * Sama kaya $_COOKIE['formName'];
     * @return string
     */
    public function cookie($formName)
    {
        return $_COOKIE[$formName];
    }

    /**
     * Get form value
     * @return array
     */
    public function all()
    {
        return $_REQUEST;
    }

    /**
     * @param mixed $array
     * Get form value
     * @return array
     */
    public function only($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            $input[] = $array[$i];
        }
        return $input;
    }
}
