FROM debian:11

RUN apt-get update && apt-get -y install php-cli php-mysql

COPY ./dbtest.php .

CMD ["php", "dbtest.php"]
 
