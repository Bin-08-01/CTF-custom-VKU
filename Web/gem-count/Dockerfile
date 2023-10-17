FROM node:19-alpine

EXPOSE 8080

RUN apk update && \
    apk add --no-cache sqlite sqlite-dev && \
    npm install -g sqlite3

WORKDIR /gems

COPY package.json /gems

RUN npm install

COPY . /gems

RUN sqlite3 data.db < schema.sql

CMD node .