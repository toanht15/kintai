SELECT U.id, U.email, U.date_created,T.check_in_time,T.check_out_time, T.status 
FROM user AS U 
JOIN timesheet AS T 
ON U.id = T.user_id 
WHERE T.day = ?day?