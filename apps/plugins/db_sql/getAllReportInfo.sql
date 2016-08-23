SELECT U.email, R.id, T.day, U.id as user_id
FROM user AS U 
JOIN timesheet AS T ON U.id = T.user_id
JOIN report AS R ON T.id = R.timesheet_id 
ORDER BY R.date_created DESC
