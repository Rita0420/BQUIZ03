<?php include_once "db.php";?>
<style>
    .booking-box{
        width: 540px;
        height:370px;
        background:url("./icon/03D04.png") no-repeat center;
        margin:0 auto;
    }

    .info-box{
        background:#ddd;
        width:540px;
        margin:10px auto;
        /* padding:5px 15%; */
    }
    #seats{
        display:flex;
        width: 324px;
        height:344px;
        flex-wrap:wrap;
        margin:0 auto;
        padding-top:18px;
        text-align:center;
    }
    .seat{
        width: 64px;
        height:86px;
        box-sizing:border-box;
        /* background:#ddd; */
        padding:2px;
        position: relative;
    }

    .seat input[type="checkbox"]{
        position: absolute;
        bottom:5px;
        right:5px;
    }

    .booked{
        background:url("./icon/03D03.png") no-repeat center;
    }
    .null{
        background:url("./icon/03D02.png") no-repeat center;
    }

</style>
<div class="booking-box">
    <div id="seats">
        <?php
        for($i=0;$i<20;$i++):
            $booked='null';
        ?>
        <div class="seat <?=$booked;?>">
            <div><?=floor($i/5)+1;?>排<?=($i%5)+1;?>號</div>
            <input type="checkbox" name="seat" id="" value="<?=$i;?>">
        </div>
        <?php endfor;?>
    </div>
</div>

<div class="info-box">
    <div class="order-info">
    <div>您選擇的電影是:<?=$Movies->find($_GET['id'])['name'];?></div>
    <div>您選擇的時刻是:<?=$_GET['date'];?>&nbsp&nbsp&nbsp<?=$_GET['session'];?></div>
    <div>您已經勾選<span id="tickets">0</span>張票最多可選4張票</div>
    </div>
    <div class="ct">
        <button class="btn-prev">上一步</button>
        <button class="btn-order">訂購</button>
    </div>
</div>

<script>
    let selectedSeats=[];
    $(".seat input[type='checkbox']").on("change",function(){
        console.log($(this).prop("checked"),$(this).val());
        if($(this).prop("checked")){
            if(selectedSeats.length<4){
                selectedSeats.push($(this).val());
                $(this).parent().removeClass("null").addClass("booked");
            }else{
                alert("最多只能選擇四張票");
                $(this).prop("checked",false);
            }
        }else{
            selectedSeats.splice(selectedSeats.indexOf($(this).val()),1);
            $(this).parent().removeClass("booked").addClass("null");
        }
        console.log(selectedSeats);
        $("#tickets").text(selectedSeats.length);
        
    })

    $(".btn-order").on("click",function(){
        $.post("./api/booking.php",{
            movie: "<?=$Movies->find($_GET['id'])['name'];?>",
            date: "<?=$_GET['date'];?>",
            session: "<?=$_GET['session'];?>",
            seats: selectedSeats
        },(no)=>{
            console.log(no);
            
            location.href=`?do=result&no=${no}`;
        })
    })
</script>