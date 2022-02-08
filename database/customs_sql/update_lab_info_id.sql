UPDATE lab_results_art_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE art_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_bacteriologies SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE bacter_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_cerebro_fluids SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE cerebro_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_cooms_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE cooms_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_electrolytes SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE electrolytes_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_fbc_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE fbc_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_general_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE general_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_glycated_hemos SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE glycated_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_hb_profiles SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE hb_profile_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_high_vaginals SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE vaginal_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_hpyloris SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE hpylori_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_lipid_profiles SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE lipid_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_liver_funs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE liver_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_ogtt_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE ogtt_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_peri_films SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE peri_film_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_peritoneal_fluids SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE peritoneal_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_pleural_fluids SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE pleural_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_psa_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE psa_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_renal_funs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE renal_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_semen_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE semen_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_serum_labs SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE serum_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_stools SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE stool_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_uric_acids SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE uric_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

UPDATE lab_results_urinalyses SET lab_info_id = (SELECT lab_results_infos.lab_info_id FROM lab_results_infos WHERE urinal_id = lab_results_infos.lab_info_id) WHERE lab_info_id = 0;

