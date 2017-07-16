<?php

require_once VIEW ."header.php";

if (strpos($view, "/"))
{
    /** Get a "coder-friendly" path and transform it into absolute path (for file)
     *  "student/home"  become VIEW. "student/ViewHomeStudent.php"  **/
    require_once VIEW
            . substr($view, 0, strpos($view, "/") + 1)
            . "View"
            . ucfirst(substr($view, strpos($view, "/") + 1))
            . ucfirst(substr($view, 0, strpos($view, "/")))
            . ".php";
}
else {
    require_once VIEW . 'View' . ucfirst($view) . '.php';
}






require_once VIEW ."footer.php";
