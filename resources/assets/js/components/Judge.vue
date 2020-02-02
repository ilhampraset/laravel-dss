<template>
<div>
	<h1 class="title"><span>Our</span> <span style="color: #c28d4b;">Judges</span></h1>
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<!-- section title -->
				<!-- speaker -->
				<div class="col-md-3 col-sm-6" v-for="i in len">
					<div class="speaker" data-toggle="modal" data-target="#speaker-modal-1">
						<div class="speaker-img">
							<img :src="'/img/judges/adi.jpg'" alt="">
						</div>
						<div class="speaker-body">
							<!-- <div class="speaker-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa fa-linkedin"></i></a>
							</div> -->
							<div class="speaker-content">
								<span>Judge {{i++}}</span>
								<span></span>
							</div>
						</div>
					</div>
				</div>				
			</div>
			<!-- /row -->
		</div>

</div>

</template>

<script>
export default {
  data() {
    return {
      len: 15
    };
  }
};
</script>