<?php
// source: Login.php

use Latte\Runtime as LR;

class Template055afa9632 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?><<?php ?>?php
$app->get('/Login', function(){
    echo "Testing";
});
?><?php
		return get_defined_vars();
	}

}
