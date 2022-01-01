<script>
	var latitud=<?=$lat?>;
	var longitud=<?=$lon?>;
	var icon_png="<?=base_url('img'.'/'.$ico_punt)?>";
</script>
<div id="wraper">
<article id="crp_a_p">
<header id="hdr_a_slc" class="">
	<h2 id="ttl_p"><?=$ttl_a?></h2> 
	<div id="usr_inf"><p><?=$this->lang->line('s_ver_com')?><br><em><?=$user_a?></em></p>
		<img src="<?=base_url('img/user_img/thumb'.'/'.$user_avt) ?>" alt="">   
	</div>
	<div id="time_holder">
		<time datetime="<?=$data_c ?>"><?=date('d·m·Y',time($data_c)) ?></time>
	</div>
	</header><!-- /header -->	
   		<figure>
   			<?php if($file_a!=='0'): ?>
	     <img src="<?=base_url('upload').'/'.$file_a?>" alt="" width="70%">
	 <?php else : ?>
	 		 <img src="<?=base_url('img').'/'.$this->config->item('itm_no_img')?>" alt="" width="70%">
     <?php endif; ?>
		</figure>
		<div id="side_txt">
		<div id="map_cont">
			<div id="map"></div>	
   		</div>
   <?php if($file_s!=0): ?>
	<div id="aud_cnt">
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
<?php endif; ?>
<?php if($vdo_a!==0) :?>
<div id="youtu">
<iframe width="460px" height="258px" src="http://www.youtube.com/embed/<?=$vdo_a?>" frameborder="0" allowfullscreen></iframe>
</div>
<?php endif; ?>
</div>
	    <div id="hst_txt">	
			<?=$txt_a?>
		</div>
</article>
<footer id="ht_foot">
	
</footer>

</div>