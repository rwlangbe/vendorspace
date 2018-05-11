<template>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<form @submit.prevent="create">
						<div class="form-group">
							<label>Image:</label>
							<input type="file" class="form-control"
								@change="imageChanged">
						</div>
						<div class="form-group">
							<label>Name:</label>
							<input type="text" name="name" class="form-control"
								v-validate="'required'"
								v-model="article.name">
							<div class="help-block alert alert-danger" v-show="errors.has('name')">
								{{ errors.first('name') }}
							</div>
						</div>
						<div class="form-group">
							<label>Price:</label>
							<input type="number" name="price" class="form-control" 
								v-validate="'max_value:50|min_value:1'"
								v-model="article.price">
							<div class="help-block alert alert-danger" v-show="errors.has('price')">
								{{ errors.first('price') }}
							</div>
						</div>
						<div class="form-group">
							<label>Description:</label>
							<textarea class="form-control" v-model="article.description"></textarea>
						</div>

						<input class="btn btn-success pull-right"
							type="submit" value="Create">
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				article: {
					name:'',
					price: 0,
					description: '',
					image: ''
				}
			}
		}, 

		methods: {
			imageChanged(e) {

				var fileReader = new FileReader()
				fileReader.readAsDataURL(e.target.files[0])

				fileReader.onload = (e) => {
					this.article.image = e.target.result
				}
			},
			create () {
				this.$validator.validateAll().then(() => {
					this.$http.post('api/articles', this.article).then(response => {
						this.$router.push('/feed')
					})			
				})
			}
		}
	}

</script>