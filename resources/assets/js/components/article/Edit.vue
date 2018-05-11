<template>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="form-group">
						<label>Name:</label>
						<input type="text" class="form-control" v-model="article.name">
					</div>
					<div class="form-group">
						<label>Price:</label>
						<input type="number" class="form-control" v-model="article.price">
					</div>
					<div class="form-group">
						<label>Description:</label>
						<textarea class="form-control" v-model="article.description"></textarea>
					</div>
					<button class="btn btn-success pull-right" @click="update" 
					v-show="article.name && article.price && article.description">
						Update
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import swal from 'sweetalert'
	export default {
		created() {
			this.getArticle()
		},
		data(){
			return {
				product: {}
			}
		}, 

		methods: {
			getArticle(){
				this.$http.get('api/articles/' + this.$route.params.article).then(response => {
					this.article = response.body
				})
			},
			update () {
				this.$http.put('api/articles/' + this.$route.params.article, this.article).then(response => {
					swal("Article updated.", "success")
				})
			}
		}
	}

</script>