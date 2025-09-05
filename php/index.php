<?php
echo "olá, mundo!";
?>

import mysql.connector

conect to the mysql server
conn = mysql.connector.connect(
    host="localhost",
    user="root",
    password="senaisp",
    database="AV1"
)
cursor = conn.cursor()

#run a query
cursor.execute("SELECT * FROM fornecedor")