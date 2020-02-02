<template>
    <div id="sponsors" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<!--<div class="section-title">
					<h3 class="title"><span class="appear">Our</span> <span class="appear" style="color: #c28d4b;">Sponsors</span></h3>
				</div> -->
				<!-- /section title -->

				<!-- sponsor -->
                    <div align="center">
                        <Countdown end="November 18, 2018"></Countdown>
                    </div>
				
				<!-- /sponsor -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
</template>

<script>
import Countdown from "vuejs-countdown";

export default {
  components: { Countdown },
  mounted() {
    setTimeout(() => {
      $("p.digit").css({ "font-size": "55px" });
      $(".text").css({ "font-size": "26px" });
      $("li:after").css({ "font-size": "50px" });
      console.log($("p.digit"));
    }, 1000);
  }
};
</script>
