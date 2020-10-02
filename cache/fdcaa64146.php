<?php
// source: LocationInfo.latte

use Latte\Runtime as LR;

class Templatefdcaa64146 extends Latte\Runtime\Template
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
		?>Location Info<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>

<div id="block" class="container">
    <h1>
    	<?php
		if ($info['city'] != null and $info['street_name'] != null) {
			echo LR\Filters::escapeHtmlText($info['city']) /* line 9 */ ?> - <?php echo LR\Filters::escapeHtmlText($info['street_name']) /* line 9 */ ?>

    	<?php
		}
		elseif ($info['city'] != null) {
			echo LR\Filters::escapeHtmlText($info['city']) /* line 10 */ ?>

    	<?php
		}
		elseif ($info['country'] != null) {
			echo LR\Filters::escapeHtmlText($info['country']) /* line 11 */ ?>

    	<?php
		}
		elseif ($info['zip'] != null) {
			echo LR\Filters::escapeHtmlText($info['zip']) /* line 12 */ ?>

    	<?php
		}
		elseif ($info['name'] != null) {
			echo LR\Filters::escapeHtmlText($info['name']) /* line 13 */ ?>

    	<?php
		}
		else {
?> Location
<?php
		}
?>
    </h1>

  <div class="row d-flex justify-content-center"> 
    <div id="infoSection" class="col-sm-5 form-group">
    
        <a id="actionButtonRight" href="<?php
		echo $router->pathFor("location_Delete");
		?>?id_location=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_location)) /* line 21 */ ?>" onclick="return confirm('Delete location?')">
      	  <span title="Delete Location" id="actionButton">
      	    <i class="fas fa-lg fa-times-circle"></i>
      	  </span>
        </a>
        
      	<a id="actionButtonRight" href="<?php
		echo $router->pathFor("location_Update");
		?>?id_location=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($info['alias_id_location'])) /* line 27 */ ?>">
         <span title="Edit Location" id="actionButton">
      	  <i class="fas fa-lg fa-pencil-alt"></i>  
         </span>
      	</a>

	<h2>Location</h2>
	<span id="infoKey">Country:       </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['country']) /* line 34 */ ?></span>
	<span id="infoKey">City:          </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['city']) /* line 35 */ ?></span>
	<span id="infoKey">Street name:   </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['street_name']) /* line 36 */ ?></span>
	<span id="infoKey">Street num.:   </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['street_number']) /* line 37 */ ?></span>
	<span id="infoKey">Zip:           </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['zip']) /* line 38 */ ?></span>
	<span id="infoKey">Name:          </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['name']) /* line 39 */ ?></span>
  <span id="infoKey">Latitude:      </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['latitude']) /* line 40 */ ?></span>
  <span id="infoKey">Longitude:     </span><span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($info['longitude']) /* line 41 */ ?></span>
    </div>
	
    
  </div>
</div>
<?php
	}

}
