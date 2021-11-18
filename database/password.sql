
12345678 = $2y$10$MjugONKI3ZchD3JNAaRWXe9D9Jiuo43YGNebf.Jwb6XI2d/lZpc0i


CREATE OR REPLACE VIEW v_w_users as 
SELECT name, username, mobile_no AS mobile, department, user_level, password, NOW() AS deleted_at, NOW() AS created_at, NOW() AS updated_at FROM users 
WHERE active = 'Yes';