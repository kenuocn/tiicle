<template>
   <div class="ui message basic text-center voted-box">
       <div class="buttons">
           <div data-act="star" class="ui button kb-star-big basic "
                :class="votedTopicd ? '' : 'teal'"
                @click="voted">
               <i class="icon thumbs up"></i>
               <span class="state">{{votedTopicd ? '已点赞' : '点赞' }}</span>
           </div>
       </div>
       <div class="voted-users">
           <span></span>
           <a :href="'/users/' + user.users.id" v-for="(user,index) in votedUsers">
               <img :class="'ui image avatar stargazer image-' + user . users.id" :src="user.users.avatar" :title="user.users.name" :alt="user.users.name">
           </a>
       </div>
   </div>
</template>

<script>
    export default {

        props:['topic'],

        data(){
            return {
                votedTopicd: false,
                votedUsers : []
            }
        },
        created () {
            this.getVotedTopicd();
            // 初始化页面获取所有点赞用户
        },

        methods:{
            voted (){
                axios.post(`/topics/${this.topic}/voted`).then(response => {
                    this.votedTopicd = response.data.data;
                    this.getVotedUsers()
                })
            },
            getVotedTopicd () {
                axios.get(`/topics/${this.topic}/voted-topicd`).then(response => {
                    this.votedTopicd = response.data.data;
                    //再重新获取所有点赞用户
                    this.getVotedUsers()
                });
            },
            getVotedUsers () {
                axios.get(`/topics/${this.topic}/voted-users`).then(response => {
                    this.votedUsers = response.data.data;
                    console.log(this.votedUsers);
                    console.log(response.data.data)
                })
            }
        },
    }
</script>
