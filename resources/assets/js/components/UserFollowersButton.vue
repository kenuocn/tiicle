<template>
    <button class=" ui basic teal button fluid follow" data-act="follow" @click="followed">
        <span class="state">{{ follow ? '已关注' : '关注' }}</span>
    </button>
</template>

<script>
    export default {

        props:['user'],

        data(){
            return {
                follow: false,
            }
        },
        created () {
            this.isFollowing();
        },

        methods:{
            //关注
            followed (){
                axios.post(`/users/${this.user}/followed`).then(response => {
                    this.follow = response.data.data;
                })
            },

            isFollowing () {
                axios.get(`/users/${this.user}/is-following`).then(response => {
                    this.follow = response.data.data;
                });
            },

        },
    }
</script>
