<template>
<div>
	<h1>Register</h1>
	<form @submit.prevent="sendRegister">
			<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<input class="input" type="text" placeholder="Name" v-model='form.name'>
				</div>
				<div class="form-group">
					<input class="input" type="email" placeholder="Phone Number" v-model='form.email'>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<input class="input" type="email" placeholder="Email" v-model='form.email'>
				</div>
				<div class="form-group">
					<input class="input" type="email" placeholder="Domicile" v-model='form.email'>
				</div>
			</div>
			<div class="col-md-12">
			
				<div class="form-group">
					<select class="input" id='from'v-model='form.represent'>
						<option value="" disabled>Represent</option>
						<option value="coffeeshop">CoffeeShop</option>
						<option value='independent'>Independent</option>
					</select>
				</div>
					
				<div v-if="form.represent == 'coffeeshop'" >
					<div class="form-group">		
						<input class="input" type="text"  v-model='form.coffeeshopName' placeholder="Coffee Shop Name">
					</div>
					
				</div>
				<div class="form-group">
						<input  type="file" placeholder="Foto Peserta" >
					</div>
				<button type='submit' class="main-btn">Submit</button>
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
      }
    };
  },
  methods: {
    async sendRegister() {
      let reg = await axios.post("/api/v1/peserta", this.form);
      console.log(reg);
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