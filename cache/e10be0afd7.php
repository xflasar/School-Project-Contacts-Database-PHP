<?php
// source: LocationAttach.latte

use Latte\Runtime as LR;

class Templatee10be0afd7 extends Latte\Runtime\Template
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
		if (isset($this->params['l'])) trigger_error('Variable $l overwritten in foreach on line 31');
		$this->parentName = "layout.latte";
		
	}


	function blockTitle($_args)
	{
		?>Attach location<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>

<form method="post">
<div id="block" class="container">
  <h1>Location attach</h1>   
  <div class="row d-flex justify-content-center">
	  <div id="infoSection" class="col-sm-5 form-group">
	    <h2>Person</h2> 
      	<span id="infoKey">First Name: </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['first_name']) /* line 14 */ ?></span>
      	<span id="infoKey">Last Name:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['last_name']) /* line 15 */ ?></span>
      	<span id="infoKey">Nickname:   </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['nickname']) /* line 16 */ ?></span>
      	<span id="infoKey">Gender:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['gender']) /* line 17 */ ?></span>
      	<span id="infoKey">Birth Day:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $info['birth_day'], '%d.%m.%Y')) /* line 18 */ ?></span>
      	<span id="infoKey">Age:        </span><span id="infoValue">&nbsp<?php
		if ($info['birth_day']!="") {
			echo LR\Filters::escapeHtmlText($date-$info['birth_day']) /* line 19 */;
		}
?></span>
      	<span id="infoKey">Height:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['height']) /* line 20 */ ?></span>
        <div style="display:none">
          <label for="id_person"></label>
          <input type="number" name="id_person" value="<?php echo LR\Filters::escapeHtmlAttr($id_person) /* line 23 */ ?>">          
        </div>
    </div>

  	<div id="infoSection" class="col-sm-5 form-group">
      <h2>Location</h2>
      <label for="id_location">Choose Location:</label>           
      <select class="form-control" name="id_location" size="7" required>
<?php
		$iterations = 0;
		foreach ($locations as $l) {
			if ($l['city']!=null and $l['street_number']!=null and $l['street_name']!=null) {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 33 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($l['city']) /* line 33 */ ?>, <?php echo LR\Filters::escapeHtmlText($l['street_name']) /* line 33 */ ?>, <?php
				echo LR\Filters::escapeHtmlText($l['street_number']) /* line 33 */ ?></option>
<?php
			}
			elseif ($l['city']!=null and $l['street_name']!=null) {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 35 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($l['city']) /* line 35 */ ?>, <?php echo LR\Filters::escapeHtmlText($l['street_name']) /* line 35 */ ?></option>
<?php
			}
			elseif ($l['city']!=null and $l['street_number']!=null) {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 37 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($l['city']) /* line 37 */ ?>, <?php echo LR\Filters::escapeHtmlText($l['street_number']) /* line 37 */ ?></option>
<?php
			}
			elseif ($l['city']!=null) {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 39 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($l['city']) /* line 39 */ ?></option>
<?php
			}
			elseif ($l['country']!=null) {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 41 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($l['country']) /* line 41 */ ?></option>
<?php
			}
			elseif ($l['zip']!=null) {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 43 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($l['zip']) /* line 43 */ ?></option>
<?php
			}
			elseif ($l['name']!=null) {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 45 */ ?>"><?php
				echo LR\Filters::escapeHtmlText($l['name']) /* line 45 */ ?></option> 
<?php
			}
			else {
				?>               <option value="<?php echo LR\Filters::escapeHtmlAttr($l['id_location']) /* line 47 */ ?>">Location without atributes</option>                    
<?php
			}
			$iterations++;
		}
?>
      </select>
    </div>                   
  </div>
</div>
    
<div class="buttonsDiv">
    <button type="submit" class="btn btn-outline-success col-sm-2">Attach Location</button>     
</div>
</form>
 
<div class="buttonsDiv">
    <a href="<?php
		echo $router->pathFor("profile");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 61 */ ?>"><button class="btn btn-outline-danger col-sm-2">Cancel</button></a>
</div>

<?php
	}

}
