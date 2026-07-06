<?php

session_start();

if (empty($_SESSION['logged'])) {
    header('Location: /app/login.php');
    exit;
}

require_once '../lib/utils.php';require_once '../lib/vcard.php';require_once '../lib/qr.php';
$data='../data/contacts.json';$list=json_decode(file_get_contents($data),true)??[];$edit=$_GET['edit']??null;
$duplicate=$_GET['duplicate']??null;

$cur=null;

if($edit){
    foreach($list as $c){
        if($c['slug']===$edit){
            $cur=$c;
            break;
        }
    }
}

if($duplicate){
    foreach($list as $c){
        if($c['slug']===$duplicate){

            $cur=$c;

            unset($cur['slug']);

            $cur['name']='';
            $cur['lastname']='';
            $cur['email']='';
            $cur['mobile']='';
            $cur['phone']='';

            break;
        }
    }
}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $slug=$_POST['slug']??slugFromEmail($_POST['email']);
 if(!is_dir('../uploads/logos')) mkdir('../uploads/logos',0777,true);
 if(!is_dir('../uploads/photos')) mkdir('../uploads/photos',0777,true);
 $logo=$cur['logo']??'';$photo=$cur['photo']??'';
 if(!empty($_FILES['logo']['name'])){ $logo="/app/uploads/logos/$slug.png"; move_uploaded_file($_FILES['logo']['tmp_name'],"../uploads/logos/$slug.png"); }
 if(!empty($_FILES['photo']['name'])){ $photo="/app/uploads/photos/$slug.jpg"; move_uploaded_file($_FILES['photo']['tmp_name'],"../uploads/photos/$slug.jpg"); }
 $c=[ 'slug'=>$slug,'company'=>$_POST['company'],'name'=>$_POST['name'],'lastname'=>$_POST['lastname'],'role'=>$_POST['role'],'mobile'=>$_POST['mobile'],'phone'=>$_POST['phone'],'email'=>$_POST['email'],'web'=>$_POST['web'],'address'=>$_POST['address'],'logo'=>$logo,'photo'=>$photo,'linkedin'=>$_POST['linkedin'],'instagram'=>$_POST['instagram'],'tiktok'=>$_POST['tiktok'] ];
 $list=array_filter($list,fn($x)=>$x['slug']!==$slug);$list[]=$c;
 file_put_contents($data,json_encode($list,JSON_PRETTY_PRINT));
 file_put_contents("../vcards/$slug.vcf",generateVcard($c)); generateQR($slug);
 header('Location:/app/panel/');exit; }
?>
<link rel="stylesheet" href="/app/css/style.css">
<div class="panel">
<h1>Panel interno</h1>
<?php if($cur): ?>
<p style="margin-bottom:20px;">
<a href="/app/panel/">← Volver al listado</a>
</p>
<?php endif; ?>
<form method="post" enctype="multipart/form-data">
<?php if($cur && empty($duplicate)):?>
<input type="hidden" name="slug" value="<?=$cur['slug']?>">
<?php endif;?>
<input name="company" placeholder="Empresa" value="<?=$cur['company']??''?>">
<input name="name" placeholder="Nombre" value="<?=$cur['name']??''?>">
<input name="lastname" placeholder="Apellidos" value="<?=$cur['lastname']??''?>">
<input name="role" placeholder="Cargo" value="<?=$cur['role']??''?>">
<input name="mobile" placeholder="Móvil" value="<?=$cur['mobile']??''?>">
<input name="phone" placeholder="Teléfono" value="<?=$cur['phone']??''?>">
<input name="email" placeholder="Email" value="<?=$cur['email']??''?>">
<input name="address" placeholder="Dirección" value="<?=$cur['address']??''?>">
<input name="web" placeholder="Web" value="<?=$cur['web']??''?>">
<label><strong>Logo de la empresa</strong><br><small>PNG o SVG · Transparente recomendado</small></label>
<input type="file" name="logo" accept="image/*">
<label><strong>Foto de perfil</strong><br><small>JPG o PNG · Se mostrará recortada en círculo</small></label>
<input type="file" name="photo" accept="image/*">
<input name="linkedin" placeholder="LinkedIn" value="<?=$cur['linkedin']??''?>">
<input name="instagram" placeholder="Instagram" value="<?=$cur['instagram']??''?>">
<input name="tiktok" placeholder="TikTok" value="<?=$cur['tiktok']??''?>">
<button>Guardar tarjeta</button>
</form>
<?php if($cur): ?>
<a class="btn-cancel" href="/app/panel/-cancel">Cancelar</a>
<?php endif; ?>
<hr>
<input
    type="text"
    id="searchContact"
    placeholder="Buscar tarjeta..."
>
<ul id="contactList">
<?php foreach($list as $c):?><li><?=$c['name']?> <?=$c['lastname']?> - <?=$c['company']?> | <a href="/app/contacto/?slug=<?=$c['slug']?>" target="_blank">Ver</a> | <a href="/app/qrs/<?=$c['slug']?>.svg" download>QR SVG</a> | <a href="/app/panel/?edit=<?=$c['slug']?>">Editar</a> | <a href="/app/panel/?duplicate=<?=$c['slug']?>">Duplicar</a></li><?php endforeach;?>
</ul>
<script>
document.getElementById('searchContact').addEventListener('keyup', function () {

    const value = this.value.toLowerCase();

    document.querySelectorAll('#contactList li').forEach(li => {

        const text = li.textContent.toLowerCase();

        li.style.display = text.includes(value)
            ? ''
            : 'none';

    });

});
</script>
</div>
