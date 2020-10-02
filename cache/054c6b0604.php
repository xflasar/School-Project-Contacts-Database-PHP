<?php
// source: profileLayout.latte

use Latte\Runtime as LR;

class Template054c6b0604 extends Latte\Runtime\Template
{
	public $blocks = [
		'head' => 'blockHead',
		'body' => 'blockBody',
	];

	public $blockTypes = [
		'head' => 'html',
		'body' => 'html',
	];


	function main()
	{
		extract($this->params);
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="utf-8">
    <title><?php
		$this->renderBlock('title', $this->params, 'html');
?></title>
    <?php
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('head', get_defined_vars());
		?>    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 7 */ ?>/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 8 */ ?>/css/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 9 */ ?>/css/homepageStyle.css">
    <link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 10 */ ?>/css/custom.css">
	<link rel="stylesheet" href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 11 */ ?>/css/profileStyle.css">
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 12 */ ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 13 */ ?>/css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <?php
		if (isset($this->blockQueue["meta"])) {
			$this->renderBlock('meta', $this->params, 'html');
		}
?>

    <script type="text/javascript">
    </script>
</head>
<body>
        <!-- Top navigation menu THIS IS REDUNDANT ASK HOW TO FIX THIS DUMB LAYOUT SHARING!!-->
    <div>

        <div class="HeadNav" role="Banner">
            <div id="nav_logo">
                <div>
                    <div class="nav_logo2">
                        <div class="nav_logo3">
                            <h2>APV Project</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div id="nav_header">
                <div class="nav_header2">
                    <div class="nav_header3">
                        <div class="nav_header4">
                            <div class="navigation_buttons">
                                <ul class="nav_links">
                                    <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 39 */ ?>">Home</a></li>
                                    <li><a href="<?php
		echo $router->pathFor("NewPerson");
?>">Add new person</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="underNav"></div>
            </div>
            <div id="nav_right">
                    <img id="profilePic" src="Resources/images/profilePic.png" width="60" height="60">
                </div>
            <!-- Left Menu?-->
        </div>
    </div>

    <!-- Here goes Profile data -->
	
    <div class="profileBodyTop">
        <div>
	        <div class="profileBodyTop2">
		        <div class="profileBodyTopProfileBkImg">
			        <img id="profilePicBack" src="Resources/images/profilePicBack.png" width="100%" height="100%">
		        </div>
		        <div class="profileBodyTopProfilePic">
			        <img id="profilePic" src="Resources/images/profilePic.png" height="188" width="188">
		        </div>
		
	        </div>
            <div class="profileName">
                <div class="profileName2">
                    <?php echo LR\Filters::escapeHtmlText($info['first_name']) /* line 71 */ ?> <?php echo LR\Filters::escapeHtmlText($info['last_name']) /* line 71 */ ?>

                </div>
            </div>
            <hr></hr>
	        <div class="profileBodyTopProfileUnderPicMenu">
            
	        </div>
            <?php
		$this->renderBlock('body', get_defined_vars());
?>
    </div>
</div>

<div style="font-size:12px;width:auto;height:auto;color:white;justify-content:center;position:fixed;bottom:0;"><span>Created by Martin Flasar @ 2020</span></div>
</body>
</html><?php
		return get_defined_vars();
	}


	function blockHead($_args)
	{
		
	}


	function blockBody($_args)
	{
		
	}

}
