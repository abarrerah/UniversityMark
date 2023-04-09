<form class="form-inline">
  <div class="form-group mb-2 col-sm-10">
    <label for="newMark" class="col-sm-2 col-form-label">New Mark</label>
    <input type="number" class="form-control col-sm-8" id="newMark" placeholder="5" min="0" max="10">
  </div>
  <button id = "newMarkBtn" type="submit" class="btn btn-primary mb-2 col-sm-2">Save</button>
</form>
  <script>
    $(document).ready(function(){
        $("#newMarkBtn").on("click", function(e) {
            e.preventDefault();
            var mark = $("#newMark").val();
            if (validateMark(mark)) {
                var request = $.ajax({
                        url: '/index.php/mark/ajaxSaveNewMark',
                        method: "POST",
                        context: false,
                        dataType: 'json',
                        data: {
                            mark: mark
                        },
                        cache: false,
                        success: function(data) {
                            if (data['status'] === 201) {
                                $(location).prop('href', '/index.php/mark/marks')
                            } else {
                                alert('Ha ocurrido un error.');
                            } 
                        },
                        error: function(xhr) {
                            Alert("Ha ocurrido un error.");
                        }
                    })
            }
        })
    })

    function validateMark(mark) {
        if (typeof mark === 'string' && (mark >= 0 && mark <= 10)) {
            return true;
        } else {
            return false;
        }
    }
  </script>