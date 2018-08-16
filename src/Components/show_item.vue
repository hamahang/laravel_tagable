<template>
        <div class="mix category-1 col-lg-12 card1 card" data-value="1" style="display: inline-block;" data-bound="">
            <div class="card-heading" :id="'heading'+item.id">
                <h4 class="card-title">
                    <a :href="'#question'+item.id" data-toggle="collapse" :data-target="'#question'+item.id" aria-expanded="false" :aria-controls="'#question'+item.id" class="collapsed">
                        <strong class="c-gray-light">1.</strong>
                        {{this.item.title}}
                        <span class="float-right">
                            <i class="fa fa-plus"></i>
                        </span>
                    </a>
                </h4>
            </div>
            <div :id="'#question'+item.id" class="collapse" :aria-labelledby="'heading'+item.id" data-parent="#faq" style="">
                <div class="card-body">
                    {{this.item.description}}
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        name: "show-item",
        props:['item']
    }
</script>

<style scoped>
    .panel-heading span {
        margin-top: 1px;
        font-size: 12px;
    }
    .mb10{margin-bottom:10px !important}
    .mt10{margin-top: 10px !important}
    .mix{position:relative;display:none;font-weight:400;color:#777;height:auto;overflow:visible}

    .panel{
        width:100%;
    }
    .glyphicon{
        font-weight: lighter;
    }


    a:link, a:link, a:visited, a:hover, a:active {
        color: #757b87;
        text-decoration: none;
        cursor: pointer;
    }
</style>