FROM mysql:5.7-debian

RUN apt-get update && apt-get install -y --no-install-recommends \
    vim

COPY ./init/* /docker-entrypoint-initdb.d/

RUN touch /var/log/mysql/mysqld.log
