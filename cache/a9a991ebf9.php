<?php
// source: profile.latte

use Latte\Runtime as LR;

class Templatea9a991ebf9 extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'title' => 'blockTitle',
		'body' => 'blockBody',
	];

	public $blockTypes = [
		'head' => 'html',
		'title' => 'html',
		'body' => 'html',
	];


	function main()
	{
		extract($this->params);
?>


<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
?>

<?php
		$this->renderBlock('title', get_defined_vars());
?>






<?php
		$this->renderBlock('body', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = 'profileLayout.latte';
		
	}


	function blockHead($_args)
	{
		
	}


	function blockTitle($_args)
	{
		?>First page<?php
	}


	function blockBody($_args)
	{
		
	}

}
