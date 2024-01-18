</div>

<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/datatables-demo.js"></script>

<!-- Pada bagian bawah halaman sebelum tag </body> -->
<script type="text/javascript">
		$(document).ready(function(){		
		    
		 var canvas = document.getElementById("c");
         var ctx = canvas.getContext("2d");
         $("#c").hide();
		 $("#hapus_gambar").hide();
		 $("#valid-feedback").hide();
		 $("#tooltip1").hide();
			
		$("#button_simpan").click(function(){
	        var nama = document.forms["myForm"]["nama"].value;
			var alamat = document.forms["myForm"]["alamat"].value;
			var hp = document.forms["myForm"]["hp"].value;
			var pesan = document.forms["myForm"]["pesan"].value;
			var canvas_foto = document.forms["myForm"]["foto"].value;
			
			var dataURL = canvas.toDataURL();
			

          // Fetch all the forms we want to apply custom Bootstrap validation styles to

          // Loop over them and prevent submission
          
 
		    if (nama == ""){  
			 //event.preventDefault();
			  //alert("nama tidak boleh kosong");
			} else if (alamat == ""){
			  //event.preventDefault();
			 // alert("alamat tidak boleh kosong");	
			}else if (hp == ""){
			  //event.preventDefault();
			  //alert("hp tidak boleh kosong");
			}else if (pesan == ""){
			  //event.preventDefault();
             //alert("pesan tidak boleh kosong");			  
			}else {
				if(canvas_foto == "ada"){
					var data = $('.form-user').serialize() + '&img=' + dataURL;
					$.ajax({
						type: 'POST',
						url: "aksi.php",
						data: data,
						success: function() {
							$('#tampildata').load("tampil.php");
						}
					});
				
					$("#valid-feedback").fadeIn(1500).delay(3500).fadeOut(1500);
					document.getElementById("form-user-id").reset();
					document.getElementById('c').innerHTML ="";
					document.getElementById("foto_canvas").value ="tidak ada";
					$("#buka_kamera").css("border","none");
					$("#c").hide();
					$("#gambar_form").show();
					$("#hapus_gambar").hide();
					$("#buka_kamera").show();				
					event.preventDefault();
					event.stopPropagation();
				}
                else{
					$("#tooltip1").fadeIn(100).delay(3500).fadeOut(1000);
					$("#buka_kamera").css("border","1px solid #b7effb");
					event.preventDefault();
			        event.stopPropagation();
					
				}			
							
			}
			
		});
		
	$("#buka_kamera").click(function() {
			Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90
			});
				Webcam.attach( '#my_camera' );
				$("#simpan_gambar").hide();
        		$("#batal_simpan").hide();
           });
		   
	$("#ambil_foto").click(function() {
			// take snapshot and get image data
			  $("#ambil_foto").hide();
			  $("#simpan_gambar").show();
			  $("#batal_simpan").show();
			  
			  Webcam.freeze();
           });
		   
    $("#simpan_gambar").click(function() {
		    Webcam.snap( function(data_uri) {
				
				// display results in page
				var image = new Image();
               image.onload = function() {
                  ctx.drawImage(image, 0, 0);
               };
                image.src = data_uri;
				//document.getElementById('gambar_form').innerHTML = 
					//'<img src="'+data_uri+'" style="width:70%"/>';
					
			  } );
			document.getElementById("foto_canvas").value = "ada";
			$("#ambil_foto").show();
			$("#c").show();
			$("#gambar_form").hide();
			$("#buka_kamera").hide();
			$("#hapus_gambar").show();
			Webcam.reset();
    	});
	  $("#hapus_gambar").click(function() {
			document.getElementById('c').innerHTML ="";
			document.getElementById("foto_canvas").value ="tidak ada";
			$("#c").hide();
			$("#gambar_form").show();
			$("#hapus_gambar").hide();
			$("#buka_kamera").show();
           });
	 $("#batal_simpan").click(function() {
			Webcam.unfreeze();
			$("#simpan_gambar").hide();
			$("#batal_simpan").hide();
			$("#ambil_foto").show();
           });
		   
    //hide modal form ketika event klik di luar form modal
     	$("#myModal").on('hide.bs.modal', function(){
      		 Webcam.reset();
     	});		   
		   
	 	$("#tutup_kamera").click(function() {
				Webcam.reset();
				$("#simpan_gambar").hide();
				$("#ambil_foto").show();
          		 });
		   
		$("#myInput").on("keyup", function() {
    		var value = $(this).val().toLowerCase();
    			$("#myTable tr").filter(function() {
      			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    		});
  		 });
		   
	});
	</script>



</body>

</html>