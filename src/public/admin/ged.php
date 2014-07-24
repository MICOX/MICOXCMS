<?php
define('MICOXCMS_APP', 'GED');
include('../../system/system.php');
\MICOXCMS\ObjectFactory::Instance(MICOXCMS_ADMINCLASS)->Init()->Run()->Done();