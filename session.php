<?php
if (!isset($_SESSION)) {
    Session::init();
} else {
     Session::destroy();
    Session::init();
}

?>