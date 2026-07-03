<?php
$slug=$_GET['slug']??'';$list=json_decode(file_get_contents('../data/contacts.json'),true)??[];foreach($list as $c)if($c['slug']===$slug)$x=$c; if(!isset($x)) die('No encontrado');
$map='https://www.google.com/maps/search/?api=1&query='.urlencode($x['address']);
$headerPhone=$x['mobile']?:$x['phone'];
?>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />

<link rel="stylesheet" href="/app/css/style.css">
<div class="card">
<div class="header">
<?php if($x['logo']):?><img src="<?=$x['logo']?>" style="max-width:140px"><br><?php endif;?>
<?php if($x['photo']):?><img src="<?=$x['photo']?>" class="avatar"><?php endif;?>
<h1><?=$x['name']?> <?=$x['lastname']?></h1>
<?php if($headerPhone):?><div class="header-phone"><?=$headerPhone?></div><?php endif;?>
<h2><?=$x['role']?></h2>
</div>
<div class="actions">
<a class="btn primary" href="/app/vcards/<?=$x['slug']?>.vcf">Guardar contacto</a>
<?php if($x['mobile']):?><a class="btn secondary" href="tel:<?=$x['mobile']?>">Llamar</a><?php endif;?>
<?php if($x['email']):?><a class="btn secondary" href="mailto:<?=$x['email']?>">Email</a><?php endif;?>
</div>
<div class="details">
<?php if($x['company']):?><div class="row"><div class="icon"><span class="material-symbols-outlined">
work
</span></div><div><div class="value"><?=$x['company']?></div><div class="label"><?=$x['role']?></div></div></div><?php endif;?>
<?php if($x['mobile']):?><div class="row"><div class="icon"><span class="material-symbols-outlined">
call
</span></div><div><div class="value"><?=$x['mobile']?></div><div class="label">Móvil</div></div></div><?php endif;?>
<?php if($x['phone']):?><div class="row"><div class="icon"><span class="material-symbols-outlined">
deskphone
</span></div><div><div class="value"><?=$x['phone']?></div><div class="label">Teléfono</div></div></div><?php endif;?>
<?php if($x['email']):?><div class="row"><div class="icon"><span class="material-symbols-outlined">
mail
</span></div><div><div class="value"><?=$x['email']?></div><div class="label">Email</div></div></div><?php endif;?>
<?php if($x['address']):?><div class="row"><div class="icon"><span class="material-symbols-outlined">
location_on
</span></div><div><div class="value"><?=$x['address']?></div><a class="map" href="<?=$map?>" target="_blank">MOSTRAR EN MAPA</a></div></div><?php endif;?>
<?php if($x['web']):?><div class="row"><div class="icon"><span class="material-symbols-outlined">
language
</span></div><div><div class="value"><?=$x['web']?></div><div class="label">Página web</div></div></div><?php endif;?>
</div>
<div class="social">
<?php if($x['linkedin']):?><a href="<?=$x['linkedin']?>">LinkedIn</a><?php endif;?>
<?php if($x['instagram']):?><a href="<?=$x['instagram']?>">Instagram</a><?php endif;?>
<?php if($x['tiktok']):?><a href="<?=$x['tiktok']?>">TikTok</a><?php endif;?>
</div>
</div>