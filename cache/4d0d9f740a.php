<?php
// source: UpdateExistingPerson.latte

use Latte\Runtime as LR;

class Template4d0d9f740a extends Latte\Runtime\Template
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
		?>Update Person<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>
<div class="container">
    <h1>Person Update</h1>    
</div>    


<form method="post">
  <div id="block" class="container">
    
      <div class="row d-flex justify-content-center">

	<div id="infoSection" class="col-sm-5 form-group">
             <div class="col-sm-11 form-group">
                <label for="first_name">First name *</label>
                <input class="form-control" type="text" name="first_name" placeholder="First name" required value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['first_name']) /* line 20 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="last_name">Last name *</label>
                <input class="form-control" type="text" name="last_name" placeholder="Last name" required value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['last_name']) /* line 25 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="nickname">Nickname *</label>
                <input class="form-control" type="text" name="nickname" placeholder="Nickname" required value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['nickname']) /* line 30 */ ?>">
             </div>
                
             <div class="col-sm-11 form-group">
                <label for="height">Height</label>
                <input class="form-control" type="number" name="height" placeholder="Height" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['height']) /* line 35 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="gender">Gender</label>
                <select class="form-control" name="gender">
		                <option value="" <?php
		if ($formData['gender']=='') {
			?>selected<?php
		}
?>></option>
                    <option value="female" <?php
		if ($formData['gender']=='female') {
			?>selected<?php
		}
?>>Female</option>
                    <option value="male"<?php
		if ($formData['gender']=='male') {
			?>selected<?php
		}
?>>Male</option>
                </select>                              
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="birth_day">Birthday</label>
                <input class="form-control" type="date" name="birth_day" placeholder="Date of birth" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['birth_day']) /* line 49 */ ?>">
             </div>
        </div>
       
	<div id="infoSection" class="col-sm-5 form-group">
	  <h2><?php echo LR\Filters::escapeHtmlText($formData['first_name']) /* line 54 */ ?> <?php echo LR\Filters::escapeHtmlText($formData['last_name']) /* line 54 */ ?></h2>
	  <br>
 	  <span id="infoKey">First Name: </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['first_name']) /* line 56 */ ?></span>
	  <span id="infoKey">Last Name:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['last_name']) /* line 57 */ ?></span>
	  <span id="infoKey">Nickname:   </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['nickname']) /* line 58 */ ?></span>
	  <span id="infoKey">Gender:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['gender']) /* line 59 */ ?></span>
	  <span id="infoKey">Birth Day:  </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->date, $formData['birth_day'], '%d.%m.%Y')) /* line 60 */ ?></span>
	  <span id="infoKey">Age:        </span><span id="infoValue">&nbsp<?php
		if ($formData['birth_day']!="") {
			echo LR\Filters::escapeHtmlText($date-$formData['birth_day']) /* line 61 */;
		}
?></span>
	  <span id="infoKey">Height:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['height']) /* line 62 */ ?></span>
        </div>

    </div>
 
    <div class="buttonsDiv">
    	<a class="btn btn-outline-danger col-sm-3" href="<?php
		echo $router->pathFor("profile");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 68 */ ?>">Cancel</a>      
    	<a class="btn btn-outline-info col-sm-3" href="<?php
		echo $router->pathFor("profile");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 69 */ ?>">Show <?php
		echo LR\Filters::escapeHtmlText($formData['first_name']) /* line 69 */ ?></a>      
    	<button type="submit" class="btn btn-outline-success col-sm-3">Save</button>
    </div>

  </div>
</form>


<?php
	}

}
