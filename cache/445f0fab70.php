<?php
// source: profileMain.latte

use Latte\Runtime as LR;

class Template445f0fab70 extends Latte\Runtime\Template
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
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('title', get_defined_vars());
		$this->renderBlock('body', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['c'])) trigger_error('Variable $c overwritten in foreach on line 95');
		if (isset($this->params['r'])) trigger_error('Variable $r overwritten in foreach on line 111');
		$this->parentName = "profileLayout.latte";
		
	}


	function blockTitle($_args)
	{
		extract($_args);
		echo LR\Filters::escapeHtmlText($info['first_name']) /* line 2 */ ?> <?php
		echo LR\Filters::escapeHtmlText($info['last_name']) /* line 2 */;
	}


	function blockBody($_args)
	{
		extract($_args);
?>

<div id="block" class="container">
  <div class="row d-flex justify-content-center"> 
    <div id="infoSection" class="col-sm-5 form-group">

        <a id="actionButtonRight" href="<?php
		echo $router->pathFor("person_Delete");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['personal_id'])) /* line 9 */ ?>" onclick="return confirm('Delete person?')">
      	  <span title="Delete Person" id="actionButton">
      	    <i class="fas fa-lg fa-times-circle"></i>
      	  </span>
        </a>

        <a id="actionButtonRight" href="<?php
		echo $router->pathFor("person_Update");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['personal_id'])) /* line 15 */ ?>">
      	  <span title="Edit Person" id="actionButton">
      	    <i class="fas fa-lg fa-pencil-alt"></i>
      	  </span>
        </a>

      	<h2>Person</h2> 
      	<span id="infoKey">First Name: </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['first_name']) /* line 22 */ ?></span>
      	<span id="infoKey">Last Name:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['last_name']) /* line 23 */ ?></span>
      	<span id="infoKey">Nickname:   </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['nickname']) /* line 24 */ ?></span>
      	<span id="infoKey">Gender:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['gender']) /* line 25 */ ?></span>
      	<span id="infoKey">Birth Day:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $info['birth_day'], '%d.%m.%Y')) /* line 26 */ ?></span>
      	<span id="infoKey">Age:        </span><span id="infoValue">&nbsp<?php
		if ($info['birth_day']!="") {
			echo LR\Filters::escapeHtmlText($date-$info['birth_day']) /* line 27 */;
		}
?></span>
      	<span id="infoKey">Height:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['height']) /* line 28 */ ?></span>
    </div>
	
    <div id="infoSection" class="col-sm-5 form-group">        
<?php
		if ($info['id_location'] != "") {
			?>      	  <a id="actionButtonRight" href="<?php
			echo $router->pathFor("detach_Location");
			?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['personal_id'])) /* line 33 */ ?>" onclick="return confirm('Detach location?')">
      	    <span title="Detach Location" id="actionButton">
      	      <i class="fas fa-lg fa-times-circle"></i>
      	    </span>
          </a>
<?php
		}
		else {
?>
      	  <div id="actionButtonRight">
        	    <span title="Unvaliable" id="actionButton">
        	      <i class="fas fa-lg fa-times-circle unvaliable"></i>
        	    </span>
          </div>
<?php
		}
?>

<?php
		if ($info['id_location'] != "") {
			?>        <a id="actionButtonRight" href="<?php
			echo $router->pathFor("location_Update");
			?>?id_location=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['id_location'])) /* line 47 */ ?>">
      	  <span title="Edit Location" id="actionButton">
      	    <i class="fas fa-lg fa-pencil-alt"></i>
      	  </span>
        </a>
<?php
		}
		else {
?>
          <div id="actionButtonRight">
        	    <span title="Unvaliable" id="actionButton">
        	      <i class="fas fa-lg fa-pencil-alt unvaliable"></i>
        	    </span>
          </div>
<?php
		}
?>
  
<?php
		if ($info['id_location'] == "") {
			?>      	  <a id="actionButtonRight" href="<?php
			echo $router->pathFor("attach_Location");
			?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['personal_id'])) /* line 61 */ ?>">
      	    <span title="Attach Location" id="actionButton">
      	      <i class="fas fa-lg fa-plus"></i>
      	    </span>
          </a>
<?php
		}
		else {
?>
      	  <div id="actionButtonRight">
        	    <span title="Unvaliable" id="actionButton">
        	      <i class="fas fa-lg fa-plus unvaliable"></i>
        	    </span>
          </div>
<?php
		}
?>

	<h2>Location</h2>
<?php
		if ($info['id_location'] != null) {
			?>	<span id="infoKey">Country:      </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['country']) /* line 76 */ ?></span>
	<span id="infoKey">City:         </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['city']) /* line 77 */ ?></span>
	<span id="infoKey">Street Name:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['street_name']) /* line 78 */ ?></span>
	<span id="infoKey">Street Num.:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['street_number']) /* line 79 */ ?></span>
	<span id="infoKey">Zip:          </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['zip']) /* line 80 */ ?></span>
	<span id="infoKey">Name:         </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['location_name']) /* line 81 */ ?></span>
	<?php
		}
		else {
?> No location assigned
<?php
		}
?>
    </div>	

    <div id="infoSection" class="col-sm-5 form-group">
        <a id="actionButtonRight" href="<?php
		echo $router->pathFor("contact_Update");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 87 */ ?>&first_name=<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['first_name'])) /* line 87 */ ?>">
      	  <span title="Edit Contacts" id="actionButton">
      	    <i class="fas fa-lg fa-pencil-alt"></i>
      	  </span>
        </a>

      	<h2>Contacts</h2>
<?php
		if ($contacts) {
			$iterations = 0;
			foreach ($contacts as $c) {
				?>      	    <span id="infoKey"><?php echo LR\Filters::escapeHtmlText($c['name']) /* line 96 */ ?>:  </span><span id="infoValue">&nbsp<?php
				echo LR\Filters::escapeHtmlText($c['contact']) /* line 96 */ ?></span>
<?php
				$iterations++;
			}
			?>      	<?php
		}
		else {
?> No contacts assigned
<?php
		}
?>
    </div>

    <div id="infoSection" class="col-sm-5 form-group">
        <a id="actionButtonRight" href="<?php
		echo $router->pathFor("relation_Update");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 103 */ ?>&first_name=<?php
		echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['first_name'])) /* line 103 */ ?>">
	  <span title="Edit Relations" id="actionButton">
	    <i class="fas fa-lg fa-pencil-alt"></i>
	  </span>
        </a>

	<h2>Relations</h2>
<?php
		if ($relations) {
			$iterations = 0;
			foreach ($relations as $r) {
				?>	    <span id="infoKey">&nbsp<?php echo LR\Filters::escapeHtmlText($r['name']) /* line 112 */ ?>: </span>
	    <span id="infoValue">
    		<a href="<?php
				echo $router->pathFor("profile");
				?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($r['id_person'])) /* line 114 */ ?>">
    		  &nbsp<u><?php echo LR\Filters::escapeHtmlText($r['first_name']) /* line 115 */ ?>

    		  <?php echo LR\Filters::escapeHtmlText($r['last_name']) /* line 116 */ ?></u>
    		</a>
        <?php
				if ($r['description']) {
					?><i title="<?php echo LR\Filters::escapeHtmlAttr($r['description']) /* line 118 */ ?>" class="fas fa-comment-dots"></i><?php
				}
?>

	    </span>
<?php
				$iterations++;
			}
			?>	<?php
		}
		else {
?> No relations assigned
<?php
		}
?>
    </div>

  </div>
</div>

<?php
	}

}
