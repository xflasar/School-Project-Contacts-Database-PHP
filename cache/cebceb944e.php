<?php
// source: index.latte

use Latte\Runtime as LR;

class Templatecebceb944e extends Latte\Runtime\Template
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
		if (isset($this->params['o'])) trigger_error('Variable $o overwritten in foreach on line 27');
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
                                <!--Middle One-->
								<div class='Banner2_middleBar'>
								    <table class='Banner2_middleBar_table1 table1'>
								    <thead>
                                        <tr>
                                            <th>First name</th>
                                            <th>Last name</th>
  	                                        <th>Nickname</th>
                                            <th>Gender</th>
  	                                        <th>Age</th>
  	                                        <th>Address</th>
                                            <th style="text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <!-- Is it possible to make the onclick="" not show inside inspect? or is it bad if it's shown how to make it more optimize -->
<?php
		$iterations = 0;
		foreach ($osoby as $o) {
			?>                                        <tr onclick="window.location='<?php
			echo $router->pathFor("profile");
			?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeJs($o['id_person'])) /* line 28 */ ?>';">
                                            <td><?php echo LR\Filters::escapeHtmlText($o['first_name']) /* line 29 */ ?></td>
                                            <td><?php echo LR\Filters::escapeHtmlText($o['last_name']) /* line 30 */ ?></td>
                                            <td><?php echo LR\Filters::escapeHtmlText($o['nickname']) /* line 31 */ ?></td>
                                            <td><?php echo LR\Filters::escapeHtmlText($o['gender']) /* line 32 */ ?></td>
                                            <td><?php
			if ($o['birth_day']!="") {
				echo LR\Filters::escapeHtmlText($date-$o['birth_day']) /* line 33 */;
			}
			else {
				?>Not Defined<?php
			}
?></td>
                                            <td><?php
			if ($o['city']!="") {
				echo LR\Filters::escapeHtmlText($o['street_name']) /* line 34 */ ?> <?php echo LR\Filters::escapeHtmlText($o['street_number']) /* line 34 */ ?>, <?php
				echo LR\Filters::escapeHtmlText($o['city']) /* line 34 */;
			}
			else {
				?>Not Defined<?php
			}
?></td>
                                            <td><button class="buttonTable" onclick="location.href='<?php
			echo $router->pathFor("person_Update");
			?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeJs($o['id_person'])) /* line 35 */ ?>'">Edit</button>
                                                <button class="buttonTable" style="background-color:red;" onclick="location.href='<?php
			echo $router->pathFor("person_Delete");
			?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::escapeJs($o['id_person'])) /* line 36 */ ?>'" >Remove</button>
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
