-- This file choose the name of new born indian.
-- It need to choose two parameters: '$id_father' and '$id_mother'.

-- If you want to choose only men names
-- in modulus choose 0,
-- if you want to choose only women names
-- in modulus choose 1.

SELECT id
FROM indian_names
WHERE (
	id <> (
		SELECT id_name
		FROM indian_names
		WHERE id_father = '$id_father'
	)
	OR
	id <> (
		SELECT id_name
		FROM indian_names
		WHERE id_mother = '$id_mother'
	)
	) 
	AND MOD(id%2) = 0
ORDER BY RAND()
LIMIT 1;