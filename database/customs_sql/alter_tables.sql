
CREATE TABLE public.hiv_report
(
    id bigint NOT NULL,
    first_resp character varying(50),
    ora_quick character varying(50),
    sd_bioline character varying(50),
    hiv_final character varying(50),
    "resultID" bigint,
    PRIMARY KEY (id)
);

ALTER TABLE IF EXISTS public.hiv_report
    OWNER to postgres;

-- SEQUENCE: public.hiv_report_hiv_report_id_seq

-- DROP SEQUENCE IF EXISTS public.hiv_report_hiv_report_id_seq;

CREATE SEQUENCE public.hiv_report_hiv_report_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1
    OWNED BY hiv_report.id;


-- add after creating
nextval('hiv_report_hiv_report_id_seq'::regclass)

-- run script........
UPDATE
    labs_haematology_episodes
SET
    first_resp=hiv_report.first_resp, ora_quick=hiv_report.ora_quick, sd_bioline=hiv_report.sd_bioline, hiv_final=hiv_report.hiv_final
FROM hiv_report
WHERE labs_haematology_episodes.haema_id = hiv_report.id;


CREATE TABLE public.lab_blood
(
    id bigint NOT NULL,
    donor_id integer,
    cal_date timestamp(0) without time zone,
    PRIMARY KEY (id)
);

ALTER TABLE IF EXISTS public.lab_blood
    OWNER to postgres;

-- SEQUENCE: public.lab_blood_lab_blood_id_seq

-- DROP SEQUENCE IF EXISTS public.lab_blood_lab_blood_id_seq;

CREATE SEQUENCE public.lab_blood_lab_blood_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1
    OWNED BY lab_blood.id;


-- add after creating
nextval('lab_blood_lab_blood_id_seq'::regclass)


-- run script........
UPDATE
    lab_results_infos
SET
    created_at=cal_date, updated_at=cal_date
FROM lab_blood
WHERE cast(substring(lab_results_infos.lab_number, 2, length(lab_results_infos.lab_number)) as integer) = lab_blood.donor_id
AND lab_results_infos.department_id = 0;



-- drop
hiv_report
lab_blood


