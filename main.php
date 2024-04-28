<!DOCTYPE html>
<html>
<head>
	<title>PIONEER GEOCODING TOOL</title>

	<?php include_once "partials/header.php"  ?>

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<!-- <form> -->
					<div class="form-group">
						<label for="entry_field">ADDRESSES</label>
						<textarea type="email" class="form-control" id="entry_field" aria-describedby="entry_field" placeholder="Enter Addresses"></textarea>
						<small id="emailHelp" class="form-text text-muted">
							<?php 
							include_once "partials/instructions.php"
							?>

						</small>
						<br>
						<label for="api_key">GOOGLE API KEY</label>
						<input type="text" class="form-control" id="api_key" aria-describedby="api_key" placeholder="Enter API KEY">
					</div>
					<button onclick="getdata()" class="btn btn-success">GO</button>
				<!-- </form>	 -->
			</div>
		</div>
	</div>

	<hr>
	<hr>

<!-- 	RESULT -->
	<div class="container">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">No.</th>
							<th scope="col">ADDRESS</th>
							<th scope="col">LATITUDE</th>
							<th scope="col">LONGITUDE</th>
							<th scope="col">REMARKS</th>
						</tr>
					</thead>
					<tbody id="result">
						
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
	
<!-- bounadries 
	latitude : 3N to 25N
	longitude : 115E to 130E
-->

</body>
</html>

<script type="text/javascript">

	$(document).ajaxError(function(event,xhr,options,exc){

	})

	async function getdata(){
		let address = $('#entry_field').val();
		let key = $('#api_key').val();
		let address_array = address.split('\n');
		let count = address_array.length;
		let latmin = 3;
		let latmax = 25;
		let longmin = 115;
		let longmax = 130;

 
		let bounds = `${latmin},${longmin}|${latmax},${longmax}`;

		let table = "";

		if(key==""){
			alert('Please enter an API KEY!');
		}
		else{
			for (let i = 0; i<count; i++) {
				try{
					await $.ajax({
						url:`https://maps.googleapis.com/maps/api/geocode/json?address=${address_array[i]}&bounds=${bounds}&key=${key}`,
						method:"GET",
						success: function(data){
							console.log(data);
							console.log(data.results.length);
							if(data.results.length==0){
								console.log("TAMA");
								let line = `
									<tr>
										<td>${i+1}</td>
										<td>${address_array[i]}</td>
										<td>ERROR</td>
										<td>ERROR</td>
										<td>ERROR</td>
									</tr>
								`;
								console.log(line);
								table += line;
								$('#result').html(table);
							}
							else{
								console.log("PUMASOK");
								let line = `
									<tr>
										<td>${i+1}</td>
										<td>${address_array[i]}</td>
										<td>${data.results[0].geometry.location.lat}</td>
										<td>${data.results[0].geometry.location.lng}</td>
								`;

								if (data.results[0].geometry.location.lat > latmin && data.results[0].geometry.location.lat < latmax) {
									if (data.results[0].geometry.location.lng > longmin && data.results[0].geometry.location.lng < longmax) {
										line +=`<td>FOUND</td>`;
									}
									else{
										line +=`<td>ERROR</td>`;
									}
								}
								else{
									line +=`<td>ERROR</td>`;
								}

								line +=`		
									</tr>
								`;
								console.log(line);
								table += line;
								$('#result').html(table);
							}


						}
						// ,
						// error: function(err){
						// 	let line = `
						// 		<tr>
						// 			<td>${i+1}</td>
						// 			<td>${address_array[i]}</td>
						// 			<td>ERROR</td>
						// 			<td>ERROR</td>
						// 			<td>ERROR</td>
						// 		</tr>
						// 	`;
						// 	console.log(line);
						// 	console.log('err', err);
						// 	table += line;
						// }
					}).fail(function(err){
						// console.log('FAIL');
						let line = `
								<tr>
									<td>${i+1}</td>
									<td>${address_array[i]}</td>
									<td>ERROR</td>
									<td>ERROR</td>
									<td>ERROR</td>
								</tr>
							`;
							console.log(line);
							console.log('err', err);
							table += line;
							$('#result').html(table);
					});
				}catch(err){
					console.log(err);
				}
				}

			$('#result').html(table);	
			alert('DONE!');
		}
			
	}
</script>
