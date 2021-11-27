CREATE OR REPLACE FUNCTION public.get_department(
	p_dropdown_id bigint)
    RETURNS character varying
    LANGUAGE 'sql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
SELECT
	TRIM( dropdown ) AS department
FROM
	public.dropdowns
WHERE
	dropdown_id = p_dropdown_id;
$BODY$;

ALTER FUNCTION public.get_department(bigint)
    OWNER TO postgres;