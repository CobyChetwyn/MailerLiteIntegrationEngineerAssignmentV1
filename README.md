## Step 1

Open terminal/command prompt in the root directory of this project

## Step 2

Run the following command to install composer:

composer install

## Step 3

Run the following command to get all the dependencies:

yarn

## Step 4

Run the following command to compile all JS files:

yarn dev

## Step 5
Find the file named '.env.example' in the root directory of this project

## Step 6
Rename '.env.example' to '.env'

## Step 7
Open the renamed file and configure the following variables to suit where your SQL database is hosted:
- DB_HOST
- DB_PORT
- DB_USERNAME
- DB_PASSWORD

## Step 8
In the project root you will find a file named 'MailerLite.sql', this is the SQL file that contains the SQL queries to create you a database and table required for this project. Take this SQL file and import it into your database application such as phpMyAdmin

## Step 9
On your local server environment (such as XAMPP or MAMP) point the document root to the 'public' folder within the root directory of this project.

## Step 10
Go to your browser and navigate to your local host domain, here you will be able to use the project
