<template>
    <div>
        <i v-if="type ==='like'" class="far fa-thumbs-up color_green like pointer" @click="changeLike">{{like}}</i>
        <i v-else-if="type ==='disLike'" class="far fa-thumbs-down color_red dis_like pointer"  @click="changeLike">{{dis_like}}</i>
        <i v-else></i>
        <span class="ml-2"></span>
    </div>
</template>

<script>
    import axios from '../../../../../public/vendor/laravel_gallery_system/packages/axios/index.js'
    export default {
        name: "laravel_likeable_system",
        props:['model','item','type'],
        data: function () {
            return {

            }
        },
        computed: {
            like:{
                get:function()
                {
                    if(this.item.likes)
                    {
                        return this.item.likes.length;
                    }
                    else
                    {
                        return 0 ;
                    }
                },
                set:function(value)
                {
                    this.like++;
                }
            },
            dis_like:function () {
                if(this.item.dis_likes)
                {
                    return this.item.dis_likes.length;
                }
                else
                {
                    return 0 ;
                }
            }
        },
        methods: {
            changeLike: function () {
                axios.post("/LLS/chnageLike", {encode_id: this.item.encode_id, model: this.model, type: this.type}).then(response => {
                    this.$nextTick(() => {
                        if (response.data.success)
                        {
                            if (response.data.type =='like')
                            {
                                this.set('like');
                            }
                            else if(response.data.type =='disLike')
                            {
                                this.dis_like ++;
                            }
                            else
                            {
                                console.log('you should chose type equal like or disLkie');
                            }
                        }
                        else
                        {
                            alert('Please check console log');
                            console.log(this.item);
                        }

                    })
                })
            },
        }
    }
</script>

<style scoped>

</style>