<?php
define('MICOXCMS_APP', 'CMS');
include('../../system/system.php');
\MICOXCMS\ObjectFactory::Instance(MICOXCMS_ADMINCLASS)->Init()->Run()->Done();