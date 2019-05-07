<!DOCTYPE html>
<html>
    <head>
         <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.bundle.js"></script>
    <script src="https://www.chartjs.org/samples/latest/utils.js"></script>
    </head>
    <body style = "background-image: url('http://wallpapercave.com/wp/yLj2ux8.jpg'); ">
        <div id="content" class= "container text-center vertical-center" style="width:90%; height:90%;margin-top: 10px; color: white; background-image: url('https://aronia.bg/shop/catalog/view/theme/agnes/image/layout/shadows/blur_black.png')">
            <div id ="question"></div>
            <div id = "chart">
                <h1 style = "font-size:64px; ">Study on the impact of Cohort Learning models on students' behavior</h1>
                <br>
                <br>
                <h1>By Luis Valencia </h1>
            </div>
            <button id="next" style="color:black">Next</button>
            <div id ="ch" style="width:100%; height:100%">
            <canvas id="canvas" style="width:100%; height:100%"></canvas>
            </div>
            
                
            
        </div>
        <script>
        
        var i;
        var l=-1;
        var question;
        var responses=[];
        var cohort=[];
        var traditional=[];
        var important = [4,6,7,8,10,11,12]
        $("#next").click(function(){
            l++;
            i= important[l];
            if(l>6){
            	$("#ch").html("<h1 style = 'font-size:64px; '>Thank you for your time</h1>");
            	return;
            }
            cohort=[];
            traditional=[];
            responses=[];
            $("#canvas").remove();
            $("#ch").html("<canvas id='canvas'></canvas>")
             $.ajax({
                type: "post",
                url: "getData.php",
                dataType: "json",
                data:{
                    "question": i
                },
             success: function(data){
                 $("#chart").html("");
                $("#question").html(data[0]);
                question=data[0]["col "+i];
                for(var k = 1; k<data.length; k++){
                	responses.push(data[k].response);
                	if(data[k].type=="cohort")
                		cohort.push(parseFloat(data[k].count));
                	else
                		traditional.push(parseFloat(data[k].count));
               // $("#chart").append(data[k].type +" - "+ data[k].response + " = "+ data[k].count+"%<br><br>" );
                }
                console.log(question);
                responses= responses.slice(0,responses.length/2);
		var barChartData = {
			labels: responses,
			
			datasets: [{
				label: 'Cohorts',
				backgroundColor: window.chartColors.red,
				data: cohort,
			}, {
				label: 'Tradional',
				backgroundColor: window.chartColors.blue,
				data: traditional
			}]
		};
		Chart.defaults.global.defaultFontColor = 'white';
		Chart.defaults.global.defaultFontSize = 17;
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					title: {
						display: true,
						text: question,
						 fontColor: 'white'
					},
					tooltips: {
						mode: 'index',
						intersect: false,
						 fontColor: 'white'
					},
					legend: {
            		labels: {
                // This more specific font property overrides the global property
                		fontColor: 'white'
            		}
            		},
        
					responsive: true,
					scales: {
						 
						xAxes: [{
							stacked: true,
							color: "white"
						}],
						yAxes: [{
							stacked: true,
							
						}],
						fontColor: "white",
						color: 'rgba(255,255,255, 0.9)',
					}
				}
			});
		
	
             }
             });
             
             });
        </script>
    </body>
</html>