<template>
	<div>
		<h3>Edit Event</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<form @submit.prevent="update()">
					<div class="form-group">
						<label>Title</label>
						<input id="event_title" type="text" name="title"
							class="form-control" v-model="sel_event.title" 
							v-validate="'required'"
						>
						<div class="help-block alert alert-danger" 
							v-show="errors.has('title')">
							{{ errors.first('title') }}
						</div>
						<input id="event_id_field" v-model="sel_event.id" type="hidden">
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label>Start time</label>
							<input id="event_start" type="date" name="start-time"
								class="form-control" v-model="sel_event.start_date" 
								v-validate="'required|date_format:YYYY-MM-DD'"
							>
							<div class="help-block alert alert-danger" 
								v-show="errors.has('start-time')">
								{{ errors.first('start-time') }}
							</div>
						</div>
						<div class="col-sm-1">
							 - to -
						</div>
						<div class="form-group col-md-4">
							<label>End time</label>
							<input id="event_end" type="date" name="end-time" 
								class="form-control" v-model="sel_event.end_date"
								v-validate="'required|date_format:YYYY-MM-DD|after:start-time,true'">
							<div class="help-block alert alert-danger" 
								v-show="errors.has('end-time')">
								{{ errors.first('end-time') }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Location</label>
						<input id="event_location" type="text" name="location" class="form-control" v-model="sel_event.location">
					</div>
					<div class="form-group">
						<label>Description:</label>
						<textarea rows="5" id="event_description" class="form-control" v-model="sel_event.description"></textarea>
					</div>
					<input class="btn btn-success"
						type="text" value="Update" 
						v-on:click="update()">
					<input class="btn btn-danger"
						type="text" value="Delete"
						v-on:click="deleteEvent()">
					<input class="btn btn-basic pull-right"
						type="submit" value="Cancel" 
						v-on:click="cancelButton()">
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	//import swal from 'sweetalert'
	export default {

		data(){
			return {
			}
		}, 
		props: {
			sel_event: {},
		},
		methods: {
			update () {
				var event_id = document.getElementById('event_id_field');
				this.$http.put('api/events/' + event_id.value , this.sel_event)
					.then(response => {
          			this.$router.push('/guest/Vendorarea');
        		});
			},
			deleteEvent () {
		      	var event_id = document.getElementById('event_id_field');
		      	this.$http.get('/event/delete/' + event_id.value)
		        	.then(response => {
		          	this.$router.push('/guest/Vendorarea')
		        });
		    },
			cancelButton () {
      			this.$router.push('/guest/Vendorarea')
			},
		}
	}

</script>