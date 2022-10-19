<?php
class BaseController
{
    use Request;

    public function view($template, $data = array())
    {
        // ob_start();
        extract($data);
        $path = str_replace(['.'], ['/'], $template);
        require(VIEW_PATH."$path.php");
        // $str = ob_get_contents();
        // ob_end_clean();
        // return $str;
        // return ob_clean();
    }
}
