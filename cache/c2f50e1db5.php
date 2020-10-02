<?php
// source: Locations.latte

use Latte\Runtime as LR;

class Templatec2f50e1db5 extends Latte\Runtime\Template
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
		if (isset($this->params['m'])) trigger_error('Variable $m overwritten in foreach on line 39');
		$this->parentName = "layout.latte";
		
	}


	function blockTitle($_args)
	{
		?>Locations list<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>

<div class="container">
    <h1>Locations<h1>

    <form action="<?php
		echo $router->pathFor("search_Location");
?>" method="post">
      <input style="z-index: 0" id="input" class="form-control col-sm-4" type="text" name="city_name" placeholder="Search (City)" required>
      <button type="submit" id="actionButton" class="btn btn-info">
        <span class="fa fa-search"></span> Search
      </button>
     </form>

     <a id="actionButtonRight" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 17 */ ?>/locations/new"> 
	<button id="actionButton" class="btn btn-success">
	   <span class="fa fa-plus"></span> Add new Location
	</button>
     </a>
</div>


<div class="container mt-5">
    <table class="table table-stripped table-hover" border="0">
        <thead>
          <tr id="header">
            <th>City</th>
            <th>Zip</th>
            <th>Street Name</th> 
            <th>Street Number</th> 
            <th>Place Name</th>
	          <th id="actionTD" style="padding-right: 100px">Acitons</th>
          </tr>
        </thead>	
	<tr></tr>

<?php
		$iterations = 0;
		foreach ($mesta as $m) {
?>
		<tr>
		    <td width="200px"><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->truncate, $m['city'] ?: $empty, 22)) /* line 41 */ ?></td>
		    <td width="100px"><?php echo LR\Filters::escapeHtmlText($m['zip'] ?: $empty) /* line 42 */ ?></td>
		    <td width="200px"><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->truncate, $m['street_name'] ?: $empty, 22)) /* line 43 */ ?></td>		    
		    <td width="160px"><?php echo LR\Filters::escapeHtmlText($m['street_number'] ?: $empty) /* line 44 */ ?></td>
        <td><?php echo LR\Filters::escapeHtmlText(call_user_func($this->filters->truncate, $m['name'] ?: $empty, 30)) /* line 45 */ ?></td>
        <td  id="actionTD">
                <a href="<?php
			echo $router->pathFor("location_Delete");
			?>?id_location=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($m['id_location'])) /* line 47 */ ?>" onclick="return confirm('Delete location?')">
                       <button title="Delete" id="actionButton" class="btn-sm btn-danger">
            		       <i class="fas fa-lg fa-times-circle"></i>
            		       </button>
                </a>

                <a href="<?php
			echo $router->pathFor("location_Update");
			?>?id_location=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($m['id_location'])) /* line 53 */ ?>">
                   <button title="Edit" id="actionButton" class="btn-sm btn-warning">
                     <i class="fas fa-lg fa-pencil-alt"></i>
                   </button>
                </a>
                
                <a href="<?php
			echo $router->pathFor("location_Info");
			?>?id_location=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($m['id_location'])) /* line 59 */ ?>">
                  <button title="Info" id="actionButton" class="btn-sm btn-info">
                    <i class="fas fa-lg fa-info-circle"></i>
                  </button>
                </a> 
            </td>
        </tr>
<?php
			$iterations++;
		}
?>
    </table>
</div>

<?php
		if ($page != null) {
			/* line 71 */
			$this->createTemplate("pages.latte", $this->params, "include")->renderToContentType('html');
		}
?>

<?php
	}

}
