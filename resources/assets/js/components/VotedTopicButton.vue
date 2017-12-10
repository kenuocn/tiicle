<template>
   <div class="ui message basic text-center voted-box">
       <div class="buttons">
           <div data-act="star" class="ui button kb-star-big basic "
                :class="{'teal' : !votedTopicd}"
                v-on:click="voted()">
               <i class="icon thumbs up"></i>
               <span class="state">{{votedTopicd ? '已点赞' : '点赞' }}</span>
           </div>
       </div>
   </div>
</template>

<script>
    export default {

        props:['topic'],

        data(){
            return {
                votedTopicd: false,
            }
        },

        mounted() {
            console.log(this.topic);
            axios.get(`/topics/${this.topic}/voted-topicd`).then(response => {
                this.votedTopicd = response.data.data;
            })
        },

        methods:{
            voted(){
                axios.post(`/topics/${this.topic}/voted`).then(response => {
                    this.votedTopicd = response.data.data;
                    console.log(response.data)
                })
            }
        },
    }
</script>
