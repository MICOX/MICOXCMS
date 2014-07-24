<?php
define('MICOXCMS_APP', 'ECommerce');
include('../../system/system.php');
\MICOXCMS\ObjectFactory::Instance(MICOXCMS_ADMINCLASS)->Init()->Run()->Done();