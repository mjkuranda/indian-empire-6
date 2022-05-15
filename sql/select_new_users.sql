-- 3 najnowsi uzytkownicy
SELECT  username, registered
FROM    users
WHERE   active = 1
ORDER BY registered DESC
LIMIT   3