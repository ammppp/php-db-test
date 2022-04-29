# PHP Database Latency Tester

This is a quick utility to test latency of MySQL calls from PHP.  No specific database schema is required since the queries performed are:

`SELECT "SOME SAMPLE TEXT RESPONSE" AS col`

This utility will run the above query as many times as specified - once creating a new DB connection for each query, and once reusing a database connection for each query.

Below is how to build and run this example.  This shows passing the PASSWORD as an environment variable directly from the shell (such that it doesn't have to be shown each time the command is run), but all environment variables can be passed any way that Docker allows them passed (explicitly, via environment, or via environment file).

```
sudo apt install -y docker.io git

git clone https://github.com/ammppp/php-db-test

cd php-db-test

sudo docker build -t php-db-test .

export PASSWORD="YOUR_DB_PASSWORD"

sudo --preserve-env docker run -it \
--env HOST="10.18.0.7" \
--env PORT="3306" \
--env USER="root" \
--env PASSWORD \
--env DBNAME="mysql" \
--env STATEMENTS="2500" \
php-db-test
``` 

Here is a sample terminal output from running the container:

```
HOST:       10.18.0.7
PORT:       3306
USER:       root
DBNAME:     mysql
STATEMENTS: 2,500

Ran 2,500 new connection statements in 3.935032 seconds


Ran 2,500 reuse connection statements in 0.541411 seconds 
```
