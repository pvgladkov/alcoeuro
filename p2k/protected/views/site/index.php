<br/>
<br/>
<br/>
<ul class="nav nav-pills">
	<li class="active">
		<a href="/comp/1">Лига чемпионов</a>
	</li>
</ul>

<a href="/game/new">Создать игру</a>
<br/>
<br/>

<table class="table">
	<tr>
		<th>Всего ставок</th>
		<th>Угадано</th>
		<th>Ничьи</th>
	</tr>
	<tr>
		<td><?=$aStat['all']?></td>
		<td><?=$aStat['win']?></td>
		<td><?=$aStat['tie']?></td>
	</tr>	
</table>
        
<br/>
<?php
if(!empty($aGames)){
	foreach($aGames as $aGame){
		?>
			<p><b><?=$aGame['name']?></b></p>
			<table class="table">
				<tr>
					<th>Всего ставок</th>
					<th>Угадано</th>
				</tr>
				<tr>
					<td><?=$aGame['all']?></td>
					<td><?=$aGame['win']?></td>
				</tr>	
			</table>
			<br/>
		<?php
	}
}

?>