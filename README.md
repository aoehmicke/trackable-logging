# Trackable Logging

This project shows how to set up a `X-Request-ID` in various software systems.
This ID can be used in logs to identify a process chain across multiservice boundaries.
If you have a log collection in a systems like Graylog or Kibana, 
then it is really a boon to have an ID filter available.

* [nginx](#nginx)

## Nginx

Build and run a basic nginx server, which will either accept an `X-Request-ID`or will set one if it not exists.

```shell
make nginx-build
make nginx-run
```

### Without X-Request-ID

Running a simple curl will produce the following results:

```shell
curl -I http://localhost:8080
```

#### Log Entry
    
    192.168.65.1 - - [2024-09-06T16:01:26+00:00] "HEAD / HTTP/1.1" 200 0 "-" "curl/8.7.1" x_request_id=760797d3ae29102b6fa12e3ed2c0a507
    
#### HTTP Response
    
    Server: nginx/1.27.1
    Date: Fri, 06 Sep 2024 16:01:26 GMT
    Content-Type: text/html
    Content-Length: 141
    Last-Modified: Fri, 06 Sep 2024 14:01:36 GMT
    Connection: keep-alive
    ETag: "66db0b40-8d"
    X-Request-ID: 760797d3ae29102b6fa12e3ed2c0a507
    Accept-Ranges: bytes

### With X-Request-ID

By setting the `X-Request-ID` header you would get those results:

```shell
curl -I -H 'X-Request-ID: my-id' http://localhost:8080
```
#### Log Entry
    
    192.168.65.1 - - [2024-09-06T16:03:45+00:00] "HEAD / HTTP/1.1" 200 0 "-" "curl/8.7.1" x_request_id=my-id

#### HTTP Response
    
    HTTP/1.1 200 OK
    Server: nginx/1.27.1
    Date: Fri, 06 Sep 2024 16:03:45 GMT
    Content-Type: text/html
    Content-Length: 141
    Last-Modified: Fri, 06 Sep 2024 14:01:36 GMT
    Connection: keep-alive
    ETag: "66db0b40-8d"
    X-Request-ID: my-id
    Accept-Ranges: bytes
