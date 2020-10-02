<?php
// source: UpdateRelation.latte

use Latte\Runtime as LR;

class Template21ecd919c5 extends Latte\Runtime\Template
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
		if (isset($this->params['p'])) trigger_error('Variable $p overwritten in foreach on line 19');
		if (isset($this->params['r'])) trigger_error('Variable $r overwritten in foreach on line 57');
		$this->parentName = "layout.latte";
		
	}


	function blockTitle($_args)
	{
		?>Relation update<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>

<div id="block" class="container">
  <h1>Relations update</h1>   
  <div class="row d-flex justify-content-center"> 

      <div id="infoSection" class="col-sm-5 form-group">
        <form method="post">

                <div class="form-row">
                   <label id="infoKey" for="id_person2">Person: </label>
                   <div id="infoValue" class="col-sm-7">
                     <select class="form-control form-control-sm" name="id_person2">
<?php
		$iterations = 0;
		foreach ($persons as $p) {
			?>			                   <option value="<?php echo LR\Filters::escapeHtmlAttr($p['id_person']) /* line 20 */ ?>"><?php
			echo LR\Filters::escapeHtmlText($p['first_name']) /* line 20 */ ?> '<?php echo LR\Filters::escapeHtmlText($p['nickname']) /* line 20 */ ?>' <?php
			echo LR\Filters::escapeHtmlText($p['last_name']) /* line 20 */ ?></option>
<?php
			$iterations++;
		}
?>
                      </select>
                    </div>
                </div>

                <div class="form-row">
                   <label id="infoKey" for="id_relation_type">Relation: </label>
                   <div id="infoValue" class="col-sm-7">
                     <select class="form-control form-control-sm" name="id_relation_type">
                        <option value="1">Friend</option>
                        <option value="2">Enemy</option>
                        <option value="3">Partner</option>
                        <option value="4">Colleague</option>
                        <option value="5">Acquaintance</option>
                        <option value="6">Lover</option>
                        <option value="7">Family</option>
                        <option value="8">Spouse</option>
                      </select>
                    </div>
                </div>
                
                <div class="form-row">
                   <label id="infoKey" for="description">Description: </label>
                   <div id="infoValue" class="col-sm-7">
                     <input class="form-control form-control-sm" type="text" name="description">
                   </div>
                </div>
                
                <button type="submit" class="btn btn-outline-success col-sm-7 save">Add Relation</button>
        </form>
      </div>


      <div id="infoSection" class="col-sm-5 form-group">
        	<h2><?php echo LR\Filters::escapeHtmlText($first_name) /* line 55 */ ?></h2>
<?php
		if ($relations) {
			$iterations = 0;
			foreach ($relations as $r) {
				?>        	    <span id="infoKey">&nbsp<?php echo LR\Filters::escapeHtmlText($r['name']) /* line 58 */ ?>: </span>
        	    <span id="infoValue">
              		<a target="_blank" href="<?php
				echo $router->pathFor("profile");
				?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($r['id_person'])) /* line 60 */ ?>">
              		  &nbsp<u><?php echo LR\Filters::escapeHtmlText($r['first_name']) /* line 61 */ ?> '<?php
				echo LR\Filters::escapeHtmlText($r['nickname']) /* line 61 */ ?>'
              		  <?php echo LR\Filters::escapeHtmlText($r['last_name']) /* line 62 */ ?></u>
              		</a>
                  <?php
				if ($r['description']) {
					?><i title="<?php echo LR\Filters::escapeHtmlAttr($r['description']) /* line 64 */ ?>" class="fas fa-comment-dots"></i><?php
				}
?>

              		<a id="actionButtonRight" class=" actionButton" 
              		   href="<?php
				echo $router->pathFor("delete_Relation");
				?>?id_relation=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($r['id_relation'])) /* line 66 */ ?>&id_person=<?php
				echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 66 */ ?>&first_name=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($first_name)) /* line 66 */ ?>" 
              		   onclick="return confirm('Delete relation?')"><i class="fas fa-times-circle"></i>
              		</a>
        	    </span>
<?php
				$iterations++;
			}
			?>          	<?php
		}
		else {
?> No relations assigned
<?php
		}
?>
      </div>

  </div>

  <div class="buttonsDiv">
    <a class="btn btn-outline-info col-sm-3" href="<?php
		echo $router->pathFor("profile");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 78 */ ?>">Show <?php
		echo LR\Filters::escapeHtmlText($first_name) /* line 78 */ ?></a>      
  </div>

</div>

<?php
	}

}
