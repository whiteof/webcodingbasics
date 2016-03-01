<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.custom
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();
$this->language  = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/banner.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/jui/bootstrap.min.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/banner.css');
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span6";
}
elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
{
	$span = "span9";
}
elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
{
	$span = "span9";
}
else
{
	$span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($this->params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<jdoc:include type="head" />
		<?php // Use of Google Font ?>
		<?php if ($this->params->get('googleFont')) : ?>
			<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>' rel='stylesheet' type='text/css' />
			<style type="text/css">
				h1,h2,h3,h4,h5,h6,.site-title{
					font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontName')); ?>', sans-serif;
				}
			</style>
		<?php endif; ?>
		<?php // Template color ?>
		<?php if ($this->params->get('templateColor')) : ?>
		<style type="text/css">
			body.site
			{
				border-top: 3px solid <?php echo $this->params->get('templateColor'); ?>;
				background-color: <?php echo $this->params->get('templateBackgroundColor'); ?>
			}
			a
			{
				color: <?php echo $this->params->get('templateColor'); ?>;
			}
			.navbar-inner, .nav-list > .active > a, .nav-list > .active > a:hover, .dropdown-menu li > a:hover, .dropdown-menu .active > a, .dropdown-menu .active > a:hover, .nav-pills > .active > a, .nav-pills > .active > a:hover,
			.btn-primary
			{
				background: <?php echo $this->params->get('templateColor'); ?>;
			}
			.navbar-inner
			{
				-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
				-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
				box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0 rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
			}
		</style>
		<?php endif; ?>
		<!--[if lt IE 9]>
			<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
		<![endif]-->
	</head>

	<body>
		
	    <!-- Fixed navbar -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Обучение <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#" data-toggle="modal" data-target="#modalFree">Получить бесплатный видео урок</a></li>
								<li><a href="#" data-toggle="modal" data-target="#modalBuy">Пройти весь курс</a></li>
								<?php /*
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">- бонусы -</li>
								<li><a href="#">С чего начать поиск работы</a></li>
								<li><a href="#">Как правильно составить резюме</a></li>
								*/?>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Контакты <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mailto:learn@webcodingbasics.com">learn@webcodingbasics.com</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">+1 347 575 6340</a></li>
							</ul>
						</li>
						<li><a href="http://blog.wecodingbasics.com" target="_blank">Полезные статьи</a></li>
					</ul>
					
					<?php if($this->countModules('menu-top-right')): ?>
						<jdoc:include type="modules" name="menu-top-right" style="none" />
					<?php endif ?>
				</div><!--/.nav-collapse -->
			</div>
		</nav>
	
		<div class="header">
			<div class="container">
				<a href="<?php echo $this->baseurl ?>">
					<h1>Как стать web-программистом за <strong>2</strong> недели</h1>
					<h2>Освой web-программирование с нуля и найди достойную высокооплачиваемую работу в США!</h2>
				</a>
			</div>
		</div>

		<?php if($this->countModules('home-message')): ?>
			<div class="banner">
				<img src="<?php echo $this->baseurl ?>/images/video_bg.jpg" id="banner-bg" />
				<div class="bar">
					<div class="top-bar">
						<div class="container">
							<iframe class="img-responsive main-video" src="http://www.youtube.com/embed/xs9hU9OGxkU?fs=0&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;theme=light&amp;wmode=transparent&amp;autoplay=1&amp;autohide=1" allowfullscreen="" frameborder="0"></iframe>
						</div>
					</div>
					<div class="bottom-bar">
						<div class="container">
							<div class="start-button-container">
								<div class="start-button start-button-free">
									<a href="#" data-toggle="modal" data-target="#modalFree">
										<strong>&rarr;&nbsp;&nbsp;</strong>
										Начать сейчас бесплатно!
										<strong>&nbsp;&nbsp;&larr;</strong>
									</a>
								</div>
								<div class="start-button start-button-buy">
									<a href="" data-toggle="modal" data-target="#modalBuy">
										<strong>&rarr;&nbsp;&nbsp;</strong>
										Пройти полный курс!
										<strong>&nbsp;&nbsp;&larr;</strong>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>

		<?php if($this->countModules('home-message')): ?>
			<div class="description">
				<div class="container">
					<h2>
						<jdoc:include type="modules" name="home-message" style="none" />
					</h2>
					<div class="hr-gradient-right"></div>
					<div class="row">
						<div class="col-sm-9">
							<p align="center" class="small-course-image-container"><img src="<?php echo $this->baseurl . '/images/' ?>software_box.png" width="400px"/></p>
							<jdoc:include type="modules" name="home-description" style="none" />
						</div>
						<div class="col-sm-3">
							<div class="image-container"><img src="<?php echo $this->baseurl . '/images/' ?>software_box.png" width="400px"/></div>
						</div>
					</div>
				</div>
				<div class="description-navigation">
					<div class="bar">
						<div class="container">
							<div class="row">
								<div class="col-lg-4 col-sm-6 nav-button">
									<a href="#price">
										<img src="<?php echo $this->baseurl . '/images/' ?>button-money.png" data-active="<?php echo $this->baseurl . '/images/' ?>button-money-active.png" height="80px"/>
										<p>Стоимость курса, гарантия и результат</p>
										<div class="clear_both"></div>
									</a>
								</div>
								<div class="col-lg-4 col-sm-6 nav-button">
									<a href="#author">
										<img src="<?php echo $this->baseurl . '/images/' ?>button-avatar.png" data-active="<?php echo $this->baseurl . '/images/' ?>button-avatar-active.png" height="80px"/>
										<p>Об Авторе</p>
										<div class="clear_both"></div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
		
		<?php if($this->countModules('home-agenda')): ?>
			<div class="agenda">
				<div class="container">
					<jdoc:include type="modules" name="home-agenda" style="none" />
				</div>
			</div>
		<?php endif?>
		
		<?php if($this->countModules('home-price')): ?>
			<a name="price"></a>
			<div class="price-container">
				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<div class="money-back-image-small-container">
								<img class="img-responsive" src="<?php echo $this->baseurl . '/images/' ?>money_back_white.png" />
							</div>
							<jdoc:include type="modules" name="home-price" style="none" />
						</div>
						<div class="col-sm-4 money-back-image-container">
							<img class="img-responsive" src="<?php echo $this->baseurl . '/images/' ?>money_back_white.png" />
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
		
		<?php if($this->countModules('home-author')): ?>
			<a name="author"></a>
			<div class="about-author">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-4 author-image-container">
							<img src="<?php echo $this->baseurl . '/images/' ?>author.png" class="img-responsive" />
						</div>
						<div class="col-md-9 col-sm-8">
							<jdoc:include type="modules" name="home-author" style="none" />
						</div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="main-content">
				<main id="content" role="main" class="<?php echo $span; ?>">
					<!-- Begin Content -->
					<jdoc:include type="message" />
					<jdoc:include type="component" />
					<!-- End Content -->
				</main>
			</div>
		<?php endif ?>
		
		<footer>
			<div class="container">				
				<p>&copy; <?php echo date('Y')?> Сергей Халадинский. Все права защищены.</p>
			</div>
		</footer>

		
		
		<!-- Modal - Free Lesson -->
		<div class="modal fade modal-free" id="modalFree" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">
							Правильное решение!<br />
							Уже скоро Ты станешь веб-программистом!
						</h3>
					</div>
					<div class="modal-body">
						<p>
							Ответь на несколько простых вопросов, укажи свой email и я вышлю тебе певый урок абсолютно бесплатно!
						</p>
						<form action="" method="post">
							<div class="form-group">
								<label for="form[name]">Имя</label>
								<input type="text" class="form-control" name="form[name]" />
							</div>
							<div class="form-group">
								<label for="form[years]">Как давно ты в США?</label>
								<select class="form-control" name="form[years]">
									<option value="0"></option>
									<option value="1">1 год</option>
									<option value="2">2 год</option>
									<option value="3">3 год</option>
									<option value="4">4 год</option>
									<option value="5">5 год</option>
									<option value="6">более 5 лет</option>
								</select>
							</div>
							<div class="form-group">
								<label for="form[job]">Кем работаешь?</label>
								<input type="text" class="form-control" name="form[job]" />
							</div>
							<div class="form-group">
								<label for="form[education]">Образование</label>
								<div class="row">
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="1" /> евляюсь студентом сейчас</li>
											<li><input type="radio" name="form[education]" value="2" /> бакалавр в США</li>
											<li><input type="radio" name="form[education]" value="3" /> комьюнити колледж в США</li>
										</ul>
									</div>
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="4" /> прошел курсы</li>
											<li><input type="radio" name="form[education]" value="5" /> не учусь и не учился в США</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="form[english]">Уровень английского?</label>
								<div class="row">
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="1" /> начальный</li>
											<li><input type="radio" name="form[education]" value="2" /> средний</li>
										</ul>
									</div>
									<div class="col-sm-6">
										<ul class="no-list">
											<li><input type="radio" name="form[education]" value="3" /> разговорный</li>
											<li><input type="radio" name="form[education]" value="4" /> литературный</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="form[why]">Почему ты хочешь научиться программировать? Опиши минимум в 10 словах.</label>
								<textarea name="form[why]" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label for="form[what]">Что бы ты первым делом сделал, если бы уже завтра ты бы нашел работу программистом на $60к в год и полным пакетом бенефитов. Опиши минимум в 10 словах.</label>
								<textarea name="form[what]" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-sm-6">
										<label for="form[sex]">Пол</label>
										<ul class="no-list">
											<li><input type="radio" name="form[sex]" value="male" /> мужской</li>
											<li><input type="radio" name="form[sex]" value="female" /> женский</li>
										</ul>										
									</div>
									<div class="col-sm-6">
										<label for="form[age]">Возраст</label>
										<input type="text" class="form-control" name="form[age]" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="form[email]">Email</label>
								<input type="email" class="form-control" name="form[email]" />
							</div>							
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Получить первый урок!</button>
					</div>
						</form>
				</div>
			</div>
		</div>
		

		<!-- Modal - Buy Course -->
		<div class="modal fade modal-buy" id="modalBuy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">
							Правильное решение!<br />
							Уже скоро Ты станешь веб-программистом!
						</h3>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Стать программистом!</button>
					</div>
				</div>
			</div>
		</div>				
		
		
		<!-- Modal - Question -->
		<div class="modal fade modal-question" id="modalQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="myModalLabel">
							Задай вопрос Сергею!
						</h3>
					</div>
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-danger">Спросить</button>
					</div>
				</div>
			</div>
		</div>		
		
		
		<?php /*
		
		
		<!-- Body -->
		<div class="body">
			<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
				<!-- Header -->
				<header class="header" role="banner">
					<div class="header-inner clearfix">
						<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
							<?php echo $logo; ?>
							<?php if ($this->params->get('sitedescription')) : ?>
								<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
							<?php endif; ?>
						</a>
						<div class="header-search pull-right">
							<jdoc:include type="modules" name="position-0" style="none" />
						</div>
					</div>
				</header>
				<?php if ($this->countModules('position-1')) : ?>
					<nav class="navigation" role="navigation">
						<div class="navbar pull-left">
							<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
						</div>
						<div class="nav-collapse">
							<jdoc:include type="modules" name="position-1" style="none" />
						</div>
					</nav>
				<?php endif; ?>
				<jdoc:include type="modules" name="banner" style="xhtml" />
				<div class="row-fluid">
					<?php if ($this->countModules('position-8')) : ?>
						<!-- Begin Sidebar -->
						<div id="sidebar" class="span3">
							<div class="sidebar-nav">
								<jdoc:include type="modules" name="position-8" style="xhtml" />
							</div>
						</div>
						<!-- End Sidebar -->
					<?php endif; ?>
					<main id="content" role="main" class="<?php echo $span; ?>">
						<!-- Begin Content -->
						<jdoc:include type="modules" name="position-3" style="xhtml" />
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						<jdoc:include type="modules" name="position-2" style="none" />
						<!-- End Content -->
					</main>
					<?php if ($this->countModules('position-7')) : ?>
						<div id="aside" class="span3">
							<!-- Begin Right Sidebar -->
							<jdoc:include type="modules" name="position-7" style="well" />
							<!-- End Right Sidebar -->
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<footer class="footer" role="contentinfo">
			<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
				<hr />
				<jdoc:include type="modules" name="footer" style="none" />
				<p class="pull-right">
					<a href="#top" id="back-top">
						<?php echo JText::_('TPL_CUSTOM_BACKTOTOP'); ?>
					</a>
				</p>
				<p>
					&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
				</p>
			</div>
		</footer>
		<jdoc:include type="modules" name="debug" style="none" />
		*/?>
	</body>
</html>
