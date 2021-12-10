update users set password = '$2y$10$D5Q/.iogSbgIDxEP8vvnHec/3vj/tGGrqSICKK2sNsMZNmu9srYua'

12345678

update lab_results_infos set lab_number = CONCAT('M',lab_number) 
where lab_number NOT LIKE 'M%' 
AND lab_number NOT LIKE 'R%'

-- In postgre

-- update lab_results_peri_films set per_rbc = null where per_rbc = 'NULL';

-- update lab_results_peri_films set per_wbc = null where per_wbc = 'NULL';

-- update lab_results_peri_films set per_plt = null where per_plt = 'NULL';

-- update lab_results_peri_films set per_imp = null where per_imp = 'NULL';

After exporting, data from results_per_semen, edit in text editor to clear all NULL values

-- In mySql

Add additional column to results_graph table, column name = 'pID' int(2); then run this query,
    update result_graph set `pID` = 1 WHERE `time_mins` = 0;
    update result_graph set `pID` = 2 WHERE `time_mins` = 60;
    update result_graph set `pID` = 3 WHERE `time_mins` = 90;
    update result_graph set `pID` = 4 WHERE `time_mins` = 120;

