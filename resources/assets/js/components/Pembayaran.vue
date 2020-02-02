<template>
<div>
	<h1>Payment</h1>
	<form @submit.prevent="sendRegister" v-if='checkNumber'>
			<div class="row">	
			<div class="col-md-12">
				<div class="form-group">
						<input class="input" type="text" placeholder="Registration Number" v-model='form.email'>
				</div>
				<button type='submit' class="main-btn">Submit</button>
			</div>	
		</div>
	</form>

	<form @submit.prevent="sendRegister" v-if="confirmPayment">
			<div class="row">	
			<div class="col-md-12">
				<div class="form-group">
				<input class="input" type="text" placeholder="Email" v-model='form.email'>
				</div>
				<div class="form-group">
						<input class="input" type="text" placeholder="Name On Bank Account" v-model='form.email'>
				</div>
				<div class="form-group">
						<input class="input" type="text" placeholder="Bank Account Number" v-model='form.email'>
				</div>
				<div class="form-group">
						<input class="input" type="text" placeholder="Amount of Payment/ With Uniquecode / ex : 500.001" v-model='form.email'>
				</div>
				<button type='submit' class="main-btn">Confirm Payment</button>
			</div>	
		</div>
	</form>
</div>

</template>
<script>
export default {
  data() {
    return {
      form: {
        name: "",
        email: "",
        represent: "",
        coffeeshopName: ""
      },
      checkNumber: true,
      confirmPayment: false
    };
  },
  methods: {
    sendRegister() {
      this.checkNumber = false;
      this.confirmPayment = true;
    },
    representChange() {
      if (this.form.represent == "coffeeshop") {
        this.represent = "";
      } else {
        this.coffeeshopName = "";
      }
    }
  }
};
</script>