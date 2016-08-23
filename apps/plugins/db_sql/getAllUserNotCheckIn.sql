SELECT U.* 
FROM user AS U 
WHERE U.id NOT IN 
( 
	SELECT T.user_id
	FROM timesheet AS T
	WHERE T.day = ?day?
)  