-- SQL commands needed to set up Data base in SQL server.
create database if not exists Employee;

use Employee;

create table if not exists employee_code_table (employee_code varchar(30) primary key, employee_code_name varchar(30), employee_domain varchar(30));

create table if not exists employee_salary_table (employee_id varchar(30) primary key, employee_salary int, employee_code varchar(30), foreign key (employee_code) references employee_code_table(employee_code));

create table if not exists employee_details_table (employee_id varchar(30), employee_first_name varchar(30), employee_last_name varchar(30), graduation_percentile int, foreign key (employee_id) references employee_salary_table(employee_id));

insert into employee_code_table values
('su_john', 'ru_john', 'java');

insert into employee_salary_table values
('ru122', 60, 'su_john');

insert into employee_details_table values
('ru122', 'John', 'Snow', 60);

-- Queries :
-- 1. WAQ to list all employee first name with salary greater than 50k.
select employee_first_name, employee_salary from employee_salary_table JOIN employee_details_table on employee_salary_table.employee_id = employee_details_table.employee_id where employee_salary > 50;

-- 2. WAQ to list all employee last name with graduation percentile greater than 70%.
select employee_last_name from employee_details_table where graduation_percentile > 70;

-- 3. WAQ to list all employee code name with graduation percentile less than 70%.
select  employee_code_name, graduation_percentile from employee_details_table as e1 JOIN employee_salary_table as e2 on e1.employee_id = e2.employee_id JOIN employee_code_table as e3 on e2.employee_code = e3.employee_code where graduation_percentile < 70;

-- 4. WAQ to list all employee’s full name that are not of domain Java.
select concat(employee_first_name, employee_last_name) as Full_name, e1.employee_domain from employee_code_table as e1 JOIN employee_salary_table as e2 on e1.employee_code = e2.employee_code JOIN employee_details_table as e3 on e2.employee_id = e3.employee_id where e1.employee_domain != 'Java';

-- 5. WAQ to list all employee_domain with sum of it's salary.
select employee_domain, sum(employee_salary) from employee_code_table as t1 JOIN employee_salary_table as t2 on t1.employee_code = t2.employee_code group by employee_domain;

-- 6. Write the above query again but dont include salaries which is less than 30k.
select employee_domain, sum(employee_salary) from employee_code_table as t1 JOIN employee_salary_table as t2 on t1.employee_code = t2.employee_code where employee_salary >= 30 group by employee_domain;

-- 7. WAQ to list all employee id which has not been assigned employee code.
select employee_id from employee_salary_table where employee_code = NULL;
