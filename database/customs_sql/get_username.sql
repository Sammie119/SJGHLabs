CREATE OR REPLACE FUNCTION public.get_username(
	p_user_id bigint)
    RETURNS character varying
    LANGUAGE 'sql'
    COST 100
    VOLATILE PARALLEL UNSAFE
AS $BODY$
SELECT
	TRIM( username ) AS username
FROM
	public.users
WHERE
	user_id = p_user_id;
$BODY$;

ALTER FUNCTION public.get_username(bigint)
    OWNER TO postgres;