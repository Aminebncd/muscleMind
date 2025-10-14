#!/bin/sh
set -e

HOST="${DB_HOST:-db}"
USER="${DB_USER:-root}"
PASSWORD="${DB_PASSWORD:-${MYSQL_ROOT_PASSWORD:-root}}"

until mysqladmin ping -h "$HOST" -u "$USER" -p"$PASSWORD" --silent; do
  >&2 echo "Waiting for MySQL at $HOST..."
  sleep 2
done

>&2 echo "MySQL is up!"
