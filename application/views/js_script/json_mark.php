{"markers":[{ 

	<?php for ($i=0;$i<count($value);$i++): ?>
    {"latitude":"<?=$value[$i]->latitud?>",
     "longitude":"<?=$value[$i]->longitud?>",
    "html":"<h1><?=$value[$i]->titulo?></h1>"
     <?php if($i==count($value)-1):?>
 		}
 	<?php else: ?>
 },{
<?php endif; ?>
<?php endfor;?>]
}
