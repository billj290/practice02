<style>
.tab{
    padding: 3px;
    border: 1px solid gray;
    margin-left: -1px;
    cursor:pointer;
    background-color: lightgray;
}
.active{
    border-bottom: white;
    background-color: white;
}
.box{
    border: 1px solid gray;
    width: 95%;
    margin-top: -1px;
}
</style>

<div style="display:flex;padding-left:1px">
    <div class="tab active">健康新知</div>
    <div class="tab">菸害防治</div>
    <div class="tab">癌症防治</div>
    <div class="tab">慢性病防治</div>
</div>

<div class="box">
    <h1>健康新知</h1>
    <pre>
       555 
    </pre>
</div>
<div class="box">
    <h1>菸害防治</h1>
    <pre></pre>
</div>
<div class="box">
    <h1>癌症防治</h1>
    <pre></pre>

</div>
<div class="box">
    <h1>慢性病防治</h1>
    <pre></pre>

</div>

<script>
    $('.box').hide()
    $('.box').eq(0).show()

    $('.tab').on('click',(e)=>{
        $('.tab').removeClass('active')
        $(e.target).addClass('active')
        $('.box').hide()
        $('.box').eq($(e.target).index()).show()
    })
</script>