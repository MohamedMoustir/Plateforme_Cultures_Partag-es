























--  1
SELECT category.names , COUNT(article.id)  FROM article 
JOIN category on article.category_id = category.CategoryID
GROUP BY category.names ;
-- 2

SELECT utilisateurs.name , COUNT(article.id)  FROM article 
JOIN utilisateurs on article.author_id = utilisateurs.utilisateurID
GROUP by utilisateurs.utilisateurID;