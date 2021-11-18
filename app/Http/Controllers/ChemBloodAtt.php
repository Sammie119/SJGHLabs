<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;



class ChemBloodAtt extends Controller
{
   static public function blood($year_month)
    {
        $liver_protein = DB::select("SELECT 
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm1,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm2,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm3,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm4,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm5,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm6,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm7,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm8,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm9,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm10,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm11,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinm12,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf1,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf2,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf3,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf4,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf5,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf6,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf7,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf8,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf9,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf10,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf11,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_proteinf12,
                (SELECT count(liver_protein) FROM v_w_chemistries_labs WHERE liver_protein IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS liver_protein
            ");

        $renal_urea = DB::select("SELECT 
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream1,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream2,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream3,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream4,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream5,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream6,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream7,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream8,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream9,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream10,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream11,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_uream12,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf1,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf2,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf3,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf4,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf5,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf6,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf7,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf8,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf9,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf10,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf11,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_ureaf12,
                (SELECT count(renal_urea) FROM v_w_chemistries_labs WHERE renal_urea IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS renal_urea
            ");

        $lipid_total = DB::select("SELECT 
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm1,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm2,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm3,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm4,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm5,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm6,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm7,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm8,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm9,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm10,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm11,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalm12,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf1,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf2,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf3,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf4,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf5,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf6,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf7,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf8,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf9,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf10,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf11,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_totalf12,
                (SELECT count(lipid_total) FROM v_w_chemistries_labs WHERE lipid_total IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS lipid_total
            ");

        $electro_potas = DB::select("SELECT 
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm1,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm2,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm3,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm4,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm5,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm6,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm7,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm8,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm9,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm10,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm11,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasm12,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf1,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf2,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf3,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf4,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf5,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf6,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf7,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf8,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf9,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf10,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf11,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potasf12,
                (SELECT count(electro_potas) FROM v_w_chemistries_labs WHERE electro_potas IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS electro_potas
            ");

        $uric_acid = DB::select("SELECT 
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm1,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm2,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm3,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm4,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm5,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm6,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm7,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm8,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm9,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm10,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm11,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidm12,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf1,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf2,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf3,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf4,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf5,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf6,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf7,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf8,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf9,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf10,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf11,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acidf12,
                (SELECT count(uric_acid) FROM v_w_chemistries_labs WHERE uric_acid IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS uric_acid
            ");

        $glycated_hba1c = DB::select("SELECT 
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm1,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm2,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm3,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm4,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm5,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm6,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm7,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm8,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm9,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm10,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm11,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cm12,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf1,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf2,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf3,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf4,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf5,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf6,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf7,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf8,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf9,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf10,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf11,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1cf12,
                (SELECT count(glycated_hba1c) FROM v_w_chemistries_labs WHERE glycated_hba1c IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS glycated_hba1c
            ");

        $serum_total = DB::select("SELECT 
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm1,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm2,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm3,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm4,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm5,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm6,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm7,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm8,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm9,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm10,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm11,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalm12,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age < 1 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf1,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 1 AND 4 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf2,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 5 AND 9 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf3,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 10 AND 14 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf4,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 15 AND 17 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf5,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 18 AND 19 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf6,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 20 AND 34 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf7,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 35 AND 49 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf8,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 50 AND 59 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf9,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age BETWEEN 60 AND 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf10,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND age > 69 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf11,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_totalf12,
                (SELECT count(serum_total) FROM v_w_chemistries_labs WHERE serum_total IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS serum_total
            ");

        $attendance = DB::select("SELECT (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE gender = 'Male' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS male,
                (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE gender = 'Female' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS female,
                (SELECT count(lab_info_id) FROM lab_results_infos WHERE deleted_at IS NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS total,
                (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE (dropdown = 'OBS & GYNAE' OR dropdown = 'ENT' OR dropdown = 'Eye' OR dropdown = 'OPD' OR dropdown = 'RCH' OR dropdown = 'ANC') AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS opd,
                (SELECT count(lab_info_id) FROM v_w_chemistries_labs WHERE (dropdown = 'Emergency' OR dropdown = 'General Ward' OR dropdown = 'Maternity Ward' OR dropdown = 'Orthopaedic Ward' OR dropdown = 'Surgical Ward' OR dropdown = 'NICU' OR dropdown = 'Childrens Ward') AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS ipd,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS blood_donors
            ");

        $bloodbank = DB::select("SELECT (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE anti_tpha = 'Positive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS anti_tpha_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE anti_tpha IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS anti_tpha,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hbs_ag = 'Positive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hbs_ag_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hbs_ag IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hbs_ag,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hcv = 'Positive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hcv_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE hcv IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS hcv,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE blood IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS blood,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE retro = 'Reactive' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS retro_pos,
                (SELECT count(lab_info_id) FROM v_w_blood_bank_labs WHERE retro IS NOT NULL AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS retro
            ");

        $blood_transfus = DB::select("SELECT (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Emergency' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS emerg,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Maternity Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS maternity,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'General Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS general,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Orthopaedic Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS orthopaedic,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE department = 'Childrens Ward' AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS childrens,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Male' AND patient_age > 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS adult_male,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Female' AND patient_age > 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS adult_female,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Male' AND patient_age <= 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS child_male,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE patient_gender = 'Female' AND patient_age <= 13 AND CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS adult_female,
                (SELECT count(bloodtrans_id) FROM v_w_blood_transfussion_episodes WHERE CONCAT(EXTRACT(YEAR FROM updated_at ),EXTRACT(MONTH FROM updated_at )) ='$year_month') AS total    
            ");
        
        // $serum_total = DB::select("
    
        //     ");
        return [
                'liver_protein' => $liver_protein[0],
                'renal_urea' => $renal_urea[0],
                'lipid_total' => $lipid_total[0],
                'electro_potas' => $electro_potas[0],
                'uric_acid' => $uric_acid[0],
                'glycated_hba1c' => $glycated_hba1c[0],
                'serum_total' => $serum_total[0],
                'attendance' => $attendance[0],
                'bloodbank' => $bloodbank[0],
                'blood_transfus' => $blood_transfus[0]
            ];
    }
}
