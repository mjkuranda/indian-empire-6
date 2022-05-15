SELECT  
        `id`,
        `title`,
        `content`,
        `date`,
        DATEDIFF(NOW(), `date`) AS `date_diff`
FROM    `posts`
ORDER BY `date` DESC
LIMIT 3;