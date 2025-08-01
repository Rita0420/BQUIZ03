<style>
#orderTable {
    width: 60%;
    margin: 10px auto;
    padding: 20px;
    border: 1px solid #ccc;
    background: #aaa;
}

#orderTable td {
    background: #ccc;
}

#orderTable td:nth-child(1) {
    width: 20%;
    text-align: right;
}

#orderTable td:nth-child(2) select {
    width: 98%;
    text-align: left;
}
</style>

<div id="orderForm">
    <h3 class="ct">線上訂票</h3>
    <table id="orderTable">
        <tr>
            <td>電影 :</td>
            <td>
                <select name="movie" id="movie">

                </select>
            </td>
        </tr>
        <tr>
            <td>日期 :</td>
            <td>
                <select name="date" id="date">

                </select>
            </td>
        </tr>
        <tr>
            <td>場次 :</td>
            <td>
                <select name="session" id="session">

                </select>
            </td>
        </tr>
    </table>

    <div class="ct">
        <button class="btn-submit">確定</button>
        <button class="btn-reset">重置</button>
    </div>
</div>

<div id="booking" style="display:none">

</div>

<script>
let url = new URLSearchParams(location.search);
getMovies();

$('#movie').on("change", function() {
    getDays($(this).val());
})

$('#date').on("change", function() {
    getSessions($('#movie').val(), $(this).val())
})

// $('.btn-submit , .btn-prev').on('click',function(){
//     $('#orderForm , #booking').toggle();
// })

$('.btn-submit').on('click', function() {
    $.get("./api/get_booking.php", {
        id: $('#movie').val(),
        date: $('#date').val(),
        session: $('#session').val()
    }, (booking) => {
        $('#booking').html(booking);
        $('.btn-prev').on('click', function() {
            $('#booking').hide();
            $('#orderForm').show();
        })
    })
    $('#orderForm').hide();
    $('#booking').show();
})


function getMovies() {
    let id = 0;

    if (url.has('id')) {
        id = url.get('id');
    }

    $.get("./api/get_movies.php", {
        id
    }, (movies) => {
        $('#movie').html(movies);
        getDays($('#movie').val());
    })
}

function getDays(movieId) {
    $.get("./api/get_dates.php", {
        movieId
    }, (dates) => {
        $('#date').html(dates);
        getSessions(movieId, $('#date').val());
    })
}

function getSessions(movieId, date) {
    $.get("./api/get_session.php", {
        movieId,
        date
    }, (sessions) => {
        $('#session').html(sessions);
    })
}
</script>