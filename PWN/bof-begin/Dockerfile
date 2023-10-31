FROM ubuntu:latest

RUN apt-get update && \
    apt-get install -y socat && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /bof

COPY ./src/flag.txt /bof/
COPY ./src/bof /bof/
COPY run.sh /

RUN chown -R root:root /bof && \
    chmod 500 /run.sh

EXPOSE 1337

ENTRYPOINT ["/run.sh"]