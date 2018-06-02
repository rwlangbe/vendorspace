import Vue from 'vue'
import VueRouter from 'vue-router'
import Index from './components/Index.vue'
import Feed from './components/Feed.vue'
import Create from './components/article/Create.vue'
import Edit from './components/article/Edit.vue'
import Vendor from './components/guest/Vendorarea.vue'
import Promotor from './components/guest/Promotorarea.vue'
import Entertainer from './components/guest/Entertainerarea.vue'
import CreateEvent from './components/partials/CreateEvent.vue'
import EditEvent from './components/partials/EditEvent.vue'

Vue.use(VueRouter)

const router = new VueRouter({
	routes: [
		{ path: "/", component: Index, name: 'home_other',},
		{ path: "/index", component: Index, name: 'home',},
		{ path: "/guest/Vendorarea", component: Vendor, name: 'vendor',},
		{ path: "/guest/Promotorarea", component: Promotor, name: 'promotor',},
		{ path: "/guest/Entertainerarea", component: Entertainer, name: 'entertainer',},		
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
		{ path: "/events/create", props: true, component: CreateEvent, name: 'new_event',},
		{ path: "/events/edit", props: true, component: EditEvent, name: 'edit_event',},


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

