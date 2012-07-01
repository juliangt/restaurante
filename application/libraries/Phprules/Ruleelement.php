<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * Ruleelement.php
 * @author Greg Swindle <greg@swindle.net>
 * @version 0.2
 * @package Phprules
 */
 
/**
 * Represents an element of a Rule or RuleContext.
 * @package Phprules
 */
abstract class RuleElement {
 /**
 * The name of the RuleElement.
 * @access public
 * @var string
 */ 
    public $name;
/**
 * Constructor initializes {@link $name}.
 * @access public
 */ 
    public function RuleElement( $name ) {
        $this->name = $name;
    }
/**
 * Constructor initializes {@link $name}.
 * @access public
 */     
    public function __construct( $name ) {
        $this->name = $name;
    }
/**
 * Returns the type of RuleElement.
 * @access public
 * @return string
 */ 
    public function getType() {}
/**
 * Returns the name of the RuleElement.
 * @access public
 * @return string
 */ 
    public function toString() {
        return $this->name;
    }
}
 /**
 * Represents a Boolean operator or a quantifier operator.
 * @package Phprules
 */
class Operator extends RuleElement {
/**
 * The name of the RuleElement.
 * @access private
 * @var array
 */
    private $operators;
	
	const LOGICAL_OR               = 'OR';
	const LOGICAL_AND              = 'AND';
	const LOGICAL_NOT              = 'NOT';
	const LOGICAL_XOR              = 'XOR';
	const EQUAL_TO                 = 'EQUALTO';
	const NOT_EQUAL_TO             = 'NOTEQUALTO';
	const LESS_THAN                = 'LESSTHAN';
	const LESS_THAN_OR_EQUAL_TO    = 'LESSTHANOREQUALTO';
	const GREATER_THAN             = 'GREATERTHAN';
	const GREATER_THAN_OR_EQUAL_TO = 'GREATERTHANOREQUALTO';
	
/**
 * Constructor initializes {@link $name}, i.e., the operator.
 * @access public
 */     
    function Operator( $operator ) {
        $this->operators = array( "AND", "OR", "NOT", "XOR", "EQUALTO", "NOTEQUALTO", "LESSTHAN", "GREATERTHAN", "LESSTHANOREQUALTO", "GREATERTHANOREQUALTO" );
        if( in_array( $operator, $this->operators ) ) {
            parent::Operator( $operator );
        }
        else {
            throw new Exception( $operator . " is not a valid operator." );
        }
    }
/**
 * Constructor initializes {@link $name}, i.e., the operator.
 * @access public
 */ 
    function __construct( $operator ) {
        $this->operators = array( "AND", "OR", "NOT", "XOR", "EQUALTO", "NOTEQUALTO", "LESSTHAN", "GREATERTHAN", "LESSTHANOREQUALTO", "GREATERTHANOREQUALTO" );
        if( in_array( $operator, $this->operators ) ) {
            parent::__construct( $operator );
        }
        else {
            throw new Exception( $operator . " is not a valid operator." );
        }
    }
/**
 * Returns "Operator."
 * @access public
 * @return string
 */
    function getType() {
        return "Operator";
    }
}
 /**
 * Represents a Proposition in formal logic, a statement with at truth value.
 * @package Phprules
 */
class Proposition extends RuleElement {
/**
 * The Boolean truth value of the Proposition.
 * @access public
 * @var boolean
 */
    public $value;
/**
 * Constructor initializes {@link $name}, and the {@link $value}.
 * @access public
 */ 
    function Proposition( $name, $truthValue ) {
        $this->value = $truthValue;
        parent::RuleElement( $name );
    }
/**
 * Constructor initializes {@link $name}, and the {@link $value}.
 * @access public
 */ 
    function __construct( $name, $truthValue ) {
        $this->value = $truthValue;
        parent::RuleElement( $name );
    }
/**
 * Returns &quot;Proposition.&quot;
 * @access public
 * @return string
 */ 
    function getType() {
        return "Proposition";
    }
/**
 * Returns a human-readable statement and value.
 * @access public
 * @return string
 */
    function toString() {
        $truthValue = "FALSE";
        if( $this->value == true ) {
            $truthValue = "TRUE";
        }
        return "Proposition statement = " . $this->name . ", value = " . $truthValue;
    }
/**
 * Performs a Boolean AND operation on another {@link Proposition}
 * @access public
 * @param Proposition $proposition
 * @return Proposition
 */ 
    function logicalAnd( $proposition ) {
        $resultName  = "( " . $this->name . " AND " . $proposition->name . " )";
        $resultValue = ( $this->value and $proposition->value );
        return new Proposition( $resultName, $resultValue );
    }
/**
 * Performs a Boolean OR operation on another {@link Proposition}
 * @access public
 * @param Proposition $proposition 
 * @return Proposition
 */ 
    function logicalOr( $proposition ) {
        $resultName  = "( " . $this->name . " OR " . $proposition->name . " )";
        $resultValue = ( $this->value or $proposition->value );
        return new Proposition( $resultName, $resultValue );
    }
/**
 * Performs a Boolean NOT operation its own value
 * @access public
 * @return Proposition
 */  
    function logicalNot() {
        $resultName  = "( NOT " . $this->name . " )";
        $resultValue = ( !$this->value );
        return new Proposition( $resultName, $resultValue );
    }
/**
 * Performs a Boolean XOR operation on another {@link Proposition}
 * @access public
 * @param Proposition $proposition 
 * @return Proposition
 */ 
    function logicalXor( $proposition ) {
        $resultName  = "( " . $this->name . " XOR " . $proposition->name . " )";
        $resultValue = ( $this->value xor $proposition->value );
        return new Proposition( $resultName, $resultValue );
    }
}
 /**
 * A symbol that represents a value.
 * @package Phprules
 */
class Variable extends RuleElement {
    var $value;
/**
 * Constructor initializes {@link $name}, and the {@link $value}.
 * @access public
 */     
    function Variable( $name, $value ) {
        $this->value = $value;
        parent::RuleElement( $name );
    }
/**
 * Constructor initializes {@link $name}, and the {@link $value}.
 * @access public
 */     
    function __construct( $name, $value ) {
        $this->value = $value;
        parent::__construct( $name );
    }
/**
 * Returns &quot;Variable.&quot;
 * @access public
 * @return string
 */     
    function getType() {
        return "Variable";
    }
/**
 * Returns a human-readable statement and value.
 * @access public
 * @return string
 */    
    function toString() {
        return "Variable name = " . $this->name . ", value = " . $this->value;
    }
/**
 * Determines whether another Variable's value is equal to its own value.
 * @public
 * @param Variable $variable
 * @return Proposition
 */    
    function equalTo( $variable ) {
        $statement = "( " . $this->name . " == " . $variable->name . " )";
        $truthValue = ( $this->value == $variable->value );
        return new Proposition( $statement, $truthValue );
    }
/**
 * Determines whether another Variable's value is <em>not</em> equal to its own value.
 * @public
 * @param Variable $variable
 * @return Proposition
 */    
    function notEqualTo( $variable ) {
        $statement = "( " . $this->name . " != " . $variable->name . " )";
        $truthValue = ( $this->value != $variable->value );
        return new Proposition( $statement, $truthValue );
    }
/**
 * Determines whether another Variable's value is less than to its own value.
 * @public
 * @param Variable $variable
 * @return Proposition
 */    
    function lessThan( $variable ) {
        $statement = "( " . $this->name . " < " . $variable->name . " )";
        $truthValue = ( $this->value < $variable->value );
        return new Proposition( $statement, $truthValue );
    }
/**
 * Determines whether another Variable's value is less than or equal to to its own value.
 * @public
 * @param Variable $variable
 * @return Proposition
 */   
    function lessThanOrEqualTo( $variable ) {
        $statement = "( " . $this->name . " <= " . $variable->name . " )";
        $truthValue = ( $this->value <= $variable->value );
        return new Proposition( $statement, $truthValue );
    }
/**
 * Determines whether another Variable's value is greater than to its own value.
 * @public
 * @param Variable $variable
 * @return Proposition
 */
    function greaterThan( $variable ) {
        $statement = "( " . $this->name . " > " . $variable->name . " )";
        $truthValue = ( $this->value > $variable->value );
        return new Proposition( $statement, $truthValue );
    }
/**
 * Determines whether another Variable's value is greater than or equal to its own value.
 * @public
 * @param Variable $variable
 * @return Proposition
 */    
    function greaterThanOrEqualTo( $variable ) {
        $statement = "( " . $this->name . " >= " . $variable->name . " )";
        $truthValue = ( $this->value >= $variable->value );
        return new Proposition( $statement, $truthValue );
    }
}

/* End of file Ruleelement.php */
/* Location: ./system/application/libraries/Phprules/Ruleelement.php */