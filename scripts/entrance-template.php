<div class="ticket row mt-5 mx-auto shadow border">
	<div class="left-ticket col-8">
		<div class="card text-white border-0 m-0 rounded-0">
			<img class="card-img" src="img/fondo.jpg" alt="Basilica el pilar">
			<div class="card-img-overlay">
				<p class="card-text">PREPÁRATE PARA TU VISITA A LA</p>
				<h4 class="card-title">BASÍLICA DEL PILAR</h4>
				<p class="card-text">29 de Septiembre 2022 / 6PM</p>
				<p class="card-text">Plaza del Pilar, s/n, 50003 Zaragoza / 976 39 74 97</p>
				<br>
				<p class="card-text price"><?php echo number_format($information["price"],2,",",".")."€"; ?></p>
				<p class="card-text">Entrada Individual</p>
				<br>
				<br>
				<br>
				<p class="card-text timetable">Lunes a jueves: de 10:30 a 14:30 y 16:00 a 20:00</p>
				<p class="card-text timetable">Viernes a domingos: de 10:00 a 20:00</p>
			</div>
		</div>

	</div>
	<div class="right-ticket col-4 bg-white">
		<p>VISITA GUIADA<p>
		<h5>BASÍLICA DEL PILAR</h5>
		<br>
		<p><?php echo htmlspecialchars($information["name"])." ".htmlspecialchars($information["surname"]); ?><p>
		<p><?php echo $information["age"]." años / ".ucfirst(htmlspecialchars($information["sex"])); ?></p>
		<p><?php echo $information["dni"]." / ".ucfirst(htmlspecialchars($information["country"])); ?></p>
		<p>Discapacidad: <?php echo ucfirst(htmlspecialchars($information["disability"])); ?></p>
		<br>
		<br>
		<p class="price text-end"><?php echo number_format($information["price"],2,",",".")."€"; ?></p>
		<br>
		<p class="card-text timetable text-end">*Terminos y condiciones de compra en el anverso</p>

	</div>
	
</div>