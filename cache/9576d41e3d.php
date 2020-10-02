<?php
// source: UpdateContact.latte

use Latte\Runtime as LR;

class Template9576d41e3d extends Latte\Runtime\Template
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
		if (isset($this->params['c'])) trigger_error('Variable $c overwritten in foreach on line 43');
		$this->parentName = "layout.latte";
		
	}


	function blockTitle($_args)
	{
		?>Contact update<?php
	}


	function blockBody($_args)
	{
		extract($_args);
?>

<div id="block" class="container">
  <h1>Contacts update</h1>   
  <div class="row d-flex justify-content-center">

	 <div id="infoSection" class="col-sm-5 form-group">
	    <form method="post"> 

        		<div class="form-row">
          		   <label id="infoKey" for="id_contact_type">Typ: </label>
          		   <div id="infoValue" class="col-sm-7">
                      <select class="form-control form-control-sm" name="id_contact_type">
        			                <option value="4">E-Mail</option>
                            	<option value="1">FaceBook</option>
                            	<option value="5">Jabber</option>
                            	<option value="2">Skype</option>
                            	<option value="3">Tel.</option>
                            	<option value="6">Web</option>
                      </select>       
        		     </div>                          		
        		</div>
        
            <div class="form-row">
                 <label id="infoKey" for="contact">Contact: </label>
        		     <div id="infoValue" class="col-sm-7">
                  	   <input  class="form-control form-control-sm" type="text" name="contact" placeholder="e.g. christina.flasar@gmail.com" required>             	
        		     </div>
        		</div>
              
         	  <button type="submit" class="btn btn-outline-success col-sm-7 save">Add Contact</button>     
	    </form>
    </div>

  	<div id="infoSection" class="col-sm-5 form-group">
        <h2><?php echo LR\Filters::escapeHtmlText($first_name) /* line 41 */ ?></h2>
<?php
		if ($contacts) {
			$iterations = 0;
			foreach ($contacts as $c) {
				?>      	        <span id="infoKey"><?php echo LR\Filters::escapeHtmlText($c['name']) /* line 44 */ ?>:  </span>
        		    <span id="infoValue">&nbsp<?php echo LR\Filters::escapeHtmlText($c['contact']) /* line 45 */ ?>

          		    <a id="actionButtonRight" class="actionButton" 
          		      href="<?php
				echo $router->pathFor("delete_Contact");
				?>?id_contact=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($c['id_contact'])) /* line 47 */ ?>&id_person=<?php
				echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($c['id_person'])) /* line 47 */ ?>&first_name=<?php
				echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($c['first_name'])) /* line 47 */ ?>" 
          		      onclick="return confirm('Delete contact?')"><i class="fas fa-times-circle"></i>
          		    </a>
        		    </span>
<?php
				$iterations++;
			}
			?>      	    <?php
		}
		else {
?> No contacts assigned
<?php
		}
?>
      </div>
  </div>
    
  <div class="buttonsDiv">
      <a class="btn btn-outline-info col-sm-3" href="<?php
		echo $router->pathFor("profile");
		?>?id_person=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($id_person)) /* line 58 */ ?>">Show <?php
		echo LR\Filters::escapeHtmlText($first_name) /* line 58 */ ?></a>     
  </div>

</div>

<?php
	}

}
