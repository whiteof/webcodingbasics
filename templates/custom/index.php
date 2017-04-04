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
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/mod_survey_stepone.js?v=2');
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
		
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/favicon-16x16.png">
		<link rel="manifest" href="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		
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
							<a href="#" role="button" data-toggle="modal" data-target="#modalFree">Участвовать в программе</a>
							<?php /*
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Обучение <span class="caret"></span></a>
							<ul class="dropdown-menu course-menu">
								<?php
									$user = JFactory::getUser();
								?>
								<?php if(!in_array('2', $user->groups)): ?>
									<li><a href="#" data-toggle="modal" data-target="#modalFree">Получить бесплатный видео урок</a></li>
								<?php endif ?>
								<?php if(!in_array('11', $user->groups)): ?>
									<li><a href="#" data-toggle="modal" data-target="#modalBuy">Участвовать в программе</a></li>
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
							*/?>
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
					<h1>Трудоустройство в США - Работа программистом от $50,000 в год</h1>
					<h2>Программа по обучению веб-программированию с нуля и трудоустройству в США!</h2>
				</a>
			</div>
		</div>

		<?php if($this->countModules('home-message')): ?>
			<div class="banner">
				<img src="<?php echo $this->baseurl ?>/images/video_bg.jpg" id="banner-bg" />
				<div class="bar">
					<div class="top-bar">
						<div class="container">
							<iframe class="img-responsive main-video" src="http://www.youtube.com/embed/tImkoovQVSs?fs=0&amp;iv_load_policy=3&amp;modestbranding=1&amp;rel=0&amp;showinfo=0&amp;theme=light&amp;wmode=transparent&amp;autoplay=1&amp;autohide=1" allowfullscreen="" frameborder="0"></iframe>
						</div>
					</div>
					<div class="bottom-bar">
						<div class="container">
							<div class="start-button-container">
								<?php /*
								<div class="start-button start-button-free">
									<a href="#" data-toggle="modal" data-target="#modalFree">
										<strong>&rarr;&nbsp;&nbsp;</strong>
										Начать сейчас бесплатно!
										<strong>&nbsp;&nbsp;&larr;</strong>
									</a>
								</div>
								*/?>
								<div class="start-button start-button-buy">
									<a href="#" data-toggle="modal" data-target="#modalFree">
										<strong>&rarr;&nbsp;&nbsp;</strong>
										Начать сейчас бесплатно!
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
			<div class="description grey-container">
				<div class="container">
					<h2>
						<jdoc:include type="modules" name="home-message" style="none" />
					</h2>
					<h4 class="desc-comment">Данная программа создана, чтобы помочь людям стать программистами и включает в себя экспресс-видеокурс по веб-программированию и помощь в поиске работы в США</h4>
					<div class="hr-gradient-right"></div>
					<h3>Три этапа:</h3>
					<div class="row steps">
						<div class="col-sm-4">
							<div class="step-bar">
								<img src="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/step_1.png" />
							</div>
							<p style="color: #2469c0;">Пройди обучение</p>
						</div>
						<div class="col-sm-4">
							<div class="step-bar">
								<img src="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/step_2.png" />
							</div>
							<p style="color: #e2691e;">Сдай тест</p>
						</div>
						<div class="col-sm-4">
							<div class="step-bar">
								<img src="<?php echo $this->baseurl . '/templates/' . $this->template ?>/images/step_3.png" />
							</div>
							<p style="color: #28b751;">Получи работу мечты</p>
						</div>
					</div>
					<hr style="border-top: 1px solid #fff;" />
					<p align="center"><a class="btn btn-danger" data-toggle="modal" data-target="#modalFree">→&nbsp;Начать сейчас бесплатно&nbsp;←</a></p>
				</div>
			</div>
			<div class="description">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<!--
							<p align="center" class="small-course-image-container"><img class="img-responsive" src="<?php echo $this->baseurl . '/images/' ?>software_box.png" /></p>
							<div class="image-container"><img class="img-responsive" src="<?php echo $this->baseurl . '/images/' ?>software_box.png" /></div>
							-->
							
							<div class="custom">
								<h3>Экспресс-видеокурс</h3>
								<p><img class="img-responsive course-image" src="<?php echo $this->baseurl . '/images/' ?>software_box.png" /></p>
								<h4>Экспресс-видеокурс по основам веб-программирования для начинающих</h4>
								<p>Данный курс состоит из семи уроков и рассчитан на людей без особых технических знаний или специального образования.</p>
								<p>
									Просто <a href="#" data-toggle="modal" data-target="#modalFree">оставь свой e-mail</a>, и я пришлю тебе первый видео урок совершенно бесплатно! Пройдя всего лишь этот один бесплатный урок, ты уже сможешь делать простые веб-сайты, которые смело можно включать в свое резюме!
									Пройдя же весь курс, мы с тобой создадим реальный интернет магазин. Ты получишь знания и навыки, с которыми смело можно начинать поиск работы и реально менять свою жизнь.
								</p>
								<p><a class="read-more" href="#course">подробнее&raquo;</a></p>
								<?php /*
								<p>&nbsp;</p>
								<p><a class="btn btn-danger" data-toggle="modal" data-target="#modalFree">→&nbsp;Начать сейчас бесплатно!&nbsp;←</a></p>
								*/?>
							</div>
							<!--<jdoc:include type="modules" name="home-description" style="none" />-->
						</div>
						<div class="col-sm-6">
							<div class="custom employment">
								<h3>Трудоустройство</h3>
								<p><img class="img-responsive employment-image" src="<?php echo $this->baseurl . '/images/' ?>employment.png" /></p>
								<h4>После прохождения экспресс-видеокурса начинается непосредственно процесс трудоустройства</h4>
								<p>Как это работает?</p>
								<ol>
									<li>Внутреннее интервью со мной или моими помощниками для выяснения твоей текущей ситуации и знаний основ программирования после прохождения экспресс видеокурса</li>
									<li>Работа над составлением и рассылкой твоего резюме</li>
									<li>Подготовка к интервью</li>
									<li>Работа над ошибками после прохождения реальных интервью</li>
								</ol>
								<p><a class="read-more" href="#employment">подробнее&raquo;</a></p>
							</div>							
						</div>
					</div>
					<p>&nbsp;</p>
					<p align="center"><a class="btn btn-danger" data-toggle="modal" data-target="#modalFree">→&nbsp;Участвовать в программе&nbsp;←</a></p>
				</div>
				<div class="description-navigation">
					<div class="bar">
						<div class="container">
							<div class="row">
								<?php /*
								<div class="col-lg-4 col-sm-6 nav-button">
									<a href="#price">
										<img src="<?php echo $this->baseurl . '/images/' ?>button-money.png" data-active="<?php echo $this->baseurl . '/images/' ?>button-money-active.png" height="80px"/>
										<p>Стоимость программы, гарантия и результат</p>
										<div class="clear_both"></div>
									</a>
								</div>
								*/?>
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
					<a name="course"></a>
					<jdoc:include type="modules" name="home-agenda" style="none" />
				</div>
			</div>
		<?php endif?>
		
		<?php if($this->countModules('home-price')): ?>
			<div class="employment-details">
				<div class="container">
					<a name="employment"></a>
					<h2>Трудоустройство</h2>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<td width="100px">
										<div class="agenda-step-container">1</div>
									</td>
									<td>→</td>
									<td width="100px">
										<div class="agenda-step-container">2</div>
									</td>
									<td>→</td>
									<td width="100px">
										<div class="agenda-step-container">3</div>
									</td>
									<td>→</td>
									<td width="100px">
										<div class="agenda-step-container">4</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<h4>1. Внутреннее интервью</h4>
							<p>После того, как ты самостоятельно пройдешь экспресс-видеокурс по основам веб-программирования, мы назначаем внутреннее телефонное интервью со мной или моими помощниками. На этом интервью мы выясняем твои знания в веб-программировании, т.е. успешно ли ты прошел видеокурс, отвечаем на твои вопросы, составляем рекомендации - в каком направлении тебе стоит подтянуть свои знания и навыки.</p>
							<p>Если ты успешно усвоил большую часть материала и готов к дальнейшим действиям, мы открываем тебе доступ к закрытой группе в контакте, где ты можешь задавать вопросы мне и моим помощникам. В этой группе я регулярно публикую свежие вакансии. Таким образом, <strong>ты получаешь пожизненную поддержку в вопросах поиска работы!</strong></p>
						</div>
						<div class="col-sm-6">
							<h4>2. Работа над резюме</h4>
							<p>Следующим этапом трудоустройства идет работа над резюме. Мы поможем тебе составить резюме. Правильно составленное резюме - это 50% успеха. Ведь только когда твое резюме будет привлекать работодателей и рекрутеров, начнет работать закон больших чисел, т.е. тебя постоянно будут звать на интервью, и рано или поздно ты точно найдешь работу, т.к. на каждом интервью вопросы будут очень похожими. Мы объясним тебе, куда отправлять свое резюме, на каких сайтах регистрироваться, как создавать профайлы, чтобы они соответствовали твоему резюме и выглядели правдоподобно.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<h4>3. Подготовка к интервью</h4>
							<p>Далее мы готовим тебя к интервью - ты узнаешь, как себя вести, что говорить рекрутерам, а что конкретно работодателю. Мы поможем тебе составить хороший рассказ о себе, чтобы он был краткий и в то же время отвечал на большинство вопросов, которые должен задать рекрутер. Такой рассказ особенно важен, если уровень твоего английского оставляет желать лучшего. Ведь первое интервью с рекрутером или работодателем, как правило, проходит по телефону, да еще и связь всегда подводит. Т.е. чем больше ты расскажешь сам, тем меньше у тебя спросят.</p>
						</div>
						<div class="col-sm-6">
							<h4>4. Работа над ошибками</h4>
							<p>Далее идет работа над ошибками - ты должен будешь записывать вопросы, которые тебе задавали на интервью, и которые у тебя вызвали трудности. Мы посоветуем, как на них нужно было отвечать. Ты увидишь, что рекрутеры, как и сами работодатели, очень часто задают одни и те же вопросы. Т.е. каждое интервью с хорошо проделанной работой над ошибками - это огромный шаг к успеху и новой работе!</p>
						</div>
					</div>
					<p><br /><a class="btn btn-danger" data-toggle="modal" data-target="#modalFree">→&nbsp;Участвовать в программе&nbsp;←</a></p>
					<p>&nbsp;</p>
				</div>
			</div>
		<?php endif?>
		
		<?php /*if($this->countModules('home-price')): ?>
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
		<?php endif */ ?>
		
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
												<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modalBuy">Участвовать в программе</a>
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
				<p>&copy; <?php echo date('Y')?> Сергей Холодинский. Все права защищены.</p>
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
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-75724040-2', 'auto');
		  ga('send', 'pageview');
		
		</script>		
	</body>
</html>
