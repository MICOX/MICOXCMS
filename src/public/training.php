<?php
define('MICOXCMS_APP', 'Training');
include('../system/system.php');
\MICOXCMS\ObjectFactory::Instance(MICOXCMS_APPCLASS)->Init()->Run()->Done();