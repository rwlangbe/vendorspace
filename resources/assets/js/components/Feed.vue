<template>
	<div class="listings">
		<h3>Article List</h3>
		<router-link tag="h4" to="/articles/create">
			<a>Create New Article</a>
		</router-link>
		<articlelist class="pull-right"></articlelist>
	</div>
</template>

<script>
	import Articles from './article/Articles.vue'
	export default {
		components: {
			'articlelist' : Articles,
		},
	}
</script>
<style type="text/css">
	h3, h4 {
		text-align: right;
	}

	

</style>