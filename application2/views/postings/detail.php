<?php
if($gambar <> 'blankgambar.jpg'){ 
echo
'
<div id="portfolio" class="bottom-border-shadow">
    <img alt="" src="'.base_url().'media/upload/'.$gambar.'" style="width:100%" >
</div>
<p>&nbsp;</p>
';
}
?>
<div class="headline">
<h2><?php if(!empty($judul_posting)){ echo $judul_posting; } ?></h2>
</div>
<?php if(!empty($isi_posting)){ echo $isi_posting; } ?>