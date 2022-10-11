<script>
    function remove(input) {
        input.parentNode.parentElement.remove()
    }

    $(function(){
        $(".add-all-input").on("click", function(){
            var labs = $('#labs').val();
            
            // Array for all labs to check if labs exists
            var labs_array = [];

            labs_array.push(<?=$labs ?>);

            // Array for all selected labs to check if labs has already been selected
            var lab_selected = [];

            var input_array = document.getElementsByName('lab_requests[]');
            
            for (var i = 0; i < input_array.length; i++) {
                lab_selected.push(input_array[i].value);
            };

            // console.log(lab_selected);
            // console.log(labs_array[0].includes(labs));
            if(labs == ''){
                alert('Empty Labs Selected');
            } else if(labs_array[0].includes(labs)){
                if(lab_selected.includes(labs)){
                    alert('Selected Labs is Already selected');
                } else {
                    console.log('TRUE');

                    if($(".investigations").length < 10){
                        $(".investigations").append(
                            `<div class="row mt-2">
                                <div class="col-md-11">
                                    <div class="mb-md-0">
                                        <input type="text" value="${labs}" class="form-control form-control-border bg-white" name="lab_requests[]" required placeholder=" " style="height: 35px;" readonly>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-danger" onclick="remove(this)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>`
                        );
                    }
                    console.log(lab_selected);
                    document.querySelector('.add-input').style.display='none';
                }
    
            } else {
                console.log('FALSE');
                alert('Selected Labs is not on the List');
            }

            $('#labs').val('');
            
        });
    });

    //Get patient name..........................................
    $('#opd_number').bind('change',function(){ 
            var opd_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];

            $.ajax({
                type:'POST',
                url:"/"+url+"/getname",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    opd_no
                    },
                success:function(data) {
                $("#name").val(data.name);
                $("#age").val(data.age);
                if(data.gender){
                    $("#gender").html(`<option>${data.gender}</option>`);
                } else {
                    $("#gender").html(`<option value="" selected disabled>--Gender--</option><option>Male</option><option>Female</option>`);
                }
                
                }
            });
        });


        $('#opd_number').bind('keyup',function(){   
            var opd_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];

            $.ajax({
                type:'POST',
                url:"/"+url+"/getname",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    opd_no
                    },
                success:function(data) {
                $("#name").val(data.name);
                $("#age").val(data.age);
                if(data.gender){
                    $("#gender").html(`<option>${data.gender}</option>`);
                } else {
                    $("#gender").html(`<option value="" selected disabled>--Gender--</option><option>Male</option><option>Female</option>`);
                }
                }
            });
        });


</script>