<?php 

class DI {

	protected static $instance;

	private function __construct() {}
	private function __clone() {}

    private $_bindings = [];
    private $_instances = [];
    
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function get($name)
    {
		if (isset($this->_instances[$name])) {
			return $this->_instances[$name];
		}

		$obj = $this->new($name);
		$this->_instances[$name] = $obj;
		return $obj;
    }
    
    public function new($name)
    {
		$instance = $this->_bindings[$name];
		$obj = call_user_func($instance);
		return $obj;
    }

    public function has($name)
    {
        return isset($this->_bindings[$name]) or isset($this->_instances[$name]);
    }
    
    public function remove($name)
    {
        unset($this->_bindings[$name], $this->_instances[$name]);
    }
    
    public function set($name, $instance)
    {
        $this->_bindings[$name] = $instance;
    }

}