<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Activityrule.php
 * @author Greg Swindle <greg@swindle.net>
 * @version 0.2
 * @package Phprules
 */

/**
 * An ActivityRule represents a type of Rule that automatically executes an 
 * activity when it evaluates to TRUE.
 */
abstract class ActivityRule extends Rule {
	
	abstract public function execute()

/**
 * Evaluates a RuleContext. The RuleContext contains Propositions and Variables that have
 * specific values. To apply the context, simply copy these values 
 * into the corresponding Propositions and Variables in the Rule. If the result of 
 * evaluation is TRUE, then the activity is executed.
 * @access public
 * @param RuleContext $ruleContext
 * @return Proposition
 */		
	function evaluate( $ruleContext ) {
		// The context contains Propositions and Variables that have
		// specific values. To apply the context, simply copy these values
		// into the corresponding Propositions and Variables in the Rule
		$this->stack = array();
		foreach( $this->elements as $e ) {
			if( $e->getType() == "Proposition" or $e->getType() == "Variable" ) {
				$element = $ruleContext->findElement( $e->name );
				if( $element ) {
					$e->value = $element->value;
				}
				else {
					$e->value = NULL;
				}
			}
		}
		$proposition = $this->process();
		if ($proposition->value == TRUE){
			$this->execute();
		}
		return $proposition;
	}
}


/* End of file Activityrule.php */
/* Location: ./system/application/libraries/php-rules/Activityrule.php */