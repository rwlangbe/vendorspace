<template>
  <div class="main">    
    <div class="top_border">
      <h2 class="jumbo__header">
          Vendor area
      </h2>
      <!-- template -->
      <div class="row">
        <div id="calendar_container" class="col-md-8">
          <Calendar 
            class="ui-calendar"
            :start-day="currMonth"
            :dateData="dateData"
            :on-month-change="onMonthChange"
            :mode="mode"
            :render-header="renderHeader"
            ref="calendar"
          >
            <div slot="header-left">
              <button
                :class="['ui-calendar-modeBtn' ,{ active: mode === 'month' }]"
                @click="mode = 'month'"
              >
                Month
              </button>
              <button
                :class="['ui-calendar-modeBtn', { active: mode === 'week' }]"
                @click="mode = 'week'"
              >
                Week
              </button>
            </div>
            <div :class="['ui-calendar-item', {'is-otherMonth': !item.isCurMonth}]" slot-scope="item">

              <div id="date" style="min-height='70px'" draggable="false" droppable="false">
                
                <div :class="['calendar-item-date']">
                  <router-link to="/events/create">
                    {{item.date.date}}
                  </router-link>
                </div>
                  <!-- this.event is the variable for mouse position -->
                <draggable :list="dateData" :options="{}" @start="startDrag" @end="stopDrag(this.event)">
                  <div v-for="event in dateData" :key="event.id" draggable="false" droppable="false"> 

                    <router-link tag="p" :to="{name:'edit_event', params: {sel_event: event}}" draggable="false" droppable="false">
                      <div class="event_cal" draggable="false" droppable="false"
                        v-if="event_date(event.start_date) == item.date.date
                          && event_month(event.start_date) == item.date.month">
                          {{ event.title }}
                      </div> 
                    </router-link>
                    <router-link tag="p" :to="'/events/' + event.id + '/edit'" draggable="false" droppable="false">
                      <div class="event_cal" v-if="is_event_on(item.date, event)"
                      draggable="false" droppable="false">
                      </div>
                    </router-link>

                  </div>
                </draggable>

                <div class="ui-calendar-item-name del">
                </div>
              </div>

            </div>
          </Calendar>
        </div>
        <div class="column">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import draggable from 'vuedraggable'
  export default {

    components:{draggable},

    data() {
      return {
        currMonth: '',
        eTitle: '',
        eDate: '',
        dateData: [],
        mode: 'month',
        eventId: '',
        dateId: 0,
        dragging: false,
      }
    },

    created () {        
      this.$http.get('/event/calendar').then((response) => {
          this.dateData = response.body
      });
    },

    methods: {

      startDrag(eve) {

        this.eTitle = eve.from.innerText.split('\n')[0];
        //console.log(this.eTitle);
        
        var tempEl = eve.from.parentElement.children[0].innerText;
        if (tempEl < 10)
          tempEl = "0" + tempEl;    
        this.eDate = this.currMonth + '-' + tempEl;
        //console.log(this.eDate);
        
        this.dragging = true;
      },

      stopDrag(event) {
        //get element
        var el = document.elementFromPoint(event.clientX,event.clientY);

        var dateEl = el.getElementsByClassName('calendar-item-date');
 
        var newDate = null;
        if (dateEl.length  > 0)
        {
          var tempEl = dateEl[0].innerText;
          if (tempEl < 10)
            tempEl = "0" + tempEl;
          newDate = this.currMonth + '-' + tempEl;
        }

        if (newDate !== null)
        {
          this.sendFullDate(newDate);
        }
  
        this.dragging = false;
      },

      sendFullDate(newDate){
        this.$http.get('/event/dateUpdate/' + this.eDate + '/' + this.eTitle + '/' + newDate).then(response => {
          this.dateData = response.body
          
                //this.$router.push('/guest/Vendorarea')
        });

      },

      select() {
        var eventlist = document.getElementById('event-list');
        eventlist.style.display = "block";
      },

      onMonthChange(val) {
        //console.log(val)
      },

      event_month(dateString) {
        return dateString.split('-')[1];
      },

      event_date(dateString) {
        return dateString.split('-')[2];
      },

      is_event_on(current, event) {
        var dateCurrent = new Date(current.year, current.month - 1, current.date).setHours(0,0,0,0);
        var dateFirst = new Date(event.start_date.split('-')[0], event.start_date.split('-')[1] - 1, event.start_date.split('-')[2]).setHours(0,0,0,0);
        var dateLast = new Date(event.end_date.split('-')[0], event.end_date.split('-')[1] - 1, event.end_date.split('-')[2]).setHours(0,0,0,0);
        return (dateCurrent > dateFirst && dateCurrent <= dateLast);
      },

      renderHeader({ prev, next, selectedDate }) {
        this.currMonth = selectedDate;
        const h = this.$createElement;

        const prevButton = h('div', {
          class: ['ui-calendar-modeBtn'],
          on: {
            click: prev
          }
        }, ['prev'])

        const nextButton = h('div', {
          class: ['ui-calendar-modeBtn'],
          on: {
            click: next
          }
        }, ['next'])

        const dateText = h('div', { class: ['ui-calendar-modeBtn'] }, [selectedDate])
        return h('div', [prevButton, dateText, nextButton])
      },
    }
  }
</script>

<style>
  .ui-calendar {
    margin-top: 20px;
    box-shadow: 0 1px 5px darken(#fb7bb0, 20%);
    border-radius: 5px;
    height: 90%;

    &-header {
      &__left {

        > button {
          font-size: 12px;

          &:nth-child(2) {
            margin-left: -4px;
          }
        }
      }
    }

    &-modeBtn {
      position: relative;
      display: inline-block;
      background: #fff;
      border: 1px solid #ff7dc5;
      color: #ff7dc5;
      padding: 5px 1em;
      font-size: 13px;
      line-height: 1;
      box-shadow: 0 1px 3px lighten(#ff7dc5, 15%);
      min-width: 5em;
      margin-right: -1px;
      // text-indent: 0.5em;
      text-align: center;
      cursor: pointer;

      &:first-child {
        border-top-left-radius: 3px;
        border-bottom-left-radius: 3px;
      }

      &:last-child {
        // left: -.5em;
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px;
      }

      &:active,
      &:focus {
        outline: none;
      }

      &.active,
      &:active {
        background: #ff7dc5;
        color: #fff;
        z-index: 2;
      }
    }

    & .k-calendar {
      &-header-center {
        color: #ff7dc5;
      }

      &-week-title-item {
        color: #ff7dc5;
      }
    }

    &-item {
      padding: 5px 10px;
      color: #666;

      &.is-otherMonth {
        color: #bbb;
      }

      &-name {
        font-size: 10px;
        > * {
          vertical-align: middle;
        }

        .del {
          display: inline-block;
          cursor: pointer;
          color: inherit;
          margin-bottom: -2px;
        }
      }
    }

    .vue-calendar-body-row {
      height: auto;
    }
  }
</style>%Hermoine01x

