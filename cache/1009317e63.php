<?php
// source: layout.latte

use Latte\Runtime as LR;

class Template1009317e63 extends Latte\Runtime\Template
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
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 11 */ ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 12 */ ?>/css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <?php
		if (isset($this->blockQueue["meta"])) {
			$this->renderBlock('meta', $this->params, 'html');
		}
?>

    <script type="text/javascript">

    $(function()
    {
        // this will let use buttons inside clickable tr elements of the table
        $('.buttonTable').click(function (e) {
            e.stopPropagation();
        });
    });

</script>
</head>
<body>
        <!-- Top navigation menu-->
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
                                    <li><a href="<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($basePath)) /* line 47 */ ?>">Home</a></li>
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
        </div>
    </div>
<?php
		$this->renderBlock('body', get_defined_vars());
?>
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
