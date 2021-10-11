<script>
    $(document).ready(function() {
        document.getElementById('search').focus();
    });

    //Filter table Search.............................
        $(document).ready(function(){  
            $('#search').keyup(function(){  
                search_table($(this).val());  
            });  
            function search_table(value){  
                $('#employee_table tr').each(function(){  
                    var found = 'false';  
                    $(this).each(function(){  
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){  
                            found = 'true';  
                        }  
                    });  
                    if(found == 'true'){  
                        $(this).show();  
                     }  
                    else{  
                        $(this).hide();  
                    }  
                });  
            }  
        });  
//.......End............................
</script>

<style>
    #search {
        background-image: url("{{ asset('public/img/searchicon.png') }}");
        background-position: 8px 10px;
        background-repeat: no-repeat;
        font-size: 18px;
        padding: 10px 20px 12px 35px;    
    }

</style>