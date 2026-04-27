-- Create user
CREATE USER 'horariostame'@'localhost'
IDENTIFIED BY 'Horariostame123$';

-- Grant privileges only on this database
GRANT ALL PRIVILEGES
ON horariostame.*
TO 'horariostame'@'localhost';

-- Apply changes
FLUSH PRIVILEGES;
