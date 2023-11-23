FROM node:17.9.1-alpine3.14

WORKDIR /app

COPY ./src/package*.json ./

RUN npm install

COPY ./src .

EXPOSE 8000

CMD [ "npm", "start" ]
