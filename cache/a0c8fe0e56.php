<?php
// source: NewPerson.latte

use Latte\Runtime as LR;

class Templatea0c8fe0e56 extends Latte\Runtime\Template
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
		?>New Person<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>
<div class="container">
    <h1>Add New Person</h1>    
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

        <!-- Adresy -->
        <div id="infoSection" class="col-sm-5 form-group">
            <div class="col-sm-11 form-group">
                <label for="city">City</label>
                <input class="form-control" type="text" name="city" placeholder="City" value="<?php echo LR\Filters::escapeHtmlAttr($formData['city']) /* line 57 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="street_name">Street name</label>
                <input class="form-control" type="text" name="street_name" placeholder="Street name" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['street_name']) /* line 62 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="street_number">Street number</label>
                <input class="form-control" type="number" name="street_number" placeholder="Street number" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['street_number']) /* line 67 */ ?>">
             </div>

             <div class="col-sm-11 form-group">
                <label for="zip">Zip</label>
                <input class="form-control" type="text" name="zip" placeholder="Zip" value="<?php echo LR\Filters::escapeHtmlAttr($formData['zip']) /* line 72 */ ?>">
             </div>
        </div>

    </div>
    
    <div class="buttonsDiv">            
      <a class="btn btn-outline-danger col-sm-3" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 79 */ ?>">Cancel</a>      
      <button type="submit" class="btn btn-outline-success col-sm-3">Save</button>
    </div>

  </div>
</form>


<?php
	}

}
