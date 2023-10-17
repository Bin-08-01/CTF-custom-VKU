#!/bin/sh

BINARY=/challenge/overload

while :; do
    socat -dd -T60 tcp-l:1337,reuseaddr,fork,keepalive,su=nobody exec:$BINARY,stderr
done

# -dd : debug
# -T60: Timeout = 60
# tcp-l:1337: tcp listener on port 1337
# reuseaddr: reuse address while connect is not complete
# fork: create a subroutine
# keepalive: keep connection
# su=nobody: execute the program with user nobody
# exec:$BINARY,stderr: Runs the program specified by the BINARY variable and redirects its errors (stderr).