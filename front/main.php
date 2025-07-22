<style>
.lists {
    width: 210px;
    height: 240px;
    /* background-color: lightblue; */
    margin: auto;
    overflow:hidden;
    position: relative;
}

.btns {
    width: 320px;
    height: 120px;
    background-color: lightpink;
}

.left{
    width: 0;
    height:0;
    border-left:0px solid black;
    border-right:30px solid black;
    border-top:20px solid transparent;
    border-bottom:20px solid transparent;
}

.right{
    width: 0;
    height:0;
    border-left:30px solid black;
    border-right:0px solid black;
    border-top:20px solid transparent;
    border-bottom:20px solid transparent;
}

.controls{
    display:flex;
    align-items:center;
    justify-content:space-around;
}

.poster img{
    width:200px;
    height:220px;
}

.poster{
    width:210px;
    height:240px;
    position: absolute;
    text-align:center;
    display:none;
}
</style>
<?php
$posters=$Poster->all(['sh'=>1]," order by `rank` ");

?>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="abgne-block-20111227">
            <div class="lists">
            <?php foreach($posters as $poster):?>
                <div class="poster">
                    <img src="./images/<?=$poster['img'];?>" alt="">
                    <div><?=$poster['name'];?></div>
                </div>
            <?php endforeach;?>

            </div>
            <div class="controls">
                <div class="left"></div>
                <div class="btns">

                </div>
                <div class="right"></div>

            </div>
        </div>
    </div>
</div>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <table>
            <tbody>
                <tr> </tr>
            </tbody>
        </table>
        <div class="ct"> </div>
    </div>
</div>

<script>
    $('.poster').eq(0).show();
</script>