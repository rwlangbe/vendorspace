import Vue from 'vue'
import VueRouter from 'vue-router'
import Feed from './components/Feed.vue'
import Create from './components/article/Create.vue'
import Edit from './components/article/Edit.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ path: "/feed", component: Feed, name: 'feed',
			meta: {
				forAuth: true
			}
		},
		{ path: "/articles/create", component: Create, name: 'new_article',
			meta: {
				forAuth: true
			}
		},
		{ path: "/articles/:article/edit", component: Edit, name: 'edit_article',
			meta: {
				forAuth: true
			}
		},
		{ path: "*", component: Feed, name: 'feedother',
			meta: {
				forAuth: true
			}
		},
	],
	linkActiveClass: 'active',
	mode: 'history'
})

export default router

