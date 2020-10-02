<?php
// source: index.latte

use Latte\Runtime as LR;

class Template73b41ec8c5 extends Latte\Runtime\Template
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
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['o'])) trigger_error('Variable $o overwritten in foreach on line 27');
		}
		$this->parentName = 'layout.latte';
		
	}


	function blockTitle($_args)
	{
		?>Homepage<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>
<div class="Banner2">
            <div class="Banner2_1">
                <div class="Banner2_2">
                    <div class="Banner2_3">
                        <div class="Banner2_4">
                            <div class="Banner2_5">
                                <!--Left Side One-->
                                <div id="Banner2_leftSide_bar">
                                    <div >
                                        <ul >
                                            <li><a href="#">Home</a></li>
                                            <li><a href="#">Database</a></li>
                                            <li><a href="#">Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Middle One-->
								<div class='Banner2_middleBar'>
								    <table class='Banner2_middleBar_table1 table1'>
								    <thead><tr><th>id</th><th>username</th><th>password</th><th style="text-align:center;">Actions</th></tr></thead>
                                    <!-- Is it possible to make the onclick="" not show inside inspect? or is it bad if it's shown how to make it more optimize -->
<?php
		$iterations = 0;
		foreach ($array2 as $o) {
			?>                                        <tr onclick="window.location='<?php
			echo $router->pathFor("profile");
			?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeJs($o['id_person'])) /* line 28 */ ?>';">
                                            <td><?php echo LR\Filters::escapeHtmlText($row[0]) /* line 29 */ ?></td>
                                            <td><?php echo LR\Filters::escapeHtmlText($row[1]) /* line 30 */ ?></td>
                                            <td><?php echo LR\Filters::escapeHtmlText($row[2]) /* line 31 */ ?></td>
                                            <td><button class="buttonTable" onclick="location.href='/Worked'">Edit</button>
                                                <button class="buttonTable" style="background-color:red;">Remove</button>
                                            </td>
                                        </tr>
<?php
			$iterations++;
		}
?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
	}

}
