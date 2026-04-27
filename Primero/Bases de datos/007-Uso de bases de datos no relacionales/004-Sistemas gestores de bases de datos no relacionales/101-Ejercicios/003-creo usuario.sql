CREATE USER 'mitienda'@'localhost'
IDENTIFIED BY 'Mitienda123$';

GRANT ALL PRIVILEGES
ON mitienda.*
TO 'mitienda'@'localhost';

GRANT ALL PRIVILEGES
ON mitienda.*
TO 'mitienda'@'localhost';

FLUSH PRIVILEGES;
