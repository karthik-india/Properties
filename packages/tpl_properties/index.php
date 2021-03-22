<?php defined('_JEXEC') or die('Restricted access');?>
<?php 

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$params = $app->getTemplate(true)->params;

$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . htmlspecialchars(JUri::root() . $this->params->get('logoFile'), ENT_QUOTES) . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle'), ENT_COMPAT, 'UTF-8') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
$doc = JFactory::getDocument();
$doc->addStyleSheet('templates/' . $this->template . '/assets/css/bootstrap.min.css');
$doc->addStyleSheet('templates/' . $this->template . '/assets/css/style.css');
$doc->addScript('templates/' . $this->template . '/assets/js/bootstrap.min.js', 'text/javascript');
$doc->addScript('templates/' . $this->template . '/assets/js/main.js', 'text/javascript');
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<jdoc:include type="head" />
<!-- <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/css/bootstrap.min.css" type="text/css" /> -->
<!-- <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/assets/css/template.css" type="text/css" /> -->
</head>
<body>
    <!-- Header -->
    <header class="header" role="banner">
        <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">   
            <div class="header-inner clearfix">                
                <nav class="navbar navbar-expand-lg navbar-light bg-light">                    
                    <a class="navbar-brand" href="<?php echo $this->baseurl; ?>/">
                        <?php echo $logo; ?>
                        <?php if ($this->params->get('sitedescription')) : ?>
                            <?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription'), ENT_COMPAT, 'UTF-8') . '</div>'; ?>
                        <?php endif; ?>
                    </a>
                    <?php if ($this->countModules('position-1')) : ?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <jdoc:include type="modules" name="position-1" style="none" />
                    </div>
                    <?php endif; ?>
                </nav>        
            
            </div>
        </div>
    </header>
    
    <main id="content" role="main">
        <div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">       
            <jdoc:include type="modules" name="position-2" style="xhtml" />
            <jdoc:include type="message" />
            <jdoc:include type="component" />
            <div class="clearfix"></div>
            <jdoc:include type="modules" name="position-3" style="none" />
        </div>
    </main>
    <!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />		
            <div class="copy-right-text text-center">	
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
            </div>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>