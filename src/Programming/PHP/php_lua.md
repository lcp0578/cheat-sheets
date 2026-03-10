## php-lua PHP使用lua
> https://github.com/laruence/php-lua

- 示例
``` php
<?php
   $lua = new Plua($lua_script_file = NULL);
 
   $lua->eval("lua_statements");     //eval lua codes
   $lua->include("lua_script_file"); //import a lua script
 
   $lua->assign("name", $value); //assign a php variable to Lua
   $lua->register("name", $function); //register a PHP function to Lua with "name"
 
   $lua->call($string_lua_function_name, array() /*args*/);
   $lua->call($resouce_lua_anonymous_function, array() /*args);
   $lua->call(array("table", "method"), array(...., "push_self" => [true | false]) /*args*/);
 
   $lua->{$lua_function}(array()/*args*/);
?>
```
