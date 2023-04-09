
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<div class="container mt-3 table-responsive">
    <button id="modal-btn" type="button" class="btn btn-dark mb-2"><i class="fa-sharp fa-regular fa-plus"></i></button>
    <div id="mark-form"></div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <?php for ($i = 1; $i <= $countMark; $i++) : ?>
                    <th scope="col">Mark Nº <?= $i ?></th>
                <?php endfor; ?>
                <th scope="col">Average Mark </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($totalMark as $mark): ?>
                <td><?= $mark['mark'] ?></td>
            <?php endforeach; ?>
            <td><?= $avgMark ?></td>
        </tbody>
    </table>
</div>


<script>
    $(document).ready(function() {
        $("#modal-btn").on("click", function() {
            var request = $.ajax({
                url: '/index.php/mark/ajaxGetForm',
                method: "GET",
                cache: false,
                success: function(data) {
                    if ($("#mark-form").children().length == 0) {
                        $("#mark-form").append(data);
                    } else {
                        alert("Form already active");
                    }

                },
                error: function(xhr) {
                    alert("Ha ocurrido un error.");
                }
            })
        })
    });
</script>