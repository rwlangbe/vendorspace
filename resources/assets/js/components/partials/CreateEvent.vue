<template>
	<div>
		<h3>New Event</h3>
		<div class="panel panel-default">
			<div class="panel-body">
				<form @submit.prevent="createEvent()">
					<div class="form-group">
						<label>Title</label>
						<input id="event_title" type="text" name="title"
							class="form-control" v-model="event.title"
							v-validate="'required'"
						>
						<div class="help-block alert alert-danger" v-show="errors.has('title')">
							{{ errors.first('title') }}
						</div>
						<input id="event_id_field" type="hidden">
					</div>
					<div class="row">
						<div class="form-group col-md-4">
							<label>Start time</label>
							<input id="event_sta" type="date" name="start-time"
								class="form-control" v-model="event.start_date"
								v-validate="'required|date_format:YYYY-MM-DD'"	
							>
							<div class="help-block alert alert-danger" v-show="errors.has('start-time')">
								{{ errors.first('start-time') }}
							</div>
						</div>
						<div class="col-sm-1">
							 - to -
						</div>
						<div class="form-group col-md-4">
							<label>End time</label>
							<input id="event_end" type="date" name="end-time" class="form-control" v-model="event.end_date"
								v-validate="'required|date_format:YYYY-MM-DD|after:start-time,true'">
							<div class="help-block alert alert-danger" v-show="errors.has('end-time')">
								{{ errors.first('end-time') }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Location</label>
						<input id="event_location" type="text" name="location" class="form-control" v-model="event.location">
					</div>
					<div class="form-group">
						<label>Description:</label>
						<textarea id="event_description" class="form-control" v-model="event.description"></textarea>
					</div>
					<input class="btn btn-success"
						type="submit" value="CREATE" 
						v-on:click="createEvent()">
					<input class="btn btn-basic pull-right"
						type="submit" value="Cancel" 
						v-on:click="cancelButton()">
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				event: {
					title:'',
					start_date: '',
					end_date: '',
					location: '',
					description: '',
					state: 'show'
				},
			}
		}, 
		methods: {
			createEvent () {
				this.$http.post('api/events', this.event).then(response => {
					this.$router.push('/guest/Vendorarea')
				});
			},
			cancelButton () {
      			this.$router.push('/guest/Vendorarea')
			},
		}
	}

</script>