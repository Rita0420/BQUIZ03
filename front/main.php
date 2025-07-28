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
    /* background-color: lightpink; */
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
<style>
.movie-list {
    display: flex;
    justify-content: space-evenly;
    flex-wrap: wrap;
    height: 320px;
    align-content: space-evenly;
}

.movie {
    display:flex;
    flex-wrap:wrap;
    width: 48%;
    box-sizing: border-box;
    border: 1px solid #ccc;
    min-height: 100px;
    border-radius: 3px;
    padding: 3px;
}
</style>
<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div class="movie-list">
            <?php
            $today=date('Y-m-d');
            $ondate=date("Y-m-d",strtotime("-2 days",strtotime($today)));

            $total=$Movies->count(['sh'=>1],"and `ondate` between '$ondate' and '$today'");
            $div=4;
            $pages=ceil($total/$div);
            $now=$_GET['p']??'1';
            $start=($now-1)*$div;

            $movies=$Movies->all(['sh'=>1],"and `ondate` between '$ondate' and '$today' order by `rank` limit $start,$div");
            foreach($movies as $movie):
            ?>
            <div class="movie">
                <div style="width:40%"><img src="./images/<?=$movie['poster'];?>" alt="" style="width:60px;height:70px"></div>
                <div style="width:60%">
                    <div><?=$movie['name'];?></div>
                    <div>分級:<img src="./icon/03C0<?=$movie['level'];?>.png" alt=""
                            style="width:15px"><?=$leveStr[$movie['level']];?></div>
                    <div>上映日期:<?=$movie['ondate'];?></div>
                </div>
                <div style="display:flex;">
                    <button onclick="location.href='?do=intro&id=<?=$movie['id'];?>'">劇情簡介</button>
                    <button onclick="location.href='?do=order&id=<?=$movie['id'];?>'">線上訂票</button>
                </div>
            </div>
            <?php endforeach;?>
        </div>

        <div class="ct">
            <?php
            if($now-1>0){
                echo "<a href='?p=".($now-1)."'><</a>";
            }
            for($i=1;$i<=$pages;$i++){
                $size=($i==$now)?"24px":"16px";
                echo "<a href='?p=$i' style='font-size:$size;'>$i</a>";
            }
            if($now+1<=$pages){
                echo "<a href='?p=".($now+1)."'>></a>";
            }
            ?>
        </div>
    </div>
</div>

<script>
let rank = 0;
$('.poster').eq(rank).show();

let slider = setInterval(() => {

    animater()

}, 2000);

$('.btns').hover(
    function() {
        clearInterval(slider);

    },
    function() {
        slider = setInterval(() => {
            animater();
        }, 2000);
    }
);

$('.poster-btn').on('click', function() {
    let idx = $(this).index();
    animater(idx);
})

function animater(r) {
    let now = $('.poster:visible');
    if (r == undefined) {
        rank++;
        if (rank > $('.poster').length - 1) {
            rank = 0;
        }
    } else {
        rank = r;
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

let p = 0;
$('.left,.right').on('click', function() {
    let arrow = $(this).attr('class');
    switch (arrow) {
        case 'left':
            if (p > 0) {
                p--;
            }
            break;

        case 'right':
            if (p < $('.poster-btn').length - 4) {
                p++;
            }
            break;

        default:
            break;
    }

    $('.poster-btn').animate({
        right: p * 80
    }, 500)
})
</script>