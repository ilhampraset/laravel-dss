<template>
<div id="speakers" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="section-title">
					<h3 class="title"><span class="appear">Our</span> <span class="appear" style="color: #c28d4b;">Judges</span></h3>
				</div>
				<!-- section title -->

				<div class="row">
				<div class="col-md-3 col-sm-6" v-for="i, index in len">
					<div class="speaker" data-toggle="modal" data-target="#speaker-modal-1">
						<div class="speaker-img">
							<img :src="'/img/speaker01.jpg'" alt="">
						</div>
						<div class="speaker-body">
							<!-- <div class="speaker-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa fa-linkedin"></i></a>
							</div> -->
							<div class="speaker-content">
								<span>Judge {{++index}}</span>
								<span></span>
							</div>
						</div>
					</div>
					
				</div>	
				<div align="center">
					<a href="judges" class="main-btn">More</a>
				</div>
							
			</div>

				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
</template>

<script>
export default {
  data() {
    return {
      len: 4
    };
  }
};
</script>