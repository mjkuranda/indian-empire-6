SELECT 	COUNT(id) AS user_active_count
FROM 	users
WHERE 	(last_login > last_logout) AND
		(NOW() - last_active < 120)