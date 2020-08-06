<?php /** @var \App\Models\Film $film */ 
//dd($film);?>
<article id="post-{{ $film['id'] }}" class="item movies"> 	
    <div class="poster"> 
		<img src="https://sckatik.ru/wp-content/uploads/2020/04/x1000-3-185x278.jpg" alt="{{ $film['title'] }}">
		<div class="rating">
			<span class="icon-star2"></span>5.56</div>
		<div class="mepo"></div>
		<a href="https://sckatik.ru/triller/film-omen-pererozhdenie-the-prodigy-2019-smotret-onlajn-v-hd-720-kachestve/">
			<div class="see"></div>
		</a>
	</div>
	<div class="data">
		<h3>
				<!--<span class="flag" style="background-image: url()"></span> -->
                <a href="#">
                    {{ $film['title'] }}
                </a>
        </h3>
        <span>&nbsp;</span>
    </div>

	<div class="animation-1 dtinfo left">
        <div class="title">
            <h4>{{ $film['title'] }}</h4>
        </div>
        <div class="metadata">
            <span>92 мин. </span>			
        </div>
        <div class="texto">
             {{ Illuminate\Support\Str::limit($film['content'], 80, $end='...') }}   
           
        </div>
        <div class="genres">
            <div class="mta">
                @each('films.blocks.list.genre', $film['genres'], 'genre')
            </div>
        </div>
    </div>

</article>
