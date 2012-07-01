<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once( "Phprules/Ruleelement.php" );
require_once( "Phprules/Datevariable.php" );
require_once( "Phprules/Rulecontext.php" );
require_once( "Phprules/Rule.php" );
require_once( "Phprules/Ruleloader.php" );
require_once( "Phprules/strategy/Rulecontextloaderstrategy.php");
require_once( "Phprules/strategy/Ruleloaderstrategy.php");
require_once( "Phprules/strategy/Sqlfileloaderstrategy.php");
require_once( "Phprules/strategy/Txtfileloaderstrategy.php");
class PhpRules {
	// Dummy class to allow all PHP Rules classes to be loaded as a library
}

/* End of file Phprules.php */
/* Location: ./system/application/libraries/Phprules.php */