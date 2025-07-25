<style>
.lists {
    width: 210px;
    height: 240px;
    /* background-color: lightblue; */
    margin: auto;
    overflow: hidden;
    position: relative;
}

.btns {
    width: 320px;
    height: 120px;
    background-color: lightpink;
    display: flex;
    overflow: hidden;
}

.left {
    width: 0;
    height: 0;
    border-left: 0px solid black;
    border-right: 30px solid black;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
}

.right {
    width: 0;
    height: 0;
    border-left: 30px solid black;
    border-right: 0px solid black;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
}

.controls {
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.poster img {
    width: 200px;
    height: 220px;
}

.poster {
    width: 210px;
    height: 240px;
    position: absolute;
    text-align: center;
    display: none;
}

.poster-btn {
    width: 80px;
    height: 100px;
    /* display: inline-block; */
    flex-shrink: 0;
    position: relative;
}

.poster-btn img {
    width: 70px;
    height: 90px;
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
                <div class="poster" data-ani="<?=$poster['ani'];?>" data-id="<?=$poster['id'];?>">
                    <img src="./images/<?=$poster['img'];?>" alt="">
                    <div><?=$poster['name'];?></div>
                </div>
                <?php endforeach;?>

            </div>
            <div class="controls">
                <div class="left"></div>
                <div class="btns">
                    <?php
                    foreach($posters as $key => $poster):
                    ?>
                    <div class="ct poster-btn" data-ani="<?=$poster['ani'];?>" data-id="<?=$poster['id'];?>">
                        <img src="./images/<?=$poster['img'];?>" alt="">
                        <div><?=$poster['name'];?></div>
                    </div>
                    <?php endforeach;?>
                </div>

                <div class="right"></div>
            </div>
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
let rank = 0;
$('.poster').eq(rank).show();

let slider = setInterval(() => {

    animater()

}, 2000);

$('.btns').hover(
    function () {
        clearInterval(slider);
        
    }, function () {
        slider=setInterval(() => {
            animater();
        }, 2000);
    }
);

$('.poster-btn').on('click',function(){
    let idx=$(this).index();
    animater(idx);
})

function animater(r) {
    let now = $('.poster:visible');
    if(r==undefined){
        rank++;
        if (rank > $('.poster').length - 1) {
            rank = 0;
        }
    }else{
        rank=r;
    }
    let next = $('.poster').eq(rank);
    let ani = $(now).data('ani');
    console.log(ani);


    switch (ani) {
        case 1:
            $(now).fadeOut(1000);
            $(next).fadeIn(1000);
            break;
        case 2:
            $(now).hide(1000);
            $(next).show(1000);
            break;
        case 3:
            $(now).slideUp(1000);
            $(next).slideDown(1000);
            break;

        default:
            break;
    }
}

let p=0;
$('.left,.right').on('click',function(){
    let arrow=$(this).attr('class');
    switch (arrow) {
        case 'left':
            if(p > 0){
                p--;
            }
            break;

        case 'right':
            if(p < $('.poster-btn').length-4){
                p++;
            }
            break;
    
        default:
            break;
    }

    $('.poster-btn').animate({right:p*80},500)
})
</script>