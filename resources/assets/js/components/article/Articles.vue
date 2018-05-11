<template>
	<div class="row articlediv">
		<my-article
			v-for="article in articles"
			v-bind:data="article"
			v-bind:key="article.id"
			@delete-article="deleteArticle(article)"
			:article="article" :user_id="cur_user_id">
		</my-article>
	</div>
</template>

<script>
	import Article from './Article.vue'
	import swal from 'sweetalert'
	export default {
		data () {
			return {
				articles: [], 
				cur_user_id: ''
			}
		}, 
		
		components: {
			'my-article' : Article
		},

		created () {
			this.$http.get('current/user_id').then((response) => {
				this.cur_user_id = response.body
			});

			this.$http.get('api/articles')
				.then(response => {
					this.articles = response.body
			})
		},

		methods: {
			deleteProduct (article) {
				swal({
					title:"Are you sure?",
					text: "Deleted articles cannot be recovered.",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				}).then((willDelete) => {
					if(willDelete) {			
						this.$http.delete('api/articles/' + article.id)
							.then(response => {
								let index = this.articles.indexOf(article)
								this.articles.splice(index, 1)
				 			})

							swal("The article has been deleted.", {
								icon: "success",
							});
						
					} else {
						swal("Deletion cancelled.");
					}
				});
			},
			
		}
	}

</script>
<style>
	.articlediv {
		border-style: outset;
		border-width: 12px;
	}
</style>