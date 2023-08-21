<?php if(!isset($pro)){echo 'Página protegida!'; exit;}; ?>


<div id="conteudo_titulo"><h2>Galeria L2 Sentinel</h2></div>
<span id="sl_play" class="sl_command">&nbsp;</span>
	<span id="sl_pause" class="sl_command">&nbsp;</span>
	<section id="slideshow">
	
		
		<a class="play_commands pause" href="#sl_pause" title="Maintain paused">Pause</a>
		<a class="play_commands play" href="#sl_play" title="Play the animation">Play</a>
		
		<div class="container">
			<div class="c_slider"></div>
			<div class="slider">
				<figure>
					<img src="_imagens/img/dummy-640x310-1.jpg" alt="" width="600" height="310" />
					<figcaption>Gludio Town</figcaption>
				</figure><!--
				--><figure>
					<img src="_imagens/img/dummy-640x310-2.jpg" alt="" width="600" height="310" />
					<figcaption>Heine Town</figcaption>
				</figure><!--
				--><figure>
					<img src="_imagens/img/dummy-640x310-3.jpg" alt="" width="600" height="310" />
					<figcaption>Schuttgart Town</figcaption>
				</figure><!--
				-->
			</div>
		</div>
		
		<span id="timeline"></span>
		
		<ul class="dots_commands"><!--
			--><li><a title="Show slide 1" href="#sl_i1">Slide 1</a></li><!--
			--><li><a title="Show slide 2" href="#sl_i2">Slide 2</a></li><!--
			--><li><a title="Show slide 3" href="#sl_i3">Slide 3</a></li><!--
			--><li><a title="Show slide 4" href="#sl_i4">Slide 4</a></li>
		</ul>
		
</section>

<div id="gallery">

<?php

	$select = $conexao->prepare("SELECT * FROM web_galeria ORDER BY id DESC");
	$select->execute();
	if($select->rowCount() <= 0){
		echo "<strong>Nenhuma Imagen Neste Momento</strong>";	
	}
	
	while($res = $select->fetch(PDO::FETCH_ASSOC)){
		echo '<li><a tile="'.$res['titulo'].'" rel="lightbox[roadtrip]" href="'.$res['url'].'"><img src="'.$res['url'].'"></a></li>';	
		
	}

?>

</div>
