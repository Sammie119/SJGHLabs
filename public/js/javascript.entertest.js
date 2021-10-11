        
    window.onload = function(){
        document.getElementById('lab_no').focus();

        //jQuery(function($){
        //     $("#tel").mask("0999999999");
        //  });

        jQuery(function($){
               $("#spec_gra, #pleural_spec, #peritoneal_spec").mask("1.099");
            });

        jQuery(function($){
               $("#ph").mask("9.9");
            });


//Antibiotics Listing........................................................//
$("#bacter_anti1, #bacter_anti2, #bacter_anti3, #bacter_anti4, #bacter_anti5, #bacter_anti6, #bacter_anti7, #bacter_anti8, #bacter_anti9, #bacter_anti10, #bacter_anti11, #bacter_anti12").keyup(function(){
    var anti = $(this).val();
    var pathArray = window.location.pathname.split('/');
    var url = pathArray[1];
    
        $.ajax({
            type:'GET',
            url:"/"+url+"/antibiotic",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                anti
                },
            success:function(data) {
                $("#antibioticsListSel").empty();
                $("#antibioticsListSel").html(data);
            }
        });
    });

//Check for Duplicate drugs..........................................................//
$("input[type='text'].mov-1").bind('input', function() {

    
    // check input ($(this).val()) for validity here
    var valueOfChangedInput = $(this).val();
    var timeRepeated = 0;
    $("input[type='text'].mov-1").each(function () {
        if($("input[type='text'].mov-1").val().length > 1){
        //Inside each() check the 'valueOfChangedInput' with all other existing input
        if ($(this).val() == valueOfChangedInput ) {
            timeRepeated++; //this will be executed at least 1 time because of the input, which is changed just now
        }
      }
    });

    if(timeRepeated > 1) {
        alert("Duplicate Antibiotics found!!!!");
        $(this).val("");
    }

});

//Isolate Change...............................................................//
  $('#bacter_growth').on('change',function(){   
            var isolate = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];
            
            $.ajax({
                type:'POST',
                url:"/"+url+"/getisolate",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    isolate
                    },
                success:function(data) {
                    $("#bacter_type1").empty();
                    $("#bacter_type1").html(data);
                }
            });
        });


//Enable all Disabled select options............................
    $('#test_form').on('submit', function() {
        $('select').prop('disabled', false);
    });


    $('#test_form').on('submit', function() {

        if ((document.myform.fbs_rbs.value != "")&&(document.myform.fbs_rbs_2.value == "")) {
        alert("Please Select FBS or RBS");
        document.myform.fbs_rbs_2.focus();
        return false;
            }

        if ((document.myform.blood.value != "")&&(document.myform.blood_rh.value == "")) {
            alert("Please Blood Group's Rh(D) is Empty");
            document.myform.blood_rh.focus();
            return false;
            }

        if ((document.myform.blood.value == "")&&(document.myform.blood_rh.value != "")) {
            alert("Please Blood Group is Empty");
            document.myform.blood.focus();
            return false;
            }

        if (((document.myform.bf.value == "Pf trophozoites present") || (document.myform.bf.value == "Pf schizonts present") || (document.myform.bf.value == "Pm trophozoites present") || (document.myform.bf.value == "Pm schizonts present") || (document.myform.bf.value == "Po trophozoites present") || (document.myform.bf.value == "Po schizonts present"))&&(document.myform.bf_parasite.value == "")) {
            alert("Please PARASITE DENSITY is Empty");
            document.myform.bf_parasite.focus();
            return false;
            }

        if ((document.myform.bf.value == "")&&(document.myform.bf_parasite.value != "")) {
            alert("Please BF can not be Empty");
            document.myform.bf.focus();
            return false;
            }

        if ((document.myform.bf.value == "No Parasite Seen")&&(document.myform.bf_parasite.value != "")) {
            alert("Please PARASITE DENSITY should be Empty");
            document.myform.bf_parasite.focus();
            return false;
            }

        if ((document.myform.sickling.value == "")&&(document.myform.sickling_hgb.value != "")) {
            alert("Please SICKLING TEST should not be Empty");
            document.myform.sickling.focus();
            return false;
            }

        if ((document.myform.widal_o.value == "")&&(document.myform.widal_h.value != "")) {
            alert("Please WIDAL O should not be Empty");
            document.myform.widal_o.focus();
            return false;
            }

        if ((document.myform.widal_o.value != "")&&(document.myform.widal_h.value == "")) {
            alert("Please WIDAL H should not be Empty");
            document.myform.widal_h.focus();
            return false;
            }

        if ((document.myform.uri_blood.value == "Positive") && (document.myform.blood_factor.value == "")){
                alert("Plus Factor of Blood cannot be Empty");
                document.getElementById("blood_factor").focus();
                return false;
            }

        if ((document.myform.urobiln.value == "Increased") && (document.myform.urobiln_factor.value == "")){
                alert("Plus Factor of Urobilnogen cannot be Empty");
                document.getElementById("urobiln_factor").focus();
                return false;
            }

        if ((document.myform.glucose.value == "Positive") && (document.myform.glucose_factor.value == "")){
                alert("Plus Factor of Glucose cannot be Empty");
                document.getElementById("glucose_factor").focus();
                return false;
            }

        if ((document.myform.bilirubin.value == "Positive") && (document.myform.bilirubin_factor.value == "")){
                alert("Plus Factor of Bilirubin cannot be Empty");
                document.getElementById("bilirubin_factor").focus();
                return false;
            }

        if ((document.myform.ketone.value == "Positive") && (document.myform.ketone_factor.value == "")){
                alert("Plus Factor of Ketone cannot be Empty");
                document.getElementById("ketone_factor").focus();
                return false;
            }

        if ((document.myform.protein.value == "Positive") && (document.myform.protein_factor.value == "")){
                alert("Plus Factor of Protein cannot be Empty");
                document.getElementById("protein_factor").focus();
                return false;
            }

        if ((document.myform.leuco.value == "Positive") && (document.myform.leuco_factor.value == "")){
                alert("Plus Factor of Leucocytes cannot be Empty");
                document.getElementById("leuco_factor").focus();
                return false;
            }

        var general = document.getElementById('general_test');
        var urinal = document.getElementById('urinal_test');
        var art = document.getElementById('art_test');
        var hb = document.getElementById('hb_test');
        var fbc = document.getElementById('fbc_test');
        var per = document.getElementById('per_test');
        var semen = document.getElementById('semen_test');
        var oral = document.getElementById('oral_test');
        var microb = document.getElementById('microb_test');
        var chem = document.getElementById('chem_test');
        var pylori = document.getElementById('pylori_test');
        var psa = document.getElementById('psa_test');
        /*if((general.checked == false) && (urinal.checked == false) && (art.checked == false)){
        //  alert("No No NO NO NO NO");
        //  return false;
        } */

        if(((general.checked == true || urinal.checked == true)||(art.checked == true || hb.checked == true || fbc.checked == true)) || ((per.checked == true || semen.checked == true)||(microb.checked == true || chem.checked == true || oral.checked == true)||(pylori.checked==true || psa.checked==true))){
            
            if(fbc.checked == true){
                if(((document.myform.wbc.value != "") || (document.myform.lym.value != "")) || ((document.myform.fbc_hgb.value != "") || (document.myform.rbc.value != ""))){
                    //$('#wbc, #lym, #mid, #neut, #rbc, #fbc_hgb, #hct, #mcv, #rdw_cv, #plt, #mpv').prop('required', true);
                    if((document.myform.wbc.value == "") || (document.myform.lym.value == "")){
                        alert('All Test are Required under FBC');
                        document.getElementById('wbc').focus();
                        return false;
                    }
                    else if((document.myform.neut.value == "")){
                        alert('All Test are Required under FBC');
                        document.getElementById('wbc').focus();
                        return false;
                    }
                    else if((document.myform.rbc.value == "") || (document.myform.fbc_hgb.value == "")){
                        alert('All Test are Required under FBC');
                        document.getElementById('wbc').focus();
                        return false;
                    }
                    else if((document.myform.hct.value == "") || (document.myform.mcv.value == "")){
                        alert('All Test are Required under FBC');
                        document.getElementById('wbc').focus();
                        return false;
                    }
                    else if((document.myform.rdw_cv.value == "") || (document.myform.plt.value == "")){
                        alert('All Test are Required under FBC');
                        document.getElementById('wbc').focus();
                        return false;
                    }
                    else {
                       // return confirm('This Result(s) will be Saved into a Database?');
                    }
                }
                else {
                        document.myform.wbc.value = "0.1";
                        document.myform.lym.value = "0.1";
                        //return confirm('This Result(s) will be Saved into a Database?');    
                }
            }

            if(general.checked == true){
                if ((document.myform.anti_tpha.value == "")&&(document.myform.hbs_ag.value == "")) {

                    if ((document.myform.hcv.value == "")&&(document.myform.fbs_rbs.value == "")) {

                        if ((document.myform.blood.value == "")&&(document.myform.g6pd.value == "")) {
                            
                            if ((document.myform.urine_hcg.value == "")&&(document.myform.bf.value == "")) {
                            
                                if ((document.myform.esr.value == "")&&(document.myform.sickling.value == "")) {
                            
                                    if ((document.myform.widal_o.value == "")&&(document.myform.comment.value == "")) {
                                        if(document.myform.rdt_pf.value == ""){
                                            alert("GENERAL LABS is Empty!!!!!");
                                            document.myform.anti_tpha.focus();
                                            return false;
                                        }
                                        else{
                                            //return confirm('This Result(s) will be Saved into a Database?');
                                        }
                                        
                                    }
                                    else{
                                         //return confirm('This Result(s) will be Saved into a Database?');
                                        }
                                }
                                else{
                                    // return confirm('This Result(s) will be Saved into a Database?');
                                    }   
                            }
                            else{
                             //return confirm('This Result(s) will be Saved into a Database?');
                            }
                    
                        }
                        else{
                         //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    
                    }
                    else{
                    // return confirm('This Result(s) will be Saved into a Database?');
                    }
                
                }
                else{
                     //return confirm('This Result(s) will be Saved into a Database?');
                    }
            }

            if(urinal.checked == true){
                if((document.getElementById('macro').value == "")  && (document.getElementById('micro').value == "")){
                        //$('#appear, #color, #uri_blood, #urobiln, #glucose, #nitrite, #ph, #bilirubin, #ketone, #protein, #leuco, #spec_gra, #pus_cell, #red_cell, #epi_cell').prop('required', true);

                        if((document.myform.appear.value == "") || (document.myform.color.value == "")){
                            alert('All Test are Required under URINALYSIS');
                            document.getElementById('appear').focus();
                            return false;
                        }

                        if((document.myform.uri_blood.value == "") || (document.myform.urobiln.value =="")){
                            alert('All Test are Required under URINALYSIS');
                            document.getElementById('uri_blood').focus();
                            return false;
                        }

                        if((document.myform.ph.value == "") || (document.myform.bilirubin.value =="")){
                            alert('All Test are Required under URINALYSIS');
                            document.getElementById('ph').focus();
                            return false;
                        }

                        if((document.myform.leuco.value == "") || (document.myform.spec_gra.value =="")){
                            alert('All Test are Required under URINALYSIS');
                            document.getElementById('leuco').focus();
                            return false;
                        }

                        if((document.myform.pus_cell.value == "") || (document.myform.epi_cell.value =="")){
                            alert('All Test are Required under URINALYSIS');
                            document.getElementById('pus_cell').focus();
                            return false;
                        }
                        
                    }
                     else {
                            //return confirm('This Result(s) will be Saved into a Database?');
                       }
            }

            if(art.checked == true){
                    if((document.myform.type_one.value == "") && (document.myform.type_two.value == "")){
                        if((document.myform.indirect.value == "") && (document.myform.direct.value == "")){
                            alert('ART and COOMB’S Test Empty!!!!!!!');
                            document.myform.type_one.focus();
                            return false;
                        }
                        else{
                               // return confirm('This Result(s) will be Saved into a Database?');
                            }

                    }
                    else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }

            }

            if(hb.checked == true){
                    //$('#hb_sag, #hb_sab, #hb_eag, #hb_eab, #hb_cab').prop('required', true);

                    if((document.myform.hb_sag.value == "") || (document.myform.hb_sab.value == "")){
                        alert('All Tests are Required under Hepatitis B Profile Report!!!');
                        document.myform.hb_sag.focus();
                        return false;
                    }
                    else if((document.myform.hb_cab.value == "") || (document.myform.hb_eab.value == "")){
                        alert('All Tests are Required under Hepatitis B Profile Report!!!');
                        document.myform.hb_sag.focus();
                        return false;
                    }
                    else if(document.myform.hb_eag.value == ""){
                        alert('All Tests are Required under Hepatitis B Profile Report!!!');
                        document.myform.hb_sag.focus();
                        return false;
                    }
                    else{
                        //return confirm('This Result(s) will be Saved into a Database?');
                    }
            }

            if(per.checked == true){
                    //$('#per_rbc, #per_wbc, #per_plt, #per_imp').prop('required', true);
                    if(((document.myform.per_rbc.value == "") || (document.myform.per_wbc.value == "")) || (document.myform.per_plt.value == "") || (document.myform.per_imp.value == "")){
                        alert('All Tests are Required under Peripheral Film Comment Report!!!');
                        document.myform.per_rbc.focus();
                        return false;
                    }
                    else{
                        //return confirm('This Result(s) will be Saved into a Database?');
                    }
            }

            if(semen.checked == true){
                    //$('#semen_date, #semen_dura, #semen_diff, #semen_all, #semen_mode, #semen_inter, #semen_vol, #semen_appear, #semen_liquefaction, #semen_viscosity, #semen_ph, #semen_rapid, #semen_none, #semen_imm, #semen_vital, #semen_wbc, #semen_count, #semen_totalc, #semen_normal, #semen_abn, #semen_head, #semen_mid, #semen_tail, #semen_comment').prop('required', true);
                    if(((document.myform.semen_date.value == "")||(document.myform.semen_diff.value == "")) || ((document.myform.semen_mode.value == "")||(document.myform.semen_vol.value == ""))){
                        alert('All Tests are Required under Semen Analysis Report!!!!!!');
                        document.myform.semen_date.focus();
                        return false;
                    }
                    else if(((document.myform.semen_liquefaction.value == "")||(document.myform.semen_ph.value == "")) || ((document.myform.semen_none.value == "")||(document.myform.semen_vital.value == ""))){
                        alert('All Tests are Required under Semen Analysis Report!!!!!!');
                        document.myform.semen_date.focus();
                        return false;
                    }
                    else if(((document.myform.semen_count.value == "") || (document.myform.semen_normal.value == "")) || ((document.myform.semen_head.value == "") || (document.myform.semen_tail.value == ""))){
                        alert('All Tests are Required under Semen Analysis Report!!!!!!');
                        document.myform.semen_date.focus();
                        return false;
                    }
                    else{
                        //return confirm('This Result(s) will be Saved into a Database?');
                    }
            }

            if(oral.checked == true){
                    //$('#oral_glucose, #oral_post').prop('required', true);
                    if((document.myform.oral_glucose.value == "") || (document.myform.oral_post.value == "") || (document.myform.oral_1hpost.value == "") || (document.myform.oral_glu.value == "") || (document.myform.fst_min.value == "") || (document.myform.thd_min.value == "") || (document.myform.for_min.value == "") || (document.myform.oral_pro.value == "") || (document.myform.oral_ninpro.value == "") ){
                        alert('All Tests are Required under Oral Glucose Tolerance Test (OGTT)!!!');
                        document.myform.oral_glucose.focus();
                        return false;
                    }
                    else{
                        //return confirm('This Result(s) will be Saved into a Database?');
                    }

                    if ((document.myform.oral_glu.value == "Positive") && (document.myform.oglu_f.value == "")){
                        alert("Plus Factor of Fasting Urine Glucose cannot be Empty");
                        document.getElementById("oglu_f").focus();
                        return false;
                    }

                    if ((document.myform.oral_pro.value == "Positive") && (document.myform.opro_f.value == "")){
                        alert("Plus Factor of 60mins Postprandial Glucose cannot be Empty");
                        document.getElementById("opro_f").focus();
                        return false;
                    }

                    if ((document.myform.oral_ninpro.value == "Positive") && (document.myform.opro_ninf.value == "")){
                        alert("Plus Factor of 120mins Postprandial Glucose cannot be Empty");
                        document.getElementById("opro_ninf").focus();
                        return false;
                    }                        
            }

            if(chem.checked == true){
                var liver = document.getElementById('liver_test');
                var renal = document.getElementById('renal_test');
                var lipid = document.getElementById('lipid_test');
                var electro = document.getElementById('electro_test');
                var uric = document.getElementById('uric_test');
                var glycated = document.getElementById('glycated_test');
                var serum = document.getElementById('serum_test');

                if((liver.checked == true || renal.checked == true) || (lipid.checked == true || electro.checked == true) || (uric.checked == true || glycated.checked == true) || (serum.checked == true)){

                    if(liver.checked == true){
                        if(((document.myform.liver_protein.value == "" || document.myform.liver_albumin.value == "") || (document.myform.liver_globulin.value == "" || document.myform.liver_alkaline.value == "")) || ((document.myform.liver_alanine.value == "" || document.myform.liver_aspartate.value == "") || (document.myform.liver_total.value == "" || document.myform.liver_indirect.value == ""))){
                            alert('All Tests are Required under Liver Function Test (LFT)!!!');
                            document.myform.liver_protein.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(renal.checked == true){
                        if((document.myform.renal_urea.value == "") || (document.myform.renal_creatinine.value == "")){
                            alert('All Tests are Required under Renal Function Test (RFT)!!!');
                            document.myform.renal_urea.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(lipid.checked == true){
                        if((document.myform.lipid_total.value == "" || document.myform.lipid_hdl.value == "") || (document.myform.lipid_trigly.value == "" || document.myform.lipid_ldl.value == "")){
                            alert('All Tests are Required under Lipid Profile (LP)!!!');
                            document.myform.lipid_total.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(electro.checked == true){
                        if(((document.myform.electro_potas.value == "" || document.myform.electro_sodium.value == "") || (document.myform.electro_chloride.value == "" || document.myform.electro_cca.value == "")) || ((document.myform.electro_ica.value == "" || document.myform.electro_tca.value == "") || (document.myform.electro_ph.value == ""))){
                            alert('All Tests are Required under Electrolytes!!!');
                            document.myform.electro_potas.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(uric.checked == true){
                        if(document.myform.uric_acid.value == "" ){
                            alert('All Tests are Required under Uric Acid!!!');
                            document.myform.uric_acid.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(glycated.checked == true){
                        if(document.myform.glycated_hba1c.value == "" ){
                            alert('All Tests are Required under Glycated Hemoglobin (HbA1c) Report!!!');
                            document.myform.glycated_hba1c.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(serum.checked == true){
                        if((document.myform.serum_total.value == "") || (document.myform.serum_direct.value == "") || (document.myform.serum_indirect.value == "")){
                            alert('All fields in SERUM BILIRUBIN Report must be filled!!!');
                            document.myform.serum_total.focus();
                            return false;
                        }
                    }

                }
                else{
                    alert('No Clinical Chemistries Test is Selected!! Please Select Test(s)!!!');
                    return false;
                }
            }

            if(microb.checked == true){
                var hvsr = document.getElementById('hvsr_test');
                var pleural = document.getElementById('pleural_test');
                var peritoneal = document.getElementById('peritoneal_test');
                var csf = document.getElementById('csf_test');
                var bacter = document.getElementById('bacter_test');

                if((hvsr.checked == true || pleural.checked == true) || (peritoneal.checked == true || csf.checked == true || bacter.checked == true)){

                    if(hvsr.checked == true){
                        if(((document.myform.vaginal_epith.value == "" || document.myform.vaginal_pus.value == "") || (document.myform.vaginal_red.value == "" || document.myform.vaginal_clue.value == "")) || ((document.myform.vaginal_whiff.value == "" || document.myform.vaginal_koh.value == "") || (document.myform.vaginal_tricho.value == "" || document.myform.vaginal_gram.value == ""))){
                            alert('All Tests are Required under High Vaginal Swab R/E Report!!!');
                            document.myform.vaginal_epith.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(pleural.checked == true){
                        if(((document.myform.pleural_appear.value == "" || document.myform.pleural_color.value == "") || (document.myform.pleural_ph.value == "" || document.myform.pleural_spec.value == "")) || ((document.myform.pleural_protein.value == "" || document.myform.pleural_glucose.value == "") || (document.myform.pleural_total.value == "" || document.myform.pleural_count.value == "") || (document.myform.pleural_type.value == "" || document.myform.pleural_culture.value == ""))){
                            alert('All Tests are Required under Pleural Fluid Report!!!');
                            document.myform.pleural_appear.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(peritoneal.checked == true){
                        if(((document.myform.peritoneal_appear.value == "" || document.myform.peritoneal_color.value == "") || (document.myform.peritoneal_spec.value == "" || document.myform.peritoneal_protein.value == "")) || ((document.myform.peritoneal_albumin.value == "" || document.myform.peritoneal_glucose.value == "") || (document.myform.peritoneal_alkaline.value == "" || document.myform.peritoneal_amylase.value == "") || (document.myform.peritoneal_count.value == "" || document.myform.peritoneal_gram.value == ""))){
                            alert('All Tests are Required under Peritoneal Fluid Report!!!');
                            document.myform.peritoneal_appear.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(csf.checked == true){
                        if(((document.myform.csf_appear.value == "" || document.myform.csf_color.value == "") || (document.myform.csf_protein.value == "" || document.myform.csf_glucose.value == "")) || ((document.myform.csf_globulin.value == "" || document.myform.csf_count.value == "") || (document.myform.csf_type.value == "" || document.myform.csf_gram.value == ""))){
                            alert('All Tests are Required under Cerebrospinal (CSF) Fluid Report!!!');
                            document.myform.csf_appear.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }
                    }

                    if(bacter.checked == true){
                        if(((document.myform.bacter_specimen.value == "" || document.myform.bacter_growth.value == "") || (document.myform.bacter_type1.value == ""))){
                            alert('Some Tests are Required under Bacteriology Results!!!');
                            document.myform.bacter_specimen.focus();
                            return false;
                        }
                        else{
                            //return confirm('This Result(s) will be Saved into a Database?');
                        }

                        if ((document.myform.bacter_anti1.value != "") && ((document.myform.bacter_react1.value == "" && document.myform.bacter_zone1.value == ""))) {
                            alert("Please One Response on Row One is Empty!!!!");
                            document.myform.bacter_anti1.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti2.value != "") && ((document.myform.bacter_react2.value == "" && document.myform.bacter_zone2.value == ""))) {
                            alert("Please One Response on Row Two is Empty!!!!");
                            document.myform.bacter_anti2.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti3.value != "") && ((document.myform.bacter_react3.value == "" && document.myform.bacter_zone3.value == ""))) {
                            alert("Please One Response on Row Three is Empty!!!!");
                            document.myform.bacter_anti3.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti4.value != "") && ((document.myform.bacter_react4.value == "" && document.myform.bacter_zone4.value == ""))) {
                            alert("Please One Response on Row Four is Empty!!!!");
                            document.myform.bacter_anti4.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti5.value != "") && ((document.myform.bacter_react5.value == "" && document.myform.bacter_zone5.value == ""))) {
                            alert("Please One Response on Row Five is Empty!!!!");
                            document.myform.bacter_anti5.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti6.value != "") && ((document.myform.bacter_react6.value == "" && document.myform.bacter_zone6.value == ""))) {
                            alert("Please One Response on Row Six is Empty!!!!");
                            document.myform.bacter_anti6.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti7.value != "") && ((document.myform.bacter_react7.value == "" && document.myform.bacter_zone7.value == ""))) {
                            alert("Please One Response on Row Seven is Empty!!!!");
                            document.myform.bacter_anti7.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti8.value != "") && ((document.myform.bacter_react8.value == "" && document.myform.bacter_zone8.value == ""))) {
                            alert("Please One Response on Row Eight is Empty!!!!");
                            document.myform.bacter_anti8.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti9.value != "") && ((document.myform.bacter_react9.value == "" && document.myform.bacter_zone9.value == ""))) {
                            alert("Please One Response on Row Nine is Empty!!!!");
                            document.myform.bacter_anti9.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti10.value != "") && ((document.myform.bacter_react10.value == "" && document.myform.bacter_zone10.value == ""))) {
                            alert("Please One Response on Row Ten is Empty!!!!");
                            document.myform.bacter_anti10.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti11.value != "") && ((document.myform.bacter_react11.value == "" && document.myform.bacter_zone11.value == ""))) {
                            alert("Please One Response on Row Eleven is Empty!!!!");
                            document.myform.bacter_anti11.focus();
                            return false;
                            }

                        if ((document.myform.bacter_anti12.value != "") && ((document.myform.bacter_react12.value == "" && document.myform.bacter_zone12.value == ""))) {
                            alert("Please One Response on Row Twelve is Empty!!!!");
                            document.myform.bacter_anti12.focus();
                            return false;
                            }

                        if((document.myform.bacter_growth.value == "Isolates") && ((document.myform.bacter_anti1.value == "" || document.myform.bacter_anti2.value == "" || document.myform.bacter_anti3.value == "" || document.myform.bacter_anti4.value == "" || document.myform.bacter_anti5.value == "" || document.myform.bacter_anti6.value == "") || (document.myform.bacter_anti7.value == "" || document.myform.bacter_anti8.value == "" || document.myform.bacter_anti9.value == "" || document.myform.bacter_anti10.value == "" || document.myform.bacter_anti11.value == "" || document.myform.bacter_anti12.value == ""))){

                            alert("No Antibiotics Response Should be Empty!!!!");
                            document.myform.bacter_anti1.focus();
                            return false;
                        }
                                
                    }
                }
                else{
                    alert('No Micro Biology Test is Selected!! Please Select Test(s)!!!');
                    return false;
                }
            }

            if(pylori.checked == true){
                if(document.getElementById('pylori_qual').value == ''){
                    alert('H-pylori Qualitative Test Report cannot be Empty!!!!');
                    document.getElementById('pylori_qual').focus();
                    return false;
                }
            }

            if(psa.checked == true){
               var psa_posi = document.getElementById('psa_pos');
               var psa_nega = document.getElementById('psa_neg');

               if(psa_posi.checked == true){
                if(document.getElementById('psa_positive').value == ''){
                    alert('Positive PSA should have an Element attached!!!!');
                    document.getElementById('psa_positive').focus();
                    return false;
                }
               }

               if(psa_nega.checked == true){
                if(document.getElementById('psa_negative').value == ''){
                    alert('Negative PSA should have an Element attached!!!!');
                    document.getElementById('psa_negative').focus();
                    return false;
                }
               }

               if(psa_posi.checked == false && psa_nega.checked == false){
                    alert('PROSTATE SPECIFIC ANTIGEN (PSA) SEMI-QUANTITATIVE REPORT is Empty!!');
                    return false;
                }
            }

            return confirm('This Result(s) will be Saved into a Database?');
             
           /* else{
                 alert('No Test is Selected!! Please Select Test(s)!!!');
                 return false;
                } */ 
            }
        else{
           
           alert('No Test is Selected!! Please Select Test(s)!!!');
             return false;
        }

        
    });
            

//Restrictions .................................................

        $('#opd_no').on("input", function(){
            var regexp = /[^0-9/]/g;

            if ($(this).val().match(regexp)){
                $(this).val($(this).val().replace(regexp, ''));
            }
           });

        $('#para, #esr, #lab_no, #plt, #semen_dura, #semen_inter, #semen_liquefaction, #bacter_zone1, #bacter_zone2, #bacter_zone3, #bacter_zone4, #bacter_zone5, #bacter_zone6, #bacter_zone7, #bacter_zone8, #bacter_zone9, #bacter_zone10, #bacter_zone11, #bacter_zone12').on("input", function(){
            var regexp = /[^0-9]/g;

            if ($(this).val().match(regexp)){
                $(this).val($(this).val().replace(regexp, ''));
            }
           });

        $('#pus_cell, #red_cell, #epi_cell').on("input", function(){
            var regexp = /[^0-9>]/g;

            if ($(this).val().match(regexp)){
                $(this).val($(this).val().replace(regexp, ''));
            }
           });


        $('#fbs, #ph, #wbc, #lym, #mid, #neut, #rbc, #fbc_hgb, #hct, #mcv, #rdw_cv, #mpv, #semen_vol, #semen_ph, #semen_rapid, #semen_none, #semen_imm, #semen_vital, #semen_wbc, #semen_count, #semen_totalc, #semen_normal, #semen_abn, #semen_head, #semen_mid, #semen_tail, #oral_glucose, #oral_1hpost, #oral_1_30post, #oral_post, #pleural_protein, #pleural_glucose, #pleural_total, #pleural_count, #peritoneal_protein, #peritoneal_albumin, #peritoneal_glucose, #peritoneal_alkaline, #peritoneal_amylase, #peritoneal_count, #csf_protein, #csf_glucose, #csf_count, #pleural_ph, #serum_total, #serum_direct, #serum_indirect').on("input", function(){
            var regexp = /[^0-9.]/g;

            if ($(this).val().match(regexp)){
                $(this).val($(this).val().replace(regexp, ''));
            }
           });

        $('#liver_protein, #liver_albumin, #liver_globulin, #liver_alkaline, #liver_alanine, #liver_aspartate, #liver_gamma, #liver_total, #liver_direct, #liver_indirect, #renal_urea, #renal_creatinine, #lipid_total, #lipid_trigly, #lipid_hdl, #lipid_ldl, #electro_potas, #electro_sodium, #electro_chloride, #electro_cca, #electro_ica, #electro_tca, #electro_ph, #uric_acid, #vaginal_epith, #vaginal_pus, #vaginal_red, #vaginal_clue, #vaginal_tricho').on("input", function(){
            var regexp = /[^0-9.]/g;

            if ($(this).val().match(regexp)){
                $(this).val($(this).val().replace(regexp, ''));
            }
           });


//Get patient name..........................................
        $('#opd_no').bind('change',function(){ 
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
                }
            });
        });


        $('#opd_no').bind('keyup',function(){   
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
                }
            });
        });


//Check if the patient is registered already not.........................
        $('#opd_no').bind('keyup',function(){
        if (document.getElementById("opd_no").value == "") {
            document.getElementById("name").value = "";
            document.getElementById("age").value = "";
            $("#disInfo").empty();
        }
        });

        $('#opd_no').bind('change',function(){
        if ((document.getElementById("opd_no").value != "") && (document.getElementById("name").value == "")) {
            alert("Please Enter Patient Details with OPD Number "+$(this).val());
            window.location.href = "add-patient";
        }
        });


//Setting of Dependecies...................................................
    $('#fbs_rbs_2').bind('change',function(){
        if ((document.getElementById("fbs_rbs_2").value == "FBS:") || (document.getElementById("fbs_rbs_2").value == "RBS:")){
            
            document.getElementById('fbs').readOnly = false;
        }
        else {
            document.getElementById('fbs').readOnly = true;
        }
    });


    $('#blood').bind('change',function(){
        if (document.getElementById("blood").value != "") {
            
            document.getElementById('blood_rh').disabled = false;
        }
        else {

            document.getElementById('blood_rh').disabled = true;
        }
    });


    $('#bf').bind('change',function(){
        if ((document.getElementById("bf").value == "") || (document.getElementById("bf").value == "No Parasite Seen") || (document.getElementById("bf").value == "Pf gametocytes present") || (document.getElementById("bf").value == "Pm gametocytes present") || (document.getElementById("bf").value == "Po gametocytes present")) {
            
            document.getElementById('para').readOnly = true;
        }
        else{
            document.getElementById('para').readOnly = false;
        }
    });

 /* $('#sickling').bind('change',function(){
        if ((document.getElementById("sickling").value == "") || (document.getElementById("sickling").value == "Negative")) {
            
            document.getElementById('sickling_hgb').disabled = true;
        }
        else{
            document.getElementById('sickling_hgb').disabled = false;
        }
    });  */


    $('#uri_blood').bind('change',function(){
        if (document.getElementById("uri_blood").value == "Positive"){
            
            document.getElementById('blood_factor').style.display='block';
        }
        else {
            document.getElementById('blood_factor').style.display='none';
        }
    });


    $('#urobiln').bind('change',function(){
        if (document.getElementById("urobiln").value == "Increased"){
            
            document.getElementById('urobiln_factor').style.display='block';
        }
        else {
            document.getElementById('urobiln_factor').style.display='none';
        }
    });


    $('#glucose').bind('change',function(){
        if (document.getElementById("glucose").value == "Positive"){
            
            document.getElementById('glucose_factor').style.display='block';
        }
        else {
            document.getElementById('glucose_factor').style.display='none';
        }
    });


    $('#bilirubin').bind('change',function(){
        if (document.getElementById("bilirubin").value == "Positive"){
            
            document.getElementById('bilirubin_factor').style.display='block';
        }
        else {
            document.getElementById('bilirubin_factor').style.display='none';
        }
    });

    $('#ketone').bind('change',function(){
        if (document.getElementById("ketone").value == "Positive"){
            
            document.getElementById('ketone_factor').style.display='block';
        }
        else {
            document.getElementById('ketone_factor').style.display='none';
        }
    });


    $('#protein').bind('change',function(){
        if (document.getElementById("protein").value == "Positive"){
            
            document.getElementById('protein_factor').style.display='block';
        }
        else {
            document.getElementById('protein_factor').style.display='none';
        }
    });


    $('#leuco').bind('change',function(){
        if (document.getElementById("leuco").value == "Positive"){
            
            document.getElementById('leuco_factor').style.display='block';
        }
        else {
            document.getElementById('leuco_factor').style.display='none';
        }
    });

//OGTT.....................................................

    $('#oral_glu').bind('change',function(){
        if (document.getElementById("oral_glu").value == "Positive"){
            
            document.getElementById('oglu_f').style.display='block';
        }
        else {
            document.getElementById('oglu_f').style.display='none';
        }
    });

    $('#oral_pro').bind('change',function(){
        if (document.getElementById("oral_pro").value == "Positive"){
            
            document.getElementById('opro_f').style.display='block';
        }
        else {
            document.getElementById('opro_f').style.display='none';
        }
    });

    $('#oral_ninpro').bind('change',function(){
        if (document.getElementById("oral_ninpro").value == "Positive"){
            
            document.getElementById('opro_ninf').style.display='block';
        }
        else {
            document.getElementById('opro_ninf').style.display='none';
        }
    });

//.....................................        



    $('#spec_gra').bind('change',function(){
        if ((document.getElementById("spec_gra").value >= 1.000) && (document.getElementById("spec_gra").value <= 1.030) ){
            
            return false
        }
        else {
            alert('Entered value is out of Range (Range: 1.000 - 1.030)');
            document.getElementById('spec_gra').value = "";
            document.getElementById('spec_gra').focus();
        }
    });

    $('#ora').bind('change',function(){
        if ((document.getElementById("type_one").value == "") && (document.getElementById("type_two").value == "")){
            
            alert('First Response(Type 1) or First Response(Type 2) Can not be Empty!!!');
            document.getElementById('type_one').focus();
            document.getElementById('ora').value = "";
        }
        
    });

    $('#pus_cell').bind('change',function(){
        if ((document.getElementById("pus_cell").value == ">30") || (document.getElementById("pus_cell").value < 31)){
            return false;
        } 
        else {
            
            alert('Pus Cell value can not be Greater than 30!!!');
            document.getElementById("pus_cell").value = "";
            document.getElementById("pus_cell").focus();
        }
        
    });

    $('#red_cell').bind('change',function(){
        if ((document.getElementById("red_cell").value == ">30") || (document.getElementById("red_cell").value < 31)){
            return false;
        } 
        else {
            
            alert('Pus Cell value can not be Greater than 30!!!');
            document.getElementById("red_cell").value = "";
            document.getElementById("red_cell").focus();
        }
        
    });

    $('#epi_cell').bind('change',function(){
        if ((document.getElementById("epi_cell").value == ">30") || (document.getElementById("epi_cell").value < 31)){
            return false;
        } 
        else {
            
            alert('Pus Cell value can not be Greater than 30!!!');
            document.getElementById("epi_cell").value = "";
            document.getElementById("epi_cell").focus();
        }
        
    });

    $('#bacter_react1').bind('change',function(){
        if (document.getElementById("bacter_react1").value == "Resistant"){
            
            document.getElementById('bacter_zone1').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone1').readOnly = false;
        }
    });

    $('#bacter_react2').bind('change',function(){
        if (document.getElementById("bacter_react2").value == "Resistant"){
            
            document.getElementById('bacter_zone2').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone2').readOnly = false;
        }
    });

    $('#bacter_react3').bind('change',function(){
        if (document.getElementById("bacter_react3").value == "Resistant"){
            
            document.getElementById('bacter_zone3').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone3').readOnly = false;
        }
    });

    $('#bacter_react4').bind('change',function(){
        if (document.getElementById("bacter_react4").value == "Resistant"){
            
            document.getElementById('bacter_zone4').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone4').readOnly = false;
        }
    });

    $('#bacter_react5').bind('change',function(){
        if (document.getElementById("bacter_react5").value == "Resistant"){
            
            document.getElementById('bacter_zone5').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone5').readOnly = false;
        }
    });

    $('#bacter_react6').bind('change',function(){
        if (document.getElementById("bacter_react6").value == "Resistant"){
            
            document.getElementById('bacter_zone6').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone6').readOnly = false;
        }
    });

    $('#bacter_react7').bind('change',function(){
        if (document.getElementById("bacter_react7").value == "Resistant"){
            
            document.getElementById('bacter_zone7').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone7').readOnly = false;
        }
    });

    $('#bacter_react8').bind('change',function(){
        if (document.getElementById("bacter_react8").value == "Resistant"){
            
            document.getElementById('bacter_zone8').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone8').readOnly = false;
        }
    });

    $('#bacter_react9').bind('change',function(){
        if (document.getElementById("bacter_react9").value == "Resistant"){
            
            document.getElementById('bacter_zone9').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone9').readOnly = false;
        }
    });

    $('#bacter_react10').bind('change',function(){
        if (document.getElementById("bacter_react10").value == "Resistant"){
            
            document.getElementById('bacter_zone10').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone10').readOnly = false;
        }
    });

    $('#bacter_react11').bind('change',function(){
        if (document.getElementById("bacter_react11").value == "Resistant"){
            
            document.getElementById('bacter_zone11').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone11').readOnly = false;
        }
    });

    $('#bacter_react12').bind('change',function(){
        if (document.getElementById("bacter_react12").value == "Resistant"){
            
            document.getElementById('bacter_zone12').readOnly = true;
        }
        else {
            document.getElementById('bacter_zone12').readOnly = false;
        }
    });

//Getting the Lab number checked to avoid repeatition................
        $('#lab_no').bind('change',function(){   
            var lab_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];
            
            $.ajax({
                type:'POST',
                url:"/"+url+"/getlab-number-check",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    lab_no
                    },
                success:function(data) {
                    $("#lab_no").empty();
                    $("#lab_no").html(data);
                }
            });
        });

//Getting the Display Other Info................
        $('#opd_no').bind('change',function(){   
            var opd_no = $(this).val();
            var pathArray = window.location.pathname.split('/');
            var url = pathArray[1];
        
            $.ajax({
                type:'POST',
                url:"/"+url+"/get-patient-info",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    opd_no
                    },
                success:function(data) {
                    $("#disInfo").empty();
                    $("#disInfo").html(data);
                }
            });
        }); 

    };

        // function CheckColors(val){
        //  var element=document.getElementById('bf_other');
        //  if(val=='Others'){
        //    element.style.display='block';
        //    element.focus();
        //     }
        //  else { 
        //    element.style.display='none';
        //     }
        // }

        function BacterDisplay(bacterd){
            if(bacterd == 'No Growth' || bacterd =='Heavily Mixed Growth' || bacterd =='No Pathogen Isolated'){
                document.getElementById('becter_display').style.display='none';
                document.getElementById('bacter_type2_dis').style.display='none';
            }
            else{
                document.getElementById('becter_display').style.display='block';
                document.getElementById('bacter_type2_dis').style.display='block';
            }
        }

        
        function myFunction() {
          // Get the checkbox
          var checkBox = document.getElementById("urinal_test");
          // Get the output text
          var text = document.getElementById("urinal");

          // If the checkbox is checked, display the output text
          if (checkBox.checked == true){
            text.style.display = "block";
          } else {
            text.style.display = "none";
          }
        }

        function myFunGeneral() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("general_test").checked == true){
            document.getElementById("general").style.display = "block";
          } else {
            document.getElementById("general").style.display = "none";
          }
        }

        function myFunArt() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("art_test").checked == true){
            document.getElementById("art").style.display = "block";
          } else {
            document.getElementById("art").style.display = "none";
          }
        }
        
        function myFunHB() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("hb_test").checked == true){
            document.getElementById("hb").style.display = "block";
          } else {
            document.getElementById("hb").style.display = "none";
          }
        }

        function myFunFbc() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("fbc_test").checked == true){
            document.getElementById("fbc").style.display = "block";
          } else {
            document.getElementById("fbc").style.display = "none";
          }
        }

        function myFunFbc_radio() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("fbc_radio").checked == true){
            document.getElementById("fbc_hid1").style.display = "block";
            document.getElementById("fbc_hid2").style.display = "block";
            document.getElementById("fbc_hid4").style.display = "block";
            document.getElementById("fbc_hid3").style.display = "none";
          }
        }

        function myFunFbc_radio2() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("fbc_radio2").checked == true){
            document.getElementById("fbc_hid1").style.display = "none";
            document.getElementById("fbc_hid2").style.display = "none";
            document.getElementById("fbc_hid3").style.display = "block";
            document.getElementById("fbc_hid4").style.display = "none";               
          }
        }

        function myFunPer() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("per_test").checked == true){
            document.getElementById("per").style.display = "block";
          } else {
            document.getElementById("per").style.display = "none";
          }
        }

        function myFunSemen() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("semen_test").checked == true){
            document.getElementById("semen").style.display = "block";
          } else {
            document.getElementById("semen").style.display = "none";
          }
        }

        function myFunOral() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("oral_test").checked == true){
            document.getElementById("oral").style.display = "block";
          } else {
            document.getElementById("oral").style.display = "none";
          }
        }

        function myFunChem() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("chem_test").checked == true){
            document.getElementById("chem").style.display = "block";
          } else {
            document.getElementById("chem").style.display = "none";
          }
        }

        function myFunMicrob() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("microb_test").checked == true){
            document.getElementById("microb").style.display = "block";
          } else {
            document.getElementById("microb").style.display = "none";
          }
        }

        function myFunLiver() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("liver_test").checked == true){
            document.getElementById("liver").style.display = "block";
          } else {
            document.getElementById("liver").style.display = "none";
          }
        }

        function myFunRenal() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("renal_test").checked == true){
            document.getElementById("renal").style.display = "block";
          } else {
            document.getElementById("renal").style.display = "none";
          }
        }

        function myFunLipid() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("lipid_test").checked == true){
            document.getElementById("lipid").style.display = "block";
          } else {
            document.getElementById("lipid").style.display = "none";
          }
        }
        
        function myFunElectro() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("electro_test").checked == true){
            document.getElementById("electro").style.display = "block";
          } else {
            document.getElementById("electro").style.display = "none";
          }
        }
        
        function myFunUric() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("uric_test").checked == true){
            document.getElementById("uric").style.display = "block";
          } else {
            document.getElementById("uric").style.display = "none";
          }
        }

        function myFunGlycated() { 
           // If the checkbox is checked, display the output text
          if (document.getElementById("glycated_test").checked == true){
            document.getElementById("glycated").style.display = "block";
          } else {
            document.getElementById("glycated").style.display = "none";
          }
        }
        
        function myFunHvsr() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("hvsr_test").checked == true){
            document.getElementById("hvsr").style.display = "block";
          } else {
            document.getElementById("hvsr").style.display = "none";
          }
        }
        
        function myFunPleural() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("pleural_test").checked == true){
            document.getElementById("pleural").style.display = "block";
          } else {
            document.getElementById("pleural").style.display = "none";
          }
        }
        
        function myFunPeritoneal() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("peritoneal_test").checked == true){
            document.getElementById("peritoneal").style.display = "block";
          } else {
            document.getElementById("peritoneal").style.display = "none";
          }
        }
      
        function myFunCSF() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("csf_test").checked == true){
            document.getElementById("csf").style.display = "block";
          } else {
            document.getElementById("csf").style.display = "none";
          }
        }

        function myFunBacter() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("bacter_test").checked == true){
            document.getElementById("bacter").style.display = "block";
          } else {
            document.getElementById("bacter").style.display = "none";
          }
        }

        function myFunPSA() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("psa_test").checked == true){
            document.getElementById("psa").style.display = "block";
          } else {
            document.getElementById("psa").style.display = "none";
          }
        }

        function myFunPylori() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("pylori_test").checked == true){
            document.getElementById("pylori").style.display = "block";
          } else {
            document.getElementById("pylori").style.display = "none";
          }
        }

        function myFunPSApositive() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("psa_pos").checked == true){
            document.getElementById("psa_positive").disabled = false;
            document.getElementById("psa_negative").disabled = true;
          } 
        }

        function myFunPSAnegative() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("psa_neg").checked == true){
            document.getElementById("psa_negative").disabled = false;
            document.getElementById("psa_positive").disabled = true;
          }
        }

        function myFunSerum() {
           // If the checkbox is checked, display the output text
          if (document.getElementById("serum_test").checked == true){
            document.getElementById("serum").style.display = "block";
          } else {
            document.getElementById("serum").style.display = "none";
          }
        }

//Validation................................................................//
function validateForm() {
    if(document.myform.name.value=="") {
        alert("No/Wrong OPD Number");
        document.myform.opd_no.focus();
        return false;
    }
    
}

 
