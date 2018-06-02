<template>
	<div class="listings">
		<router-link tag="h4" to="/articles/create"
		v-if="cur_user_id">
			<a>Create New Article</a>
		</router-link>
		<articlelist class="pull-right"></articlelist>
	</div>
</template>

<script>
	import Articles from './article/Articles.vue'
	export default {
		data () {
			return {
				cur_user_id: ''
			}
		}, 
		components: {
			'articlelist' : Articles,
		},
		created () {				
			this.$http.get('current/user_id').then((response) => {
				this.cur_user_id = response.body
			});
		},
	}
</script>