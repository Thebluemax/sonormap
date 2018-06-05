<!doctype html>
<html lang="<?=$this->lang->line('s_lang_set')?>" xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<!-- ############################################################# 	-->
	<!-- 			SONORMAP											-->
	<!--   													           	-->
	<!-- 		 Maximiliano Fernández (@mxml13)  						-->
	<!--   													           	-->
	<!-- ############################################################# 	-->

	<meta charset="utf-8">
	<base href="<?=base_url()?>">
	<link href="<?=base_url('img/favicon.ico')?>" rel="icon"  type="image/x-icon">
	<meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1">

	<link rel="stylesheet" href="<?=site_url('stylesheet/boostrapStyle')?>">
	<link rel="stylesheet" href="<?=site_url('assets/css/base_style.css')?>">
	<!-- Optional theme -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">-->
	<?php for ( $i=0; $i < count($head_html);$i++) : ?>
		<link rel="stylesheet" href="<?=$head_html[$i]?>">
	<?php endfor; ?>
	<title><?=$this->lang->line('s_h1_site').' - '.$page?></title>

</head>
<body>
	<?php if($fb_sdk===TRUE):?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s);
	js.id = id;
	js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=515635181843861";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<?php endif;  ?>
	<div id="main_box">
	<header id="header_p" class="navbar navbar-default ">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="#"><img src="<?=base_url('img/logo.png') ?>" alt="logo" width="30px"></a>
	 	 </div>
	 	 <nav class="navbar-collapse collapse navbar-responsive-collapse">
	  		<ul class="nav navbar-nav">
				<li><a href=<?='"'.site_url('home').'"'?> title=""><?=$this->lang->line('s_nav_inic')?></a></li>
				<li><a href=<?='"'.site_url('historias').'"'?> title="">HISTORIAS</a></li>
			<?php if ($mSecurity):?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<div class="btn-group ">
						<a class=" btn btn-default" id="dropdownMenu1" data-toggle="dropdown" href="" title="">
				<?php if (is_null($avatar)): ?>
				 		<span class="glyphicon glyphicon-user"></span>
						<!--<span class=""></span>-->
				<?php else: ?>
						<img height="20" src="img/user_img/thumb/<?=$avatar?>" alt="">
				<?php endif; ?>
						</a>
						<div class="btn-group">
							<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
	        	<?=$user?>
	    					<span class="caret"></span>
	      					</a>
							<ul  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							 	<li role="presentation">
							 		<a role="menuitem" tabindex="-1" href="<?=site_url('user/perfil') ?>"><span class="glyphicon glyphicon-list-alt"></span> Mi Perfil</a>
							 	</li>
								<li role="presentation">
									<a role="menuitem" tabindex="-1" href="<?=site_url('user/perfil/lista') ?>"><span class="glyphicon glyphicon-map-marker"></span> Mis relatos</a>
								</li>
								<li role="presentation">
									<a role="menuitem" tabindex="-1" href="<?=site_url('arxivar')?>"><span class="glyphicon glyphicon-plus"></span> Relato nuevo</a>
								</li>

							<?php if($mRol>1): ?>
								<li role="presentation" class="divider"></li>
								<li role="presentation">
									<a role="menuitem" tabindex="-1" href="/general" title=""><?=$this->lang->line('web_nav_secret')?></a>
								</li>
				     		 	<li role="presentation">
				     		 		<a role="menuitem" href=<?='"'.site_url('administracion').'"'?> title=""><span class="glyphicon glyphicon-dashboard"></span><?=$this->lang->line('s_nav_adm')?></a>
				     		 	</li>
				     		 <?php endif;?>
								<li role="presentation" class="divider"></li>
								<li role="presentation">
									<a role="menuitem" tabindex="-1" href="<?=site_url('login/out') ?>">Cerrar sesión</a>
								</li>
		     				</ul>
							</div>
						</div>
				</li>
				<?php else:?>
				<li><a href="#" data-toggle="modal" data-target="#loginModal">LOGIN</a></li>
		     	<li><a href=<?='"'.site_url('registrar').'"'?> title=""><?=$this->lang->line('s_nav_ins')?></a></li>
					<?php endif;?>
			</ul>
	  	</nav>
  	</header><!-- /header -->
	<div id="main">
	<section class="container-fluid">
		<?php if(count($url_segments)>0): ?>
	<!--<div>
		<ol class="breadcrumb">
		<?php foreach ($url_segments as $key=>$value): ?>
			<?php if( $key==count($url_segments)):?>
  			<li class="active"><?=strtoupper($value)?></li>
			<?php else: ?>
  			<li><a href="<?=site_url($value)?>"><?=strtoupper($value)?></a></li>
  			<?php endif; ?>
		<?php endforeach; ?>
		</ol>
	</div>-->
	<?php endif; ?>
		<?=$section?>
	</section>
	<aside>
		<?=$aside?>
	</aside>
</div>
	</div>
	<div class="clearfix"></div>
	<footer id ="footer"  class="navbar navbar-inverse ">
		<?=$footer?>
	</footer>
	<?php if (!$mSecurity):?>
		<!--  	modal login -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Entrar</h4>
      </div>
      <div class="modal-body">
		<div id="header_log">
		<div class="container-fluid">
		<form action="<?=site_url('login')?>" method="post" class="form-horizontal" accept-charset="utf-8">
		<div class="form-group">
		<label for="usr_bpod" class="col-lg-2 control-label">Usuario</label>
		<div class="col-lg-6">
		<input type="text" id="usr_id" class="form-control" name="usr_id" placeholder="<?=$this->lang->line('s_plh_usr')?>">
		</div>
		</div>
		<div  class="form-group">
		<label for="password" class="col-lg-2 control-label">Clave de acceso</label>
		<div class="col-lg-6">
		<input type="password" class="form-control" name="password" value="" placeholder="<?=$this->lang->line('s_plh_clv')?>">
		</div>
		</div>
		<div class="form-group">
		<div class="col-lg-6 col-lg-offset-2 ">
		<input type="submit" name="" class="form-control" value="<?=$this->lang->line('s_bttn')?>"><br>
		</div>
		</div>
	</form>
		</div>
	<a href="<?=site_url('login/recuperar_key') ?>"><?=$this->lang->line('s_usr_rckp')?></a>
</div>
</div>
</div>
</div>
</div>
<!-- Fin modal login -->
<?php endif; ?>
	<script>
	</script>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript" src="<?=site_url('js/modernizr') ?>"></script>
	<!--<script type="text/javascript" src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=base_url('js_trd/Alertholder.js')?>"></script>
<?php if($gMap==TRUE): ?>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
	<script type="text/javascript" src="<?=site_url('js/mapengine') ?>"></script>
<?php endif; ?>
	<!--<script type="text/javascript" src="<?=site_url('js/cycle')?>"></script>-->
	<?php if(count($js_script)!=0):?>
		<?php foreach ($js_script as $key => $value) : ?>
	 <script type="text/javascript" src="<?=$value?>"></script>
	<?php endforeach; ?>
	<?php endif;?>
</body>
</html>