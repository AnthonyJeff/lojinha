<div class="row">
	<div class="col-md-3">
		<ul class="nav nav-pills nav-stacked nav-justify" id="myTab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-check-square-o"></i> Vendas Realizadas</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-tags"></i> Mais Vendidos</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-money"></i> Receita Apurada</a>
		  </li>
		</ul>

	</div><!-- ./ col-md-2 -->
	<div class="col-md-9">

		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
		  	<canvas id="sales-week"></canvas>
		  </div>
		  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
		  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
		</div>

	</div><!-- ./ col-md-10 -->
</div><!-- ./ row -->


<script type="text/javascript">
	$(document).ready(function () {

		$.ajax({
			url: "<?php echo $GLOBALS['index']; ?>/controllers/ajax.php",
			type: "post",
			dataType: "html",
			data: {
				action: 'dashboard-charts',
			},
			success: function(request) {
				//alert(request)
				var ctx = document.getElementById("sales-week").getContext("2d");
				var myChart = new Chart(ctx, {
				    type: 'line',
				    data: {
				        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
				        datasets: [{
				            label: '# of Votes',
				            data: [12, 19, 3, 5, 2, 3],
				            backgroundColor: [
				                'rgba(255, 99, 132, 0.2)',
				                'rgba(54, 162, 235, 0.2)',
				                'rgba(255, 206, 86, 0.2)',
				                'rgba(75, 192, 192, 0.2)',
				                'rgba(153, 102, 255, 0.2)',
				                'rgba(255, 159, 64, 0.2)'
				            ],
				            borderColor: [
				                'rgba(255,99,132,1)',
				                'rgba(54, 162, 235, 1)',
				                'rgba(255, 206, 86, 1)',
				                'rgba(75, 192, 192, 1)',
				                'rgba(153, 102, 255, 1)',
				                'rgba(255, 159, 64, 1)'
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }]
				        }
				    }
				});
			}
		})
		
	})
</script>