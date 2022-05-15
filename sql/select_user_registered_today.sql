SELECT  COUNT(*) AS user_count
FROM    users
WHERE   active = 1 AND DATE(registered) = CURRENT_DATE