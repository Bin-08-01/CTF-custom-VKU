FROM ubuntu:latest

RUN apt-get update && \
    apt-get install -y socat && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /challenge

COPY ./src/flag.txt /challenge/
COPY ./src/overload /challenge/
COPY run.sh /

RUN chown -R root:root /challenge && \
    chmod 500 /run.sh

EXPOSE 1337

ENTRYPOINT ["/run.sh"]