<template>
   <div>
       <button v-if="!challenged" type="button" class="c-button__show-social__challange" @click="challenge(postId)">
           <span>
                <div>チャレンジする</div>
           </span>
            <p class="u-other__fukidashi-challenge">この記事にチャレンジします</p>
       </button>
       <button v-else type="button" class="c-button__show-social__unchallange text" @click="unchallenge(postId)">
           <span>
                <div>チャレンジをやめる</div>
           </span>
            <p class="u-other__fukidashi-challenge">この記事のチャレンジをやめます</p>
       </button>
   </div>
</template>

<script>
    export default {
        props: ['postId', 'userId', 'defaultChallenged'],
        data() {
            return {
                challenged: false,
            };
        },
        created () {
            this.challenged = this.defaultChallenged
        },

        methods: {
            challenge(postId) {
                let url = `/api/posts/${postId}/challenge`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                  this.challenged = true
                })
            },
            unchallenge(postId) {
                let url = `/api/posts/${postId}/unchallenge`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                  this.challenged = false
                })
            }
        }
    }
</script>




