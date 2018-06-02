<template>
	<div class="col-lg-15 pull-right">
		<div class="thumbnail">
			<h3>{{ article.title }}</h3>
			<img :src="'img/' + article.image">
			
			<div class="caption">
				
				<p>{{ article.description }}</p>
				<p>written by: {{ name }} </p>
				<hr>
				<p>
					<a href="#" class="btn btn-default btn-caption">
						Read
					</a>
					<a href="#" class="btn btn-success btn-caption">
						Save
					</a>			
					<a href="#" class="btn btn-danger" role="button" @click="$emit('delete-article')" v-if="user_id == article.user_id">
						Delete
					</a>
					<router-link class="btn btn-success"
						:to="'/articles/' + article.id + '/edit'" v-if="user_id == article.user_id">
						Edit
					</router-link>
				</p>

			</div>
		</div>	
	</div>
</template>

<script>
	export default {
		data () {
			return {
				name: ''
			}
		},

		props: [
			'user_id',
			'article',
		],

		created () {				
			this.$http.get('current/user_name/' + this.article.user_id).then((response) => {
					this.name = response.body
			});
		},
	}


</script>

<style>
</style>