<template>
	<div id="sponsors" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="section-title">
					<h3 class="title"><span class="appear">Our</span> <span class="appear" style="color: #c28d4b;">Sponsors</span></h3>
				</div>
				<!-- /section title -->

				<!-- sponsor -->
				<div class="col-md-3 col-sm-4 col-xs-6" v-for="i in len">
					<a href="#" class="sponsor">
						<img :src="'/img/kopi.jpg'" alt="">
					</a>
				</div>
				<!-- /sponsor -->
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
                len : 4
            }
        }
    }
</script>