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
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/mod_survey_stepone.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/mod_room_buy.js');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/mod_contact.js');
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
							<ul class="dropdown-menu course-menu">
								<?php
									$user = JFactory::getUser();
								?>
								<?php if(!in_array('2', $user->groups)): ?>
									<li><a href="#" data-toggle="modal" data-target="#modalFree">Получить бесплатный видео урок</a></li>
								<?php endif ?>
								<?php if(!in_array('11', $user->groups)): ?>
									<li><a href="#" data-toggle="modal" data-target="#modalBuy">Пройти весь курс</a></li>
								<?php endif ?>
								<?php if(in_array('2', $user->groups)): ?>
									<?php if(!in_array('11', $user->groups)): ?>
										<li role="separator" class="divider"></li>
										<li class="dropdown-header">- курс -</li>
									<?php endif ?>
									<li><a href="<?php echo $this->baseurl?>/course/lesson1/part1">Урок 1</a></li>
									<li><a href="<?php echo $this->baseurl?>/course/lesson2/part1">Урок 2<?php if(!in_array('10', $user->groups)) echo '<small>не доступен</small>' ?></a></li>
									<li><a href="<?php echo $this->baseurl?>/course/lesson3/part1">Урок 3<?php if(!in_array('11', $user->groups)) echo '<small>не доступен</small>' ?></a></li>
									<li><a href="<?php echo $this->baseurl?>/course/lesson4/part1">Урок 4<?php if(!in_array('11', $user->groups)) echo '<small>не доступен</small>' ?></a></li>
									<li><a href="<?php echo $this->baseurl?>/course/lesson5/part1">Урок 5<?php if(!in_array('11', $user->groups)) echo '<small>не доступен</small>' ?></a></li>
									<li><a href="<?php echo $this->baseurl?>/course/lesson6/part1">Урок 6<?php if(!in_array('11', $user->groups)) echo '<small>не доступен</small>' ?></a></li>
									<li><a href="<?php echo $this->baseurl?>/course/lesson7/part1">Урок 7<?php if(!in_array('11', $user->groups)) echo '<small>не доступен</small>' ?></a></li>
								<?php endif ?>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Контакты <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="mailto:learn@webcodingbasics.com">learn@webcodingbasics.com</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">+1 718 844 2413</a></li>
							</ul>
						</li>
						<?php /*
						<li><a href="http://blog.wecodingbasics.com" target="_blank">Полезные статьи</a></li>
						*/ ?>
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
									<a href="#" data-toggle="modal" data-target="#modalBuy">
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
			<?php 
				$app = JFactory::getApplication();
				$input = $app ->input;
				$componentName = $input ->get('option');
			?>
			<?php if($this->countModules('course-sidemenu')): ?>
				<div class="main-content">
					<main id="content" role="main" class="<?php echo $span; ?>">
						<div class="container">
							<div class="row row-offcanvas row-offcanvas-left">
								<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
									<div class="list-group">
										<div class="bar">
											<jdoc:include type="modules" name="course-sidemenu" style="none" />
										</div>
									</div>
								</div>
									
								<div class="col-xs-12 col-sm-9">
									<p class="pull-left visible-xs">
										<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
									</p>
									<div class="parent-title">
										<?php
											$menu = JFactory::getApplication()->getMenu();
											$parent = $menu->getItem($menu->getActive()->parent_id);
											echo $parent->title;
										?>
									</div>
									<div class="bar">
										<jdoc:include type="message" />
										<jdoc:include type="component" />
										<?php if(!in_array('11', $user->groups)): ?>
											<p class="buy-course-bottom">
												<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modalBuy">Пройти полный курс</a>
											</p>
										<?php endif ?>
									</div>
								</div>
							</div>
						</div>
					</main>
				</div>
			<?php else: ?>
				<div class="main-content">
					<div class="container">
						<div class="bar">
							<main id="content" role="main" class="<?php echo $span; ?>">
								<!-- Begin Content -->
								<jdoc:include type="message" />
								<jdoc:include type="component" />
								<!-- End Content -->
							</main>
						</div>
					</div>
				</div>
			<?php endif ?>		
		<?php endif ?>
		
		<footer>
			<div class="container">				
				<p>&copy; <?php echo date('Y')?> Сергей Халадинский. Все права защищены.</p>
			</div>
		</footer>

		<jdoc:include type="modules" name="home-survey-stepone" style="none" />
		
		<jdoc:include type="modules" name="home-room-buy" style="none" />
		
		<jdoc:include type="modules" name="contact-form" style="none" />	

		<?php $payment = JRequest::getVar('payment'); ?>
		<?php if($payment == 'success'): ?>
			<!-- Modal - Buy Course -->
			<div class="modal fade modal-buy" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h3 class="modal-title" id="myModalLabel">
								Оплата получена!<br />
								Уже скоро Ты станешь веб-программистом!
							</h3>
						</div>
						<div class="modal-body">
							<p><strong>Спасибо за оплату!</strong></p>
							<p>Теперь проверь свой электронный ящик. Там тебя ожидает ссылка на первый урок.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(window).load(function(){
					jQuery('#modalSuccess').modal('show');
				});
			</script>
		<?php endif ?>
	</body>
</html>
