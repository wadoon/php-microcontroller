<?
class Config 
{
    var $prefix = "";
    var $root   = "";
    function Config($file = false, $current="production")
    {
        if( $file) 
        {
            $ini = parse_ini_file($file, true);
            
            foreach($ini as $key => $value)
            {
                $array = explode(':', $key); 
                $st = trim(array_shift($array));
                if($current == $st)
                {
                    $this->root = $ini[$key];
                    foreach($array as $key)
                {
                    $this->_copy($ini[ 
                            trim($key) ]);
                }
                }
            }
            //var_dump($this->root);
        }
    }
    
    function get($name)
    {
        return $this->root[ $this-prefix . $name];
    }

    function __get($name)
    {
        $path = $this->prefix . $name;
        if(array_key_exists($path , $this->root))
            return $this->root[$path];
        else
        {
            $config =   new Config();
            $config->root   = &$this->root; 
            $config->prefix = $this->prefix.$name.".";
            return $config;
        }
    }

    function _copy($map)
    {
        foreach($map as $key => $value)
        {
            if( ! array_key_exists($key  , $this->root) )
            {
                $this->root[$key] = $map[$key];

            }
        }
    }
}
?>
