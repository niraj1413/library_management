1.create index.php ,reset-password.php, forgate-password.php 
2. create dashbaord 
3. create include folder for codes which are commly used in each page 
   include/ footer.php , header.php , topbar.php , sidebar.php 

4. include this file in all page 

5  create config foder  for database  in this there are 2 files comfig and database 
   config for declarstion of varible and path and database for database connection 

6 create a books folder  in this there are two files add-books as add.php and manage books as index.php 

7. start backend work for  add.php  in modle/book.php 
{
    1. extract option of form  from database 
    and when form is published move to mange book so set action as book

    2. if book is pulished there will be an alert saying great for that start session in config and and if book is published
       then but some values in session [success] and session[error] then using header send it to manage books and there include alert 
       and then through alert write great and also unset the session 

       beacuse if we dont unset the session then it will always so that alert msg 

    3. all the sql query for insert data of form  in database   and select data from categories for options in form  are writtern in this file 
}
 


