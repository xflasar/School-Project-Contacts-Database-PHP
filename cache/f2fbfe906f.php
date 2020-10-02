<?php
// source: error.latte

use Latte\Runtime as LR;

class Templatef2fbfe906f extends Latte\Runtime\Template
{
	public $blocks = [
		'title' => 'blockTitle',
		'body' => 'blockBody',
	];

	public $blockTypes = [
		'title' => 'html',
		'body' => 'html',
	];


	function main()
	{
		extract($this->params);
?>

<?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('title', get_defined_vars());
?>

<?php
		$this->renderBlock('body', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		$this->parentName = "layout.latte";
		
	}


	function blockTitle($_args)
	{
		?>Persons Info<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>

<div class="introduction">
  <i class="far fa-3x fa-sad-tear"></i> 
	<h1>Whoops, Something went wrong!</h1>
  <h3>Please, try it again and make sure you typed valid data,</h3>
  <h3>in case of operation error try to reload the page</h3></div>
  <h5><?php
		if (isset($err)) {
			?> <?php
			echo LR\Filters::escapeHtmlText($err) /* line 12 */;
		}
?></h5>          
<?php
	}

}
