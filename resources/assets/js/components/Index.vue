<template>
    <div class="main">    
        <div class="top_border">
            <h3 class="top-margin80 jumbo__subheader">
                <ul id="heading_list">
                    <li>Event Promotors</li>
                    <li> * </li>
                    <li>Vendors</li>
                    <li> * </li>
                    <li>Entertainers</li>
                </ul>
            </h3>  
        </div>
        <div class="row col-lg-21">
            <div class="left column col-lg-4">
                <div class="viewport">
                    <router-link tag="h4" to="/guest/Vendorarea">
                        <a>Vendors</a>
                    </router-link>
                    <hr>
                    <p>Connect with other vendors and find events.  Use our tool section to 
                        calculate travel cost.</p>
                </div>        
                <div class="viewport">
                    <router-link tag="h4" to="/guest/Plannerarea">
                        <a>Event Promotors</a>
                    </router-link>
                    <hr>
                    <p>Compare site costs and ammenities.  Sign up food and merchandise vendors
                        See attendance estimates and get weather reports in one place.</p>
                </div>
                <div class="viewport">
                    <router-link tag="h4" to="/guest/Entertainerarea">
                        <a>Entertainers</a>
                    </router-link>
                    <hr>
                    <p>Create a profile page and list your talents.  </p>
                </div>
            </div>
        	<div class="middle column col-lg-8">
                <div id="middle_list">
                    <ul>
                        <h4>Create a profile to showcase your talents.</h4>
                        <h4>Create an event and sign up vendors in one place.</h4>
                        <h4>Find events and connect with other performers.</h4>
                    </ul>
                </div>
            </div>
            <div class="pull-right column col-lg-12 right">
                <feed></feed>
            </div>
        </div>    
    </div>

</template>
<script>
    import Feed from './Feed.vue'
    export default {
        components: {
            'feed' : Feed,
        },
    }
</script>