FROM python:2-alpine


RUN echo "http://nl.alpinelinux.org/alpine/v3.4/main" > /etc/apk/repositories
RUN apk update && apk add \
        git \
        linux-headers \
        musl-dev \
        zlib-dev \
        jpeg-dev \
        gcc

RUN pip install --upgrade pip
RUN pip install wagtail

RUN mkdir -p /app
COPY ./mysite/. /app/.
WORKDIR /app
