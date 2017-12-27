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
                user_id: Config.user_id,
            }
        },
        created () {
            if(this.user_id != 0)
            {
                this.isFollowing();
            }
        },

        methods:{
            //关注
            followed (){
                axios.post(`/users/${this.user}/followed`).then(response => {
                    this.follow = response.data.data;
                }).catch(function (error) {
                    if (error.response.status == 401) {
                        swal({
                            title: '',
                            text: '需要登录以后才能执行此操作。',
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: '取消',
                            confirmButtonText: '前往登录',
                        }).then(function () {
                            location.href = '/login';
                        });

                        return false;
                    }
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
