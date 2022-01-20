<!-- Sticky Footer -->

<div class="container">
    <div class="row chat-window col-xs-9 col-md-3" id="chat_window_1" style="right:80px;z-index: 1000;">
        <div class="col-xs-12 col-md-12">
        	<div class="card panel-default">
                <div class="card-heading top-bar">
                    <div class="col-md-12 col-12">
                        <h6 ><span class="fa fa-comment"></span> TanyaKami
                        <a href="#" class="text-white float-end"><span id="minim_chat_window" class="fa fa-plus icon_minim"></span></a> <br/>
						<a href="<?php base_url(); ?>hapus.php" class="text-white"><small style='font-size:10px'>Selesai Percakapan</small></a></h6>
                        
                    </div>
                </div>
                <div class="card-body msg_container_base" style="display: none;">
                    <div class="row msg_container base_receive">
                        <div class="col-md-2 col-xs-2 avatar">
                            <img src="<?php echo site_url(); ?>upload/admin.png" class=" img-responsive ">
                        </div>
                        <div class="col-md-10 col-xs-10">
                            <div class="messages msg_receive">
                                <p>Halo, Selamat datang di toko kami, apa yang bisa kami bantu?</p>
                                <time datetime="2009-11-13T20:00">Admin </time>
                            </div>
                        </div>
                    </div>
					
					<div id='list_user'>
					
                    </div>
                   
                </div>
                <div class='card-footer'>
                    <div class='input-group'>
                        <input id='btn-input' type='text' class='form-control input-sm chat_input' autofocus placeholder='Tulis pertanyaan anda disini...' />
                        <span class='input-group-btn'>
                        <button class='btn btn-primary' id='btn-chat'>Send</button>
                        </span>
                    </div>
                </div>
    		</div>
        </div>
    </div>
</div>


<footer class="main-footer d-flex p-2 px-3 border-top" style="background:#001E00">
  <div class="container text-center  col-lg-6 justify-content-center">
  <div class="mb-4 mt-4">
        <a href="<?php echo site_url('produks') ?>" rel="nofollow" class="pe-2 text-white text-decoration-none">Cari Produk</a>
        <a href="<?php echo site_url('docs/store') ?>" rel="nofollow" class="pe-2 text-white text-decoration-none">Lokasi Toko</a>
        <a href="<?php echo site_url('docs/about') ?>" rel="nofollow" class="pe-2 text-white text-decoration-none">Profil A&F</a>
        <a href="<?php echo site_url('docs/term') ?>" rel="nofollow" class="pe-2 text-white text-decoration-none">Term Of Service</a>
        <a href="<?php echo site_url('docs/refund') ?>" rel="nofollow" class="pe-2 text-white text-decoration-none">Refund Policy</a>
      </div>

    <div class="mb-4 mt-3 text-white">
      <p class=""><b>Metode Pembayaran</b></p>
      <img src="<?php echo site_url() ?>upload/bank.png" />
    </div>

    <div class="mb-4 mt-4 text-white">
      <p class=""><b>Yusuf Arifin</b></p>
      <p class="text-sm">
        <small>
          Pasir Putih Pekanbaru
        </small>
      </p>
    </div>

    <span class="copyright text-center text-white">Copyright © 2021
      <a href="#" target="_blank" rel="nofollow" class="text-decoration-none text-white">Product By A&F STORE</a>
    </span>
    <div class="" style="margin-bottom:50px;">&nbsp;</div>
  </div>
</footer>

<?php $this->load->view("admin/_partials/js.php") ?>

<script>
  function openNav() {
    var x = window.matchMedia("(max-width: 700px)")
    myFunction(x)
    x.addListener(myFunction)

  }

  function myFunction(x) {
    if (x.matches) { // If media query matches
      document.getElementById("myNav").style.width = "100%";
    } else {
      document.getElementById("myNav").style.width = "300px";
    }
  }


  function closeNav() {
    document.getElementById("myNav").style.width = "0%";
  }
</script>


<script>
		$(document).on('click', '.card-heading span.icon_minim', function (e) {
			var $this = $(this);
			if (!$this.hasClass('panel-collapsed')) {
				$this.parents('.card').find('.card-body').slideUp();
				$this.addClass('panel-collapsed');
				$this.removeClass('fa fa-minus').addClass('fa fa-plus');
			} else {
				$this.parents('.card').find('.card-body').slideDown();
				$this.removeClass('panel-collapsed');
				$this.removeClass('fa fa-plus').addClass('fa fa-minus');
			}
		});
		$(document).on('focus', '.card-footer input.chat_input', function (e) {
			var $this = $(this);
			if ($('#minim_chat_window').hasClass('panel-collapsed')) {
				$this.parents('.card').find('.card-body').slideDown();
				$('#minim_chat_window').removeClass('panel-collapsed');
				$('#minim_chat_window').removeClass('fa fa-plus').addClass('fa fa-minus');
			}
		});
		$(document).on('click', '#new_chat', function (e) {
			var size = $( ".chat-window:last-child" ).css("margin-left");
			 size_total = parseInt(size) + 400;
			alert(size_total);
			var clone = $( "#chat_window_1" ).clone().appendTo( ".container" );
			clone.css("margin-left", size_total);
		});
		
		$(document).on('click', '#btn-chat', function (e) {		
			var isi 	= $("#btn-input").val();
			if(isi==''){
				document.getElementById('btn-input').style.border ='2px solid red';
				e.preventDefault(); 
			}
			
			var height = 0;
			$('div#chat_window_1').each(function(i, value){
				height += parseInt($(this).height());
			});

			height += '';

			$('div').animate({scrollTop: height});
			
			$.ajax({
				url: "<?php base_url(); ?>chat.php",
				data: "isi=" + isi,
				success: function(data){
					$("#list_user").html(data);
					document.getElementById('btn-input').value ='';
				}
			});
			return false;
			
		});

		$(document).on('click', '#kirimuser', function (e) {		
			var nama 	= $("#nameUser").val();
			if(nama==''){
				document.getElementById('nameUser').style.border ='2px solid red';
				e.preventDefault(); 
			}
			
			var email 	= $("#emailUser").val();
			if(email==''){
				document.getElementById('emailUser').style.border ='2px solid red';
				e.preventDefault(); 
			}
			$.ajax({
				url: "<?php base_url(); ?>register.php",
				data: "email=" + email + "&nama=" + nama,
				success: function(data){
					location.reload();
				}
			});
			return false;
			
		});
		
		
	</script>