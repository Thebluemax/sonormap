<script>
	var latitud=<?=$lat?>;
	var longitud=<?=$lon?>;
	var icon_png="<?=base_url('img'.'/'.$ico_punt)?>";
</script>
<article class="panel panel-default">
	<div class="panel-body">
		<div class="container-fluid">
			<div class="row">
				<div>
				<div id="map_cont">
						<div id="map"></div>
						</div>
					</div>
				</div>
	</div><!--fin row-->
	<div class="row">
	   	<div class="col-lg-12">
			<div class="content-holder">
<?php if($file_a!=='0'): ?>
	   			<figure><img src="<?='upload/'.$file_a?>" alt="" width="100%"></figure>
<?php else : ?>
		<figure><img src="<?='upload/'.$this->config->item('no_image_file')?>" alt="" width="100%"></figure>
<?php endif; ?>
				<div class="side-text">
					<div id="title-bar">
						<h2><?=$ttl_a?></h2>
						<div class="author" >
							  <a href="<?=site_url('ver/card/'.$user_a)?>"><?=$user_a?><!--<img src="<?='img/user_img/thumb/'.$user_avt?>" alt="<?=$user_a?>">--></a> - <time datetime="<?=$data_c ?>"><?=date('d·m·Y',time($data_c))?></time>
						</div>
					</div>
					<p class="lead"><?=$txt_a?></p>
				</div>
<?php if($vdo_a!==0) :?>
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#video-modal">video</button>
<?php endif;?>
			</div>
		</div>
	</div><!--fin row-->
<div clas="row">
   <?php if($file_s!=0): ?>
   	<div  class="col-lg-6">
	<div id="aud_cnt" class="">
	<audio autobuffer  controls>
	<!--	<source src="/media/audio.oga">-->
		<source src="<?=base_url('upload').'/'.$file_s?>">
		<object type="audio/x-wav" data="<?=base_url('upload').'/'.$file_s?>" width="290" height="45">
			<param name="src" value="<?=base_url('upload').'/'.$file_s?>">
			<param name="autoplay" value="false">
			<param name="autoStart" value="0">
			<p><a href="<?=base_url('upload').'/'.$file_s?>">Download this audio file.</a></p>
		</object>
	</audio>
	</div>
	</div>
<?php endif; ?>
</div>
</div>
	<footer class="panel-footer">
	<div class="row">
	<div class="col-lg-4">
<a href="https://twitter.com/share" class="twitter-share-button" data-via="17salt" data-lang="ca" data-size="large">Tuiteja</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
	<div class="col-lg-4">
		<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone col-lg-4" data-annotation="inline" data-width="300"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  window.___gcfg = {lang: 'ca'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
	</div>
	<div class="col-lg-4">
	<fb:like href="<?=current_url()?>" width="450" show_faces="true" send="true"></fb:like>
	</div>
	</div>
</footer>
</article>
<?php if($vdo_a!==0) :?>
	<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="http://www.youtube.com/embed/<?=$vdo_a?>" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

