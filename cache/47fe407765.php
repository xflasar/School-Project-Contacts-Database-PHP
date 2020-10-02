<?php
// source: UpdateLocation.latte

use Latte\Runtime as LR;

class Template47fe407765 extends Latte\Runtime\Template
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
		?>Update Location<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>
<div class="container">
    <h1>Location Update</h1>    
</div>    



<form method="post">
  <div id="block" class="container">

    <div class="row d-flex justify-content-center">

        <div id="infoSection" class="col-sm-5 form-group">
             <div class="col-sm-11 form-group">
                <label for="country">Country</label>
                <input class="form-control" type="text" name="country" placeholder="Country" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['country']) /* line 21 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="city">City</label>
                <input class="form-control" type="text" name="city" placeholder="City" value="<?php echo LR\Filters::escapeHtmlAttr($formData['city']) /* line 26 */ ?>">
             </div>
                    
             <div class="col-sm-11 form-group">
                <label for="street_name">Street Name</label>
                <input class="form-control" type="text" name="street_name" placeholder="Street Name" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['street_name']) /* line 31 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="street_number">Street Number</label>
                <input class="form-control" type="number" name="street_number" placeholder="Street Number" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['street_number']) /* line 36 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="zip">Zip</label>
                <input class="form-control" type="text" name="zip" placeholder="Zip" value="<?php echo LR\Filters::escapeHtmlAttr($formData['zip']) /* line 41 */ ?>">
             </div>

      	     <div class="col-sm-11 form-group">
                      <label for="name">Place Name</label>
                      <input class="form-control" type="text" name="name" placeholder="Place Name" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['name']) /* line 46 */ ?>">
             </div>
       
             <div class="col-sm-11 form-group">
                <label for="latitude">Latitude</label>
                <input class="form-control" type="number" step="any" min="-90" max="90" name="latitude" placeholder="Latitude" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['latitude']) /* line 51 */ ?>">
             </div>
             
             <div class="col-sm-11 form-group">
                <label for="longitude">Longitude</label>
                <input class="form-control" type="number" step="any" min="-180" max="180" name="longitude" placeholder="Longitude" value="<?php
		echo LR\Filters::escapeHtmlAttr($formData['longitude']) /* line 56 */ ?>">
             </div>  
             
      </div>                        
       
        <div id="infoSection" class="col-sm-5 form-group">
	<h2>
	  <?php
		if ($formData['city'] != null and $formData['street_name'] != null) {
			echo LR\Filters::escapeHtmlText($formData['city']) /* line 63 */ ?> - <?php echo LR\Filters::escapeHtmlText($formData['street_name']) /* line 63 */ ?>

	  <?php
		}
		elseif ($formData['city'] != null) {
			echo LR\Filters::escapeHtmlText($formData['city']) /* line 64 */ ?>

	  <?php
		}
		elseif ($formData['country'] != null) {
			echo LR\Filters::escapeHtmlText($formData['country']) /* line 65 */ ?>

	  <?php
		}
		elseif ($formData['zip'] != null) {
			echo LR\Filters::escapeHtmlText($formData['zip']) /* line 66 */ ?>

	  <?php
		}
		elseif ($formData['name'] != null) {
			echo LR\Filters::escapeHtmlText($formData['name']) /* line 67 */ ?>

	  <?php
		}
		else {
?> Location
<?php
		}
?>
	</h2>
	<span id="infoKey">Country:       </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['country']) /* line 71 */ ?></span>
	<span id="infoKey">City:          </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['city']) /* line 72 */ ?></span>
	<span id="infoKey">Street name:   </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['street_name']) /* line 73 */ ?></span>
	<span id="infoKey">Street num.:   </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['street_number']) /* line 74 */ ?></span>
	<span id="infoKey">Zip:           </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['zip']) /* line 75 */ ?></span>
	<span id="infoKey">Name:          </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['name']) /* line 76 */ ?></span>
  <span id="infoKey">Latitude:      </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['latitude']) /* line 77 */ ?></span>
  <span id="infoKey">Longitude:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($formData['longitude']) /* line 78 */ ?></span>
        </div>

    </div>

    <div class="buttonsDiv">
      <a class="btn btn-outline-danger col-sm-3" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 84 */ ?>">Cancel</a>   
      <?php
		if ($id_location != null) {
			?><a class="btn btn-outline-info col-sm-3" href="<?php
			echo $router->pathFor("location_Info");
			?>?id_location=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_location)) /* line 85 */ ?>">Show Location info</a><?php
		}
?>

      <button type="submit" class="btn btn-outline-success col-sm-3">Save</button>
    </div>

  </div>
</form>

 

<?php
	}

}
